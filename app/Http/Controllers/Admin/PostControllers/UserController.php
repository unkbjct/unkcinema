<?php

namespace App\Http\Controllers\Admin\PostControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function setUser(Request $request)
    {
        $user = User::find($request->input("id"));
        $user->role = $request->input("role");
        $user->save();

        return redirect()->back()->with([
            'success' => $request->input("role") === "ADMIN" ? "Пользователю " . $user->login . " присвоен статус \"Администратор\"" : "Пользователю " . $user->login . " присвоен статус \"Пользователь\""
        ]);
    }

    function view(Request $request)
    {
        $request->flash();
        $users = User::select();

        if ($request->has('login') && $request->login != null)
            $users->where("login", "LIKE", "%{$request->login}%")->orWhere("email", "LIKE", "%{$request->login}%");

        return view('admin.users.list', [
            'users' => $users->get()
        ]);
    }
}
