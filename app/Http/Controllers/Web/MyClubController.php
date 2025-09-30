<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class MyClubController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        //check user aada club
        if (!$user->club_id) {
            return redirect()->route('dashboard')->with('failed', 'Anda tidak terdaftar di klub manapun.');
        }
        $club = $user->club()->with([
            'users' => function ($query) {
                $query->with('sportClass')->orderBy('fullname', 'asc');
            }
        ])->first();

        $page_title = 'My Club';
        $page_description = 'Detail dan Anggota Klub ' . $club->name_club;

        return view('web.myclubs.index', compact('page_title', 'page_description', 'club'));
    }
}