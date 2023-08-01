<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('admins')->user())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login.index');
    }

    //ログイン
    public function login(Request $request)
    {
        $credentials = $request->only(['name', 'password']);

        if (Auth::guard('admins')->attempt($credentials)) 
        {
            return redirect()->route('admin.dashboard')->with([
                'login_msg' => 'ログインしました。',
            ]);
        }

        return back()->withErrors([
            'login' => ['ログインに失敗しました'],
        ]);
    }

    //ログアウト
    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.index')->with([
        'logout_msg' => 'ログアウトしました',
        ]);
    }
}
