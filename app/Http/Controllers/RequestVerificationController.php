<?php

namespace App\Http\Controllers;

use App\Models\RequestAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RequestVerificationController extends Controller
{
    public function index()
    {
        $requests = RequestAccess::all(); // Mendapatkan semua request akses

        return view('admin.requests.index', compact('requests'));
    }

    public function toggleAccess($id_request)
    {
        $request = RequestAccess::findOrFail($id_request);
        $adminId = Auth::id(); // Ambil ID admin yang sedang login

        if ($request->allow_access == 0) {
            // Berikan akses
            $request->allow_access = 1;
            $request->time_accept = Carbon::now();
            $request->time_expired = Carbon::now()->addHours(2);
            $request->id_admin = $adminId; 
        } else {
            // Hentikan akses
            $request->allow_access = 0;
            $request->time_accept = null;
            $request->time_expired = null;
            $request->id_admin = $adminId; 
        }
        $request->save();

        return redirect()->route('requests.index')->with('success', 'Request updated successfully.');
    }

    public function destroy($id_request)
    {
        $request = RequestAccess::findOrFail($id_request);
        $request->delete();

        return redirect()->route('requests.index')->with('success', 'Request deleted successfully.');
    }
}
