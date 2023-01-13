<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Invitation;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     // $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getInfo()
    {
        $user = User::where('id',Auth::id())->get();

        return $user;
    }


    public function profile($url)
    {
    	
    	$exist = User::where('url_account',$url)->count();
    	$connected = Auth::check();

    	if($connected){


    		if($exist){

	    		$user = User::where('url_account',$url)->get();
	    		$members = Invitation::where('url_target',$url)->where('status','accepted')->get();
	    		return view('profile',
		    		[
		    			'target' => $user,
		    			'connected' => $connected,
		    			'members' => $members
		    		]
		    	);
	    		
	    	} else {

	    		return redirect('/home');
	    		
	    	}



    	} else {

    		if($exist){

	    		$user = User::where('url_account',$url)->get();
	    		$members = Invitation::where('url_target',$url)->where('status','accepted')->get();
	    		return view('profile',
		    		[
		    			'target' => $user,
		    			'connected' => 0,
		    			'members' => $members
		    		]
		    	);
	    		
	    	} else {

	    		return redirect('/home');
	    		
	    	}

    	}
	
    	
    }




    public function logline(Request $request)
    {
    	User::where('id',Auth::id())->update(['logline' => $request->logline]);
    	$user = User::where('id',Auth::id())->get();
    	Invitation::where('id_owner',Auth::id())->update(['userdata' => $user]);
    }


    public function avatar(Request $request)
    {

    	$image = $request->avatar;
        $ext = $image->getClientOriginalExtension();
        // $image = \Image::make($image->path());
        $img = \Image::make($image->path());
        $filePath = public_path('/files/img/avatar');
        $name = \Str::random(10);
        $name = $name.'.'.$ext;
        
        if ($ext == 'gif') {
            $image->move($filePath, $name);
        } else {
            $img->resize(510, 600, function ($const) {
                $const->aspectRatio();
            })->save($filePath.'/'.$name);
        }
        


    	User::where('id',Auth::id())->update(['avatar' => $name]);
    	$user = User::where('id',Auth::id())->get();
    	Invitation::where('id_owner',Auth::id())->update(['userdata' => $user]);
    	return '/files/img/avatar/'.$name;

    }



    public function invitation($url){

    	$check = Invitation::where('id_owner',Auth::id())->where('url_target',$url)->count();

    	if ($check == 0) {

    		$id = Auth::id();
    		$myurl = User::where('id',Auth::id())->value('url_account');

    		if ($myurl != $url) {
    			$user = User::where('id',$id)->get();
		    	Invitation::create([
		    		'id_owner' => $id,
		    		'url_target' => $url,
		    		'status' => 'pending',
		    		'userdata' => json_encode($user)
		    	]);

		    	return 'success';
    		}
    		
    		return 'self';
    		
    	} else {
    		
    		$already_member = Invitation::where('id_owner',Auth::id())->where('url_target',$url)->where('status','accepted')->count();
    		$blocked = Invitation::where('id_owner',Auth::id())->where('url_target',$url)->where('status','blocked')->count();
    		$pending = Invitation::where('id_owner',Auth::id())->where('url_target',$url)->where('status','pending')->count();

    		if ($already_member == 1) {
    			return 'member';
    		} else if($pending == 1){
    			return 'pending';
    		}else{
				return 'blocked';
    		}
    		

    	}
    	

    }



    public function addMember($id){

    	$url = User::where('id',Auth::id())->value('url_account');
    	$count = Invitation::where('id_owner',Auth::id())->where('url_target',$url)->where('status','accepted')->count();

    	if ($count<6) {
    		
	    	Invitation::where('id_owner',$id)->where('url_target',$url)->update(['status' => 'accepted']);
	    	$notification = Invitation::where('url_target',$url)->where('status','pending')->get();
	    	$members = Invitation::where('url_target',$url)->where('status','accepted')->get();
	    	$arr = array($notification,$members);

	    	return $arr;
    		# code...
    	} else {
    		return 'full';
    	}
    	
    	
    }

    public function refuseMember($id){
    	$url = User::where('id',Auth::id())->value('url_account');
    	Invitation::where('id_owner',$id)->where('url_target',$url)->delete();
    	$notification = Invitation::where('url_target',$url)->where('status','pending')->get();
    	return $notification;
    }



}




