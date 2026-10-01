<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsLike;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Store a newly created news article.
     * Restricted strictly to ผู้บริหาร / แอดมิน.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || !$user->canManageNews()) {
            abort(403, 'คุณไม่มีสิทธิ์ในการเผยแพร่ข่าวสาร (สำหรับผู้บริหารและผู้ดูแลระบบเท่านั้น)');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'cover_image' => 'nullable|string',
            'cover_file' => 'nullable|image|max:10240', // 10MB
            'audio_file' => 'nullable|string',
            'audio_upload' => 'nullable|mimes:mp3,wav,ogg,webm,m4a|max:20480', // 20MB
            'audio_duration' => 'nullable|integer',
            'is_pinned' => 'nullable',
        ]);

        $coverImage = $request->input('cover_image');
        if ($request->hasFile('cover_file') && $request->file('cover_file')->isValid()) {
            $file = $request->file('cover_file');
            $data = file_get_contents($file->getRealPath());
            $coverImage = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($data);
        }

        $audioFile = $request->input('audio_file');
        if ($request->hasFile('audio_upload') && $request->file('audio_upload')->isValid()) {
            $file = $request->file('audio_upload');
            $data = file_get_contents($file->getRealPath());
            $audioFile = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($data);
        }

        $news = News::create([
            'user_id' => $user->id,
            'title' => trim($validated['title']),
            'content' => trim($validated['content']),
            'category' => $validated['category'] ?? 'ประกาศสำคัญ',
            'cover_image' => $coverImage,
            'audio_file' => $audioFile,
            'audio_duration' => $validated['audio_duration'] ?? null,
            'is_pinned' => $request->boolean('is_pinned'),
        ]);

        return redirect()->to(url('/dashboard?view=news'))->with('success', 'เผยแพร่ข่าวสารเรียบร้อยแล้ว');
    }

    /**
     * Update an existing news article.
     * Restricted strictly to ผู้บริหาร / แอดมิน.
     */
    public function update(Request $request, News $news)
    {
        $user = auth()->user();

        if (!$user || !$user->canManageNews()) {
            abort(403, 'คุณไม่มีสิทธิ์ในการแก้ไขข่าวสาร');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'cover_image' => 'nullable|string',
            'cover_file' => 'nullable|image|max:10240',
            'audio_file' => 'nullable|string',
            'audio_upload' => 'nullable|mimes:mp3,wav,ogg,webm,m4a|max:20480',
            'audio_duration' => 'nullable|integer',
            'is_pinned' => 'nullable',
            'remove_cover' => 'nullable|boolean',
            'remove_audio' => 'nullable|boolean',
        ]);

        $coverImage = $news->cover_image;
        if ($request->boolean('remove_cover')) {
            $coverImage = null;
        } elseif ($request->filled('cover_image')) {
            $coverImage = $request->input('cover_image');
        } elseif ($request->hasFile('cover_file') && $request->file('cover_file')->isValid()) {
            $file = $request->file('cover_file');
            $data = file_get_contents($file->getRealPath());
            $coverImage = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($data);
        }

        $audioFile = $news->audio_file;
        $audioDuration = $news->audio_duration;
        if ($request->boolean('remove_audio')) {
            $audioFile = null;
            $audioDuration = null;
        } elseif ($request->filled('audio_file')) {
            $audioFile = $request->input('audio_file');
            $audioDuration = $request->input('audio_duration', $audioDuration);
        } elseif ($request->hasFile('audio_upload') && $request->file('audio_upload')->isValid()) {
            $file = $request->file('audio_upload');
            $data = file_get_contents($file->getRealPath());
            $audioFile = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($data);
            $audioDuration = $request->input('audio_duration', $audioDuration);
        }

        $news->update([
            'title' => trim($validated['title']),
            'content' => trim($validated['content']),
            'category' => $validated['category'],
            'cover_image' => $coverImage,
            'audio_file' => $audioFile,
            'audio_duration' => $audioDuration,
            'is_pinned' => $request->boolean('is_pinned'),
        ]);

        return redirect()->to(url('/dashboard?view=news'))->with('success', 'แก้ไขข่าวสารเรียบร้อยแล้ว');
    }

    /**
     * Delete a news article.
     * Restricted strictly to ผู้บริหาร / แอดมิน.
     */
    public function destroy(News $news)
    {
        $user = auth()->user();

        if (!$user || !$user->canManageNews()) {
            abort(403, 'คุณไม่มีสิทธิ์ในการลบข่าวสาร');
        }

        $news->delete();

        return redirect()->to(url('/dashboard?view=news'))->with('success', 'ลบข่าวสารเรียบร้อยแล้ว');
    }

    /**
     * Toggle pinned status.
     * Restricted strictly to ผู้บริหาร / แอดมิน.
     */
    public function togglePin(News $news)
    {
        $user = auth()->user();

        if (!$user || !$user->canManageNews()) {
            abort(403, 'คุณไม่มีสิทธิ์');
        }

        $news->update(['is_pinned' => !$news->is_pinned]);

        if (request()->wantsJson()) {
            return response()->json(['is_pinned' => $news->is_pinned]);
        }

        return redirect()->to(url('/dashboard?view=news'))->with('success', $news->is_pinned ? 'ปักหมุดข่าวนี้แล้ว' : 'ยกเลิกการปักหมุดแล้ว');
    }

    /**
     * Toggle like/reaction on a news article.
     * Available for all authenticated users (Employees, Managers, Executives).
     */
    public function toggleLike(News $news)
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $like = NewsLike::where('news_id', $news->id)->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            NewsLike::create([
                'news_id' => $news->id,
                'user_id' => $user->id,
            ]);
            $liked = true;
        }

        $likesCount = $news->likes()->count();

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $likesCount,
            ]);
        }

        return redirect()->back();
    }
}
