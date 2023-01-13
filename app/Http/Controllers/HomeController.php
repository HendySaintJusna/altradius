<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Invitation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        if (Auth::check()) {
            $user = User::where('id',Auth::id())->get();
            $url = User::where('id',Auth::id())->value('url_account');
            $noti = Invitation::where('url_target',$url)->where('status','pending')->get();
            $members = Invitation::where('url_target',$url)->where('status','accepted')->get();
            return view('home',
                [
                    'user' => $user,
                    'noti' => $noti,
                    'members' => $members
                ]
            );
        } else {
            return view('welcome');
        }
        
        
    }
}
