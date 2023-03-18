<?php

namespace App\Http\Controllers\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonalController extends Controller
{
    public function signUp(Request $request)
    {
        $request->flash();
        // dd(User::where())
        $errs = [];
        if (!$request->login) $errs['login'] = 'Логин обязательное поле!';
        if (!$request->email) $errs['email'] = 'Почта обязательное поле!';
        if ($request->email && User::where("login", $request->login)->get()->isNotEmpty()) $errs['loginReapet'] = 'Данный логин уже используется!';
        if ($request->email && User::where("email", $request->email)->get()->isNotEmpty()) $errs['emailReapet'] = 'Данная почта уже используется!';
        if (!$request->passwd) $errs['passwd'] = 'Пароль обязательное поле!';
        if (!$request->confirmPasswd) $errs['confirmPasswd'] = 'Подтверждение пароля обязательное поле!';
        if ($request->confirmPasswd != $request->passwd) $errs['passwdMore'] = 'Пароли не совпадают!';
        if ($errs) return redirect()->back()->withErrors($errs);

        $user = new User();
        $user->role = 'USER';
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = $request->passwd;
        $user->save();

        if (Auth::attempt(['password' => $request->passwd, 'email' => $request->email])) {
            return redirect()->route('home');
        }
    }

    public function login(Request $request)
    {
        $request->flash();

        $errs = [];
        if (!$request->passwd) $errs['passwd'] = 'Пароль обязательное поле!';
        if (!$request->email) $errs['email'] = 'Почта обязательное поле!';
        if ($errs) return redirect()->back()->withErrors($errs);

        if (Auth::attempt(['password' => $request->passwd, 'email' => $request->email])) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['error' => 'Пользователь не найден!']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
