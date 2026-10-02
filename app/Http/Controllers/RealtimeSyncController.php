<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\News;
use App\Models\Task;
use Illuminate\Http\Request;

class RealtimeSyncController extends Controller
{
    /**
     * Unified Real-time Synchronization Endpoint.
     * Synchronizes across all connected clients:
     * 1. News likes count & user reaction states
     * 2. News announcements (new posts, edits, pins, deletions)
     * 3. Task statuses (e.g. pending -> in progress -> done)
     * 4. Urgent tasks & bell notification counters
     * 5. Chat rooms list
     */
    public function sync(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // 1. Urgent Tasks for Notification Bell & Sidebar
        $urgentTasks = Task::with(['creator', 'assignee'])
            ->where(function ($query) use ($user) {
                $query->where('assigned_to', $user->id)
                    ->orWhere('created_by', $user->id);
            })
            ->where('status', '!=', 'เสร็จแล้ว')
            ->where(function ($query) {
                $query->whereIn('priority', ['ด่วน', 'สูง'])
                    ->orWhere(function ($q) {
                        $q->whereNotNull('due_at')
                          ->where('due_at', '<=', now()->addDays(2));
                    });
            })
            ->orderByRaw("
                CASE
                    WHEN priority = 'ด่วน' THEN 1
                    WHEN priority = 'สูง' THEN 2
                    WHEN priority = 'ปกติ' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('due_at')
            ->get();

        $urgentList = $urgentTasks->map(function ($t) {
            $isPast = $t->due_at ? $t->due_at->isPast() : false;
            $dueHuman = $t->due_at ? ($isPast ? 'เกินกำหนด' : $t->due_at->diffForHumans()) : null;
            return [
                'id' => $t->id,
                'title' => $t->title,
                'priority' => $t->priority,
                'assignee' => $t->assignee?->name ?? 'ยังไม่ระบุ',
                'due_human' => $dueHuman,
                'is_overdue' => $isPast,
            ];
        });

        // 2. Task Counts
        $myTasksCount = Task::where('assigned_to', $user->id)
            ->where('status', '!=', 'เสร็จแล้ว')
            ->count();

        $allTasksQuery = Task::query();
        if (!in_array($user->position, ['หัวหน้างาน', 'ผู้บริหาร', 'ผู้จัดการ', 'ผู้ดูแลระบบ', 'แอดมิน', 'Admin'])) {
            $allTasksQuery->where('assigned_to', $user->id);
        }
        $allTasksCount = $allTasksQuery->count();

        // 3. Task Status Map for real-time live status badge updates
        $allTasks = $allTasksQuery->select(['id', 'status', 'priority', 'title', 'updated_at'])->get();
        $taskStatuses = [];
        foreach ($allTasks as $task) {
            $taskStatuses[$task->id] = [
                'status' => $task->status,
                'priority' => $task->priority,
            ];
        }

        // 4. News Likes & Feed Sync
        $newsList = News::with(['user', 'likes'])->orderByDesc('is_pinned')->latest()->get();
        $newsLikes = [];
        $newsFeed = [];

        foreach ($newsList as $news) {
            $isLiked = $news->likes->contains('user_id', $user->id);
            $likesCount = $news->likes->count();
            $newsLikes[$news->id] = [
                'likes_count' => $likesCount,
                'is_liked' => $isLiked,
            ];

            $authorRoleClass = match($news->user?->position) {
                'ผู้ดูแลระบบ', 'แอดมิน', 'Admin' => 'role-admin',
                'ผู้บริหาร', 'ผู้จัดการ', 'Manager', 'Executive' => 'role-manager',
                'หัวหน้างาน', 'Supervisor' => 'role-supervisor',
                default => 'role-staff',
            };

            $newsFeed[] = [
                'id' => $news->id,
                'title' => $news->title,
                'category' => $news->category,
                'category_color' => $news->category_color,
                'content' => $news->content,
                'is_pinned' => (bool)$news->is_pinned,
                'cover_image' => $news->cover_image,
                'audio_file' => $news->audio_file,
                'author_name' => $news->user?->name ?? 'ผู้ดูแลระบบ',
                'author_initial' => strtoupper(mb_substr($news->user?->name ?? 'U', 0, 1)),
                'author_position' => $news->user?->position ?? 'ผู้บริหาร',
                'author_role_class' => $authorRoleClass,
                'author_avatar' => $news->user?->avatar,
                'position_color' => $news->user?->position_color ?? '#00C853',
                'created_at_formatted' => $news->created_at->format('d/m/Y H:i') . ' น.',
                'likes_count' => $likesCount,
                'is_liked' => $isLiked,
            ];
        }

        $hasDirectCol = \Illuminate\Support\Facades\Schema::hasColumn('chat_rooms', 'is_direct');

        // 5. Public Rooms List
        $roomsQuery = ChatRoom::query();
        if ($hasDirectCol) {
            $roomsQuery->where('is_direct', false);
        }
        $rooms = $roomsQuery->orderBy('name')->get()->map(function ($r) {
            return [
                'id' => $r->id,
                'name' => $r->name,
                'description' => $r->description,
            ];
        });

        // 6. Direct Message Rooms for Current User
        $dmRooms = collect();
        if ($hasDirectCol) {
            $dmRooms = ChatRoom::with(['user1', 'user2'])
                ->where('is_direct', true)
                ->where(function ($q) use ($user) {
                    $q->where('user1_id', $user->id)->orWhere('user2_id', $user->id);
                })
                ->get()
                ->map(function ($r) use ($user) {
                    $other = $r->getOtherUser($user->id);
                    return [
                        'id' => $r->id,
                        'other_user_id' => $other?->id,
                        'other_user_name' => $other?->name ?? 'User',
                        'other_user_first_name' => $other?->resolved_first_name ?? ($other?->name ? explode(' ', $other->name)[0] : 'User'),
                        'other_user_position' => $other?->position ?? 'พนักงาน',
                        'other_user_position_color' => $other?->position_color ?? '#00C853',
                        'other_user_avatar' => $other?->avatar,
                    ];
                });
        }

        // Version hashes to determine if DOM re-rendering is needed
        $newsHash = md5($newsList->map(fn($n) => "{$n->id}-{$n->title}-{$n->is_pinned}-{$n->updated_at}")->join('|'));
        $tasksHash = md5($allTasks->map(fn($t) => "{$t->id}-{$t->status}-{$t->priority}-{$t->updated_at}")->join('|'));
        $roomsHash = md5($rooms->map(fn($r) => "{$r['id']}-{$r['name']}")->join('|'));
        $dmHash = md5($dmRooms->map(fn($r) => "{$r['id']}-{$r['other_user_name']}")->join('|'));

        return response()->json([
            'notifications_count' => $urgentTasks->count(),
            'urgent_tasks' => $urgentList,
            'my_tasks_count' => $myTasksCount,
            'all_tasks_count' => $allTasksCount,
            'news_count' => $newsList->count(),
            'news_likes' => $newsLikes,
            'news_hash' => $newsHash,
            'news_items' => $newsFeed,
            'tasks_hash' => $tasksHash,
            'task_statuses' => $taskStatuses,
            'rooms_hash' => $roomsHash,
            'rooms' => $rooms,
            'dm_rooms' => $dmRooms,
            'dm_hash' => $dmHash,
            'can_manage_news' => $user->canManageNews(),
            'can_manage_tasks' => $user->canManageTasks(),
            'can_manage_rooms' => in_array($user->position, ['ผู้บริหาร', 'ผู้จัดการ', 'ผู้ดูแลระบบ', 'แอดมิน', 'Admin', 'Executive', 'Manager']),
            'is_admin' => $user->position === 'ผู้ดูแลระบบ',
        ]);
    }
}

