<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseViewerController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->position !== 'ผู้ดูแลระบบ') {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้ เฉพาะผู้ดูแลระบบเท่านั้น');
        }

        $tab = $request->query('tab', 'messages');
        $q = $request->query('q', '');

        // Database System Info
        $driver = DB::connection()->getDriverName();
        $dbName = DB::connection()->getDatabaseName();
        $isPostgres = ($driver === 'pgsql');

        // Statistics
        $counts = [
            'users' => User::count(),
            'rooms' => ChatRoom::count(),
            'messages' => Message::count(),
            'tasks' => Task::count(),
            'histories' => TaskHistory::count(),
        ];

        $records = collect();

        switch ($tab) {
            case 'tasks':
                $query = Task::with(['creator', 'assignee'])->latest();
                if ($q) {
                    $query->where('title', 'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%");
                }
                $records = $query->limit(100)->get();
                break;

            case 'users':
                $query = User::latest();
                if ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('email', 'like', "%{$q}%")
                          ->orWhere('position', 'like', "%{$q}%");
                }
                $records = $query->limit(100)->get();
                break;

            case 'rooms':
                $query = ChatRoom::latest();
                if ($q) {
                    $query->where('name', 'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%");
                }
                $records = $query->limit(100)->get();
                break;

            case 'histories':
                $query = TaskHistory::with(['task', 'user'])->latest();
                if ($q) {
                    $query->whereHas('task', fn($t) => $t->where('title', 'like', "%{$q}%"))
                          ->orWhere('old_status', 'like', "%{$q}%")
                          ->orWhere('new_status', 'like', "%{$q}%");
                }
                $records = $query->limit(100)->get();
                break;

            case 'messages':
            default:
                $tab = 'messages';
                $query = Message::with(['user'])->latest();
                if ($q) {
                    $query->where('message', 'like', "%{$q}%");
                }
                $records = $query->limit(100)->get();
                break;
        }

        return view('admin.database', compact(
            'tab',
            'q',
            'driver',
            'dbName',
            'isPostgres',
            'counts',
            'records'
        ));
    }
}
