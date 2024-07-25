<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Video;
use App\Models\RequestAccess;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $videos = Video::all();
        $requests = RequestAccess::where('id_user', $user->id_user)->get();

        return view('home', compact('videos', 'requests'));
    }
}
