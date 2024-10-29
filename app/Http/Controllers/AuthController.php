<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('hackathon.pages.login');
    }
    public function showRegister()
    {
        return view('hackathon.pages.register');
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'username' => 'required|unique:accounts,username|max:255',
            'password' => 'required|min:6|confirmed', // password confirmation required
            'name' => 'required|max:255',
            'bridthday' => 'nullable|date',
            'img' => 'nullable|string|max:255',
        ], [
            'username.required' => 'Vui lòng nhập username.',
            'username.unique' => 'Username đã tồn tại. Vui lòng chọn username khác.',
            'username.max' => 'Username không được vượt quá :max ký tự.',

            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',

            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',

            'bridthday.date' => 'Ngày sinh không hợp lệ.',

            'img.string' => 'Ảnh phải là một chuỗi.',
            'img.max' => 'Đường dẫn ảnh không được vượt quá :max ký tự.',
        ]);

        // Create a new user account
        $user = new accounts();
        $user->username = $request->username;
        $user->password = Hash::make($request->password); // Hash the password for security
        $user->name = $request->name;
        $user->bridthday = $request->bridthday;
        $user->img = $request->img;
        $user->islike = 0; // Default value
        $user->status = 1; // Default status
        $user->save();

        // Automatically log in the user after registration
        Auth::login($user);

        // Regenerate session and CSRF token
        $request->session()->regenerate();

        // Save user data to the session
        $request->session()->put('user_id', $user->id);
        $request->session()->put('user_name', $user->name);

        // Redirect to a specific page after registration
        return redirect()->route('showlogin')->with('success', 'Đăng ký thành công!');
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
        if ($user && ($user->password === $credentials['password'] || Hash::check($credentials['password'], $user->password))) {
            Auth::login($user); // Đăng nhập người dùng
            $request->session()->regenerate(); // Tạo token CSRF mới để tránh tấn công CSRF
            $user = Auth::user()->name;
            $user_id = Auth::user()->id;
            $request->session()->put('user_id', $user_id);
            $request->session()->put('user_name', $user);
            return redirect()->intended('hackathon')->with('success', 'Đăng nhập thành công!');
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
