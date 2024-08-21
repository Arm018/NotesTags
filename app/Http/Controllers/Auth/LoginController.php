<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use SocialiteProviders\Manager\Config;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function redirectToProvider()
    {
        return Socialite::driver('vkontakte')->redirect();

    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('vkontakte')->user();

        $existingUser = User::where('vk_id', $user->getId())->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'vk_id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail() ?? 'noemail@example.com',
                'avatar' => $user->getAvatar(),
                'password' => bcrypt(Str::password('16')),
            ]);

            Auth::login($newUser);
        }

        return redirect($this->redirectTo);
    }
}
