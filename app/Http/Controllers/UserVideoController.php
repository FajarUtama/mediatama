<?php

namespace App\Http\Controllers;

use App\Models\RequestAccess;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $user_id = Auth::id();

        $requests = RequestAccess::where('id_user', $user_id)->get();

        $access_status = [];

        foreach ($videos as $video) {
            $request = $requests->firstWhere('id_video', $video->id_video);
            if ($request && $request->allow_access) {
                // Jika waktu sudah expired, set allow_access ke 0
                if (now()->greaterThan($request->time_expired)) {
                    $request->allow_access = 0;
                    $request->save();
                }
            }
            $access_status[$video->id_video] = $request ? $request->allow_access : 0;
        }

        return view('home', compact('videos', 'requests', 'access_status'));
    }

    public function requestAccess($video_id)
    {
        $user_id = Auth::id();
        $existingRequest = RequestAccess::where('id_user', $user_id)->where('id_video', $video_id)->first();

        if (!$existingRequest) {
            RequestAccess::create([
                'id_video' => $video_id,
                'id_user' => $user_id,
                'id_admin' => null,
                'time_accept' => null,
                'time_expired' => null,
                'allow_access' => 0,
            ]);

            return redirect()->route('home')->with('success', 'Access request sent successfully.');
        }

        return redirect()->route('home')->with('error', 'You have already requested access for this video.');
    }
}
