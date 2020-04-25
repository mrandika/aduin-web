<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialite = Socialite::driver('google')->user();
     
            $user = User::where('google_id', $socialite->id)->first();
     
            if ($user) {
                Auth::login($user);
    
                return redirect('/');
     
            } else {
                $newUser = User::create([
                    'username' => explode('@', $socialite->email)[0],
                    'first_name' => $socialite->user['given_name'],
                    'last_name' => $socialite->user['family_name'],
                    'photo_url' => $socialite->avatar,
                    'email' => $socialite->email,
                    'google_id'=> $socialite->id,
                    'password' => bcrypt(explode('@', $socialite->email)[0].str_random(12))
                ]);
                Auth::login($newUser);
     
                return redirect('/');
            }
    
        } catch (Exception $e) {
            dd($e);
        }
    }
}
