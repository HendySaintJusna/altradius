<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Storage;

use App\Models\User;

class socialNetworkController extends Controller
{



    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    // public function redirectToInstagramProvider()
    // {
    //     $appId = config('services.instagram.client_id');
    //     $redirectUri = urlencode(config('services.instagram.redirect'));
    //     return redirect()->to("https://api.instagram.com/oauth/authorize?client_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    // }

    // public function redirectToInstagramProvider2()
    // {
    //     Cookie::queue('mycookie', $url, 5);
    //     $appId = config('services.instagram.client_id');
    //     $redirectUri = urlencode(config('services.instagram.redirect'));
    //     return redirect()->to("https://api.instagram.com/oauth/authorize?client_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    // }

    // public function instagramProviderCallback(Request $request)
    // {
    //     $code = $request->code;
    //     if (empty($code)) return redirect()->route('home')->with('error', 'Failed to login with Instagram.');

    //     $appId = config('services.instagram.client_id');
    //     $secret = config('services.instagram.client_secret');
    //     $redirectUri = config('services.instagram.redirect');

    //     $client = new Client();

    //     // Get access token
    //     $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
    //         'form_params' => [
    //             'app_id' => $appId,
    //             'app_secret' => $secret,
    //             'grant_type' => 'authorization_code',
    //             'redirect_uri' => $redirectUri,
    //             'code' => $code,
    //         ]
    //     ]);

    //     if ($response->getStatusCode() != 200) {
    //         return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
    //     }

    //     $content = $response->getBody()->getContents();
    //     $content = json_decode($content);

    //     $accessToken = $content->access_token;
    //     $userId = $content->user_id;

    //     // Get user info
    //     $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");

    //     $content = $response->getBody()->getContents();
    //     $oAuth = json_decode($content);

    //     // Get instagram user name 
    //     $username = $oAuth->username;

    //     // return dd($content);
    //     // do your code here


    //     $rand = Str::random(4);
    //     $name = $oAuth->username;
    //     $email = $name.$rand.'@gmail.com';
        

    //     User::firstOrCreate([
    //         'token' => $oAuth->id
    //     ], [
    //         'token' => $oAuth->id,
    //         'url_account' => Str::slug($name, '-'),
    //         'social_network' => 'Instagram',
    //         'membership' => null,
    //         'email' => $email,
    //         'logline,' => null,
    //         'avatar' => 'null',
    //         'name' => $name,
    //         'password' => \Hash::make(Str::random(24)),
    //     ]);


    //     $findUser = User::where('token', $oAuth->id)->first();
    //     $db_name = User::where('token', $oAuth->id)->value('name');
    //     if ($name != $db_name) {
    //         User::where('token', $oAuth->id)->update([
    //             'name' => $name,
    //             'url_account' => Str::slug($name, '-')
    //         ]);
    //     }

        
    //     Auth::login($findUser,true);

    //     if (Cookie::get('mycookie') !== null) {
    //         return redirect('/'.Cookie::get('mycookie'));
    //     } else {
    //         return redirect('/home');
    //     }



    // }





    public function redirectToSignIn($url){
        return view('auth/registerandredirect',['url' => $url]);
    }


    public function loginForm(){
        return view('auth/login');
    }


    //REDIRECT

    // public function twitter2($url){
    //     Cookie::queue('mycookie', $url, 5);
    //     if (Cookie::get('explaination') == null && Cookie::get('explaination-finish') == null) {
    //         \Cookie::queue('explaination', 'true', 43800);

    //     }
    //     return \Socialite::driver('twitter')->redirect();
    // }


    // public function facebook2($url){
    //     Cookie::queue('mycookie', $url, 5);
    //     if (Cookie::get('explaination') == null && Cookie::get('explaination-finish') == null) {
    //         \Cookie::queue('explaination', 'true', 43800);

    //     }
    //     return \Socialite::driver('facebook')->redirect();
    // }

    // public function linkedin2($url){
    //     Cookie::queue('mycookie', $url, 5);
    //     if (Cookie::get('explaination') == null && Cookie::get('explaination-finish') == null) {
    //         \Cookie::queue('explaination', 'true', 43800);

    //     }
    //     return \Socialite::driver('linkedin')->redirect();
    // }

    // NOT REDIRECT


    public function twitter(){
        if (Cookie::get('explaination') == null && Cookie::get('explaination-finish') == null) {
            \Cookie::queue('explaination', 'true', 43800);

        }

        return Socialite::driver('twitter')->redirect();
    }


