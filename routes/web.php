<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Invitation;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//COOKIE

Route::get('/explaination/finish', function () {
	$user = User::where('id',Auth::id())->get();
    $url = User::where('id',Auth::id())->value('url_account');
    $noti = Invitation::where('url_target',$url)->where('status','pending')->get();
    $members = Invitation::where('url_target',$url)->where('status','accepted')->get();
	\Cookie::queue(\Cookie::forget('explaination'));
	\Cookie::queue('explaination-finish', 'true', 43800);
    return view('home',
        [
            'user' => $user,
            'noti' => $noti,
            'members' => $members
        ]
    );
});

Route::get('/help', function () {
    return view('help');
});




Route::group(['middleware' => 'guest'], function(){

	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('/register/instagram', function () {
	    return view('auth/registerinsta');
	});

	Route::get('/login/instagram', function () {
	    return view('auth/logininsta');
	});


	Route::get('login/instagram/s/{url}',[App\Http\Controllers\Auth\socialNetworkController::class, 'redirectToInstagramProvider2'])->name('instagram.login');

	Route::get('/sign-in/linkedin', [App\Http\Controllers\Auth\socialNetworkController::class, 'linkedin']);

	Route::get('/sign-in/linkedin/s/{url}', [App\Http\Controllers\Auth\socialNetworkController::class, 'linkedin2']);

	Route::get('/sign-in/linkedin/redirect', [App\Http\Controllers\Auth\socialNetworkController::class, 'linkedinRedirect']);

	Route::get('/sign-in/twitter', [App\Http\Controllers\Auth\socialNetworkController::class, 'twitter']);

	Route::get('/sign-in/twitter/s/{url}', [App\Http\Controllers\Auth\socialNetworkController::class, 'twitter2']);

	Route::get('/sign-in/twitter/redirect', [App\Http\Controllers\Auth\socialNetworkController::class, 'twitterRedirect']);

	Route::get('/sign-in/facebook', [App\Http\Controllers\Auth\socialNetworkController::class, 'facebook']);

	Route::get('/sign-in/facebook/s/{url}', [App\Http\Controllers\Auth\socialNetworkController::class, 'facebook2']);

	Route::get('/sign-in/facebook/redirect', [App\Http\Controllers\Auth\socialNetworkController::class, 'facebookRedirect']);

	Route::get('/sign-in/from/{url}', [App\Http\Controllers\Auth\socialNetworkController::class, 'redirectToSignIn']);

});


Route::group(['middleware' => 'auth'], function(){


	Route::group(['middleware' => 'explaination'], function(){


		Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

		Route::get('/get/user', [App\Http\Controllers\UserController::class, 'getInfo']);

		Route::post('/change/logline', [App\Http\Controllers\UserController::class, 'logline']);

		Route::post('/update/avatar', [App\Http\Controllers\UserController::class, 'avatar']);

		Route::post('/invitation/{url}', [App\Http\Controllers\UserController::class, 'invitation']);

		Route::post('/add/member/{id}', [App\Http\Controllers\UserController::class, 'addMember']);

		Route::post('/refuse/member/{id}', [App\Http\Controllers\UserController::class, 'refuseMember']);

	
	});

});





Auth::routes();

Route::get('/{url}', [App\Http\Controllers\UserController::class, 'profile']);





