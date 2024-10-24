<?php

namespace App\Http\Controllers;

use App\Models\accounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class accountsController extends Controller
{
    public function index()
    {
        $data = accounts::paginate(12); // 10 dòng data mỗi trang
        return view("admin.pages.accounts.index", compact('data'));
    }


    public function create()
    {
        return View("admin.pages.accounts.add");
    }

    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Lưu tài khoản mới vào cơ sở dữ liệu
        accounts::create([
            'username' => $request->input('name'),
            'password' => bcrypt($request->input('description')), // mã hóa password
            'name' => $request->input('name'),
            'birdday' => $request->input('birdday'),
            'img' => $imagePath ?? null, // Lưu đường dẫn hình ảnh (nếu có)

        ]);

        return redirect()->route('admin.accounts.index')->with('success', 'Tạo tài khoản thành công!');
    }


    public function show(string $id)
    {
        $data_show = accounts::find($id);
        return redirect()->route('admin.accounts.index')->with("data_search", $data_show);
    }


    public function edit(string $id)
    {
        $data = accounts::find($id);
        return View("admin.pages.accounts.edit_user")->with("data",  $data);
    }

    public function update(Request $request, string $id)
    {
        // cách 1
        // $data_update = accounts::find($id);
        // if($data_update){
        //     $data_update->name = $request->input("name");
        //     $data_update->description = $request->input("description");
        //     $data_update->save();
        // }
        // cách 2
        accounts::find($id)->update(['name' => $request->input("name"), 'password' => $request->input("password"), 'bridthday' => $request->input("bridthday")]);
        $request->session()->invalidate(); // Hủy session hiện tại
        $request->session()->regenerateToken(); // Tạo token CSRF mới để tránh tấn công CSRF
        return redirect()->route('showlogin'); // Chuyển hướng về trang đăng nhập
    }

    public function destroy(string $id)
    {
        accounts::find($id)->delete();
        return Redirect::to('admin/accounts');
    }

    public function search(Request $request)
    {
        $data_input = $request->input('name');
        $query = accounts::where('name', 'LIKE', '%' . $data_input . '%');

        $data_show = $query->paginate(10)->appends(['name' => $data_input]);

        if ($data_show->isEmpty()) {
            $err = 1;
        } else {
            $err = 0;
        }

        return view('admin.pages.accounts.index', compact('data_show', 'err'));
    }

    public function updateActive(Request $request, $id)
    {
        $account = Accounts::find($id);
        $account->status = $request->status;
        $account->save();

        return response()->json(['success' => true]);
    }

    public function liked(Request $request, $id)
    {
        $account = accounts::find($id);
        $account->isLike = !$account->islike;
        $account->save();

        return response()->json(['success' => true]);
    }
}