    public function twitterRedirect(){

        $rand = Str::random(4);
        $url = Str::random(5);

        $user = Socialite::driver('twitter')->user();
        // dd($user);

        $email = $user->nickname.$rand.'@gmail.com';
        $name = $user->nickname;

        $urlimg = $user->attributes["avatar_original"];
        $img = file_get_contents($urlimg);
        $filePath = public_path('/img/avatar');
        $randomstring = \Str::random(10);

        $is_jpg = str_contains($urlimg, 'jpg');
        $is_jpeg = str_contains($urlimg, 'jpeg');
        $is_png = str_contains($urlimg, 'png');

        if ($is_jpg) {
            $nameimg = $randomstring.'.jpg';
        } else if($is_jpeg) {
            $nameimg = $randomstring.'.jpeg';
        }else{
            $nameimg = $randomstring.'.png';
        }
          
        Storage::put($nameimg, $img);

        User::firstOrCreate([
            'token' => $user->token
        ], [
            'token' => $user->token,
            'url_account' => Str::slug($user->nickname, '-'),
            'social_network' => 'Twitter',
            'followers' => $user->user["followers_count"],
            'membership' => null,
            'email' => $email,
            'logline,' => null,
            'avatar' => $nameimg,
            'name' => $name,
            'password' => \Hash::make(Str::random(24)),
        ]);

        $findUser = User::where('token', $user->token)->first();

        //ne pas oublier de faire following refresh chaque mois
        
        Auth::login($findUser,true);

        if (Cookie::get('mycookie') !== null) {
            return redirect('/'.Cookie::get('mycookie'));
        } else {
            return redirect('/home');
        }
        

        
       
    }


    // public function facebook(){
    //     if (Cookie::get('explaination') == null && Cookie::get('explaination-finish') == null) {
    //         \Cookie::queue('explaination', 'true', 43800);

    //     }
    //     return \Socialite::driver('facebook')->redirect();
    // }

    // public function facebookRedirect(){
    //     $rand = Str::random(4);
    //     $url = Str::random(5);

    //     $user = \Socialite::driver('facebook')->user();
    //     // dd($user);
        
    //     $email = $user->getEmail();

    //     User::firstOrCreate([
    //         'email' => $email
    //     ], [
    //         'token' => $user->token,
    //         'url_account' => Str::slug($user->getName(), '-'),
    //         'social_network' => 'Facebook',
    //         'membership' => null,
    //         'logline,' => null,
    //         'avatar' => 'null',
    //         'name' => $user->getName(),
    //         'password' => \Hash::make(Str::random(24)),
    //     ]);

    //     $findUser = User::where('email', $email)->first();
        
    //     Auth::login($findUser,true);

    //     if (Cookie::get('mycookie') !== null) {
    //         return redirect('/'.Cookie::get('mycookie'));
    //     } else {
    //         return redirect('/home');
    //     }

    // }



    // public function linkedin(){
    //     if (Cookie::get('explaination') == null && Cookie::get('explaination-finish') == null) {
    //         \Cookie::queue('explaination', 'true', 43800);

    //     }
    //     return \Socialite::driver('linkedin')->redirect();
    // }

    // public function linkedinRedirect(){
    //     $rand = Str::random(4);
    //     $url = Str::random(5);

    //     $user = \Socialite::driver('linkedin')->user();
    //     // dd($user);
        
    //     $email = $user->getEmail();

    //     $nameslug = $user->getName();
    //     $checknameslug = User::where('url_account',Str::slug($nameslug, '-'))->count();
    //     $count = 1;
    //     while ($checknameslug == 1) {
    //         $nameslug = $nameslug."".$count;
    //         $count++;
    //         $checknameslug = User::where('url_account',$nameslug)->count();
    //     }


    //     User::firstOrCreate([
    //         'email' => $email
    //     ], [
    //         'token' => $user->token,
    //         'url_account' => Str::slug($nameslug, '-'),
    //         'social_network' => 'Linkedin',
    //         'membership' => null,
    //         'logline,' => null,
    //         'avatar' => 'null',
    //         'name' => $user->getName(),
    //         'password' => \Hash::make(Str::random(24)),
    //     ]);

    //     $findUser = User::where('email', $email)->first();
        
    //     Auth::login($findUser,true);

    //     if (Cookie::get('mycookie') !== null) {
    //         return redirect('/'.Cookie::get('mycookie'));
    //     } else {
    //         return redirect('/home');
    //     }

    // }



}
