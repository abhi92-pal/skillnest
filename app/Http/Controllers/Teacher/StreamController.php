<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Course;
use App\Models\Coursecategory;
use App\Models\Lession;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    /**
     * This list will be used for Dropdown
     */

    public function getContent(Lession $lession)
    {
        // $user = Auth::user();

        $token = Str::uuid()->toString();

        Cache::put(
            "content_token_$token",
            [
                // 'user_id'    => $user->id,
                'user_id'    => '1',
                'lession_id' => $lession->id
            ],
            now()->addMinutes(5)
        );

        return response()->json([
            'stream_url' => route("teacher.content.stream", $token),
            'type'       => $lession->type
        ]);
    }

    public function stream($token)
    {
        $data = Cache::get("content_token_$token");

        if (!$data) {
            abort(403, 'Invalid or expired token');
        }

        $lession = Lession::findOrFail($data['lession_id']);

        // Optional: one-time token
        // Cache::forget("content_token_$token");
        Cache::put("content_token_$token", now()->addMinutes(5));

        $path = storage_path("app/private/{$lession->content_url}");
        
        if (!file_exists($path)) {
            abort(404);
        }

        if ($lession->type === 'Video') {
            return response()->stream(function () use ($path) {
                readfile($path);
            }, 200, [
                'Content-Type' => 'video/mp4',
                'Accept-Ranges' => 'bytes',
            ]);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="document.pdf"',
            'Cache-Control' => 'no-store, no-cache, must-revalidate',
            'Pragma' => 'no-cache',
        ]);
    }
}
