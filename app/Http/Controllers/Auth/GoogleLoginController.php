<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
        
        $this->GoogleUserCheck($user);
        
        return redirect()->route('controle-de-utilizacao.create');

        // $user->token;
    }
    public function GoogleUserCheck($user)
    {
        if($user->user['hd'] != "lasalle.org.br")
            abort(403, "Desculpe! Você não pode acessar com e-mail pessoal.");

        $gUser = User::where('email',$user->email)->first();
        if(empty($gUser)){
            $gUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'profile_picture' => $user->avatar,
                'token' => $user->token,
                'password' => null,
            ]);            
        }
        if(!empty($gUser->coordenador)){
            $gUser->coordenador->update([
                'profile_picture' => $user->avatar,
                'name' => $user->name,
            ]);
        }
        if(!empty($gUser->motorista)){
            $gUser->motorista->update([
                'profile_picture' => $user->avatar,
                'name' => $user->name,
            ]);
        }
        if(!empty($gUser->administrador)){
            $gUser->administrador->update([
                'profile_picture' => $user->avatar,
                'name' => $user->name,
            ]);
        }
        $gUser->profile_picture = $user->avatar;
        $gUser->save();
        Auth::login($gUser);
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
