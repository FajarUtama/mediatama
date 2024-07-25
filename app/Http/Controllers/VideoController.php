<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\RequestAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $requests = RequestAccess::all(); 

        return view('admin.videos.index', compact('videos', 'requests'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_video' => 'required',
            'video_file' => 'required|mimes:mp4,mov,avi,flv|max:20480', 
        ]);

        $path = $request->file('video_file')->store('videos', 'public'); 

        Video::create([
            'title_video' => $request->title_video,
            'location_video' => $path, 
        ]);

        return redirect()->route('videos.index')->with('success', 'Video created successfully.');
    }


    public function show($id_video)
    {
        $video = Video::findOrFail($id_video);
        $user_id = Auth::id();
        $requestAccess = RequestAccess::where('id_video', $id_video)
            ->where('id_user', $user_id)
            ->first();

        $hasAccess = false;
        $isExpired = false;

        if ($requestAccess) {
            if ($requestAccess->allow_access && now()->lessThan($requestAccess->time_expired)) {
                $hasAccess = true;
            } else {
                $requestAccess->allow_access = 0;
                $requestAccess->save();
                $isExpired = true;
            }
        }

        return view('admin.videos.show', compact('video', 'hasAccess', 'isExpired', 'requestAccess'));
    }

    public function edit($id_video)
    {
        $video = Video::findOrFail($id_video);
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, $id_video)
    {
        $request->validate([
            'title_video' => 'required',
            'location_video' => 'required',
        ]);

        $video = Video::findOrFail($id_video);
        $video->update($request->all());

        return redirect()->route('videos.index')->with('success', 'Video updated successfully.');
    }

    public function destroy($id_video)
    {
        Video::destroy($id_video);
        return redirect()->route('videos.index')->with('success', 'Video deleted successfully.');
    }

    public function requestAccess($videoId, Request $request)
    {
        $userId = auth()->user()->id;

        // Cek apakah sudah ada request untuk video ini dari user ini
        $existingRequest = RequestAccess::where('id_video', $videoId)
                                        ->where('id_user', $userId)
                                        ->first();

        if ($existingRequest) {
            // Update request yang sudah ada
            $existingRequest->allow_access = 1;
            $existingRequest->time_accept = Carbon::now();
            $existingRequest->time_expired = Carbon::now()->addHours(2);
            $existingRequest->save();
        } else {
            // Buat request baru
            RequestAccess::create([
                'id_video' => $videoId,
                'id_user' => $userId,
                'allow_access' => 1,
                'time_accept' => Carbon::now(),
                'time_expired' => Carbon::now()->addHours(2),
                'id_admin' => null, 
            ]);
        }

        return redirect()->route('home')->with('success', 'Access requested successfully.');
    }
}
