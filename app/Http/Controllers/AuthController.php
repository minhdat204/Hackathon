<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('hackathon.pages.login');
    }
    public function login(Request $request)
    {
        //validate
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        //tìm username tương ứng trong csdl
        $user = accounts::where('username', $credentials['username'])->first();
        //kiểm tra nếu có user và pass trùng với nhập liệu
        if ($user && $user->password === $credentials['password']) {
            Auth::login($user); // Đăng nhập người dùng
            $request->session()->regenerate(); // Tạo token CSRF mới để tránh tấn công CSRF
            $user = Auth::user()->name;
            $user_id = Auth::user()->id;
            $request->session()->put('user_id', $user_id);
            $request->session()->put('user_name', $user);
            return redirect()->intended('hackathon');
        }
        return back()->withErrors(['login' => 'Tài khoản hoặc mật khẩu không chính xác.']);
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout(); // Đăng xuất người dùng

            $request->session()->invalidate(); // Hủy session hiện tại
            $request->session()->regenerateToken(); // Tạo token CSRF mới để tránh tấn công CSRF

            return redirect()->route('showlogin'); // Chuyển hướng về trang đăng nhập
        }
        return redirect()->route('showlogin'); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    }
}
