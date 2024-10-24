<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comments;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = comments::paginate(10);

        // Định dạng lại thời gian

        return view('admin.Pages.comments.index', compact('data'));
    }
    public function search(Request $request)
    {
        // Lấy dữ liệu tìm kiếm từ input
        $data_input = $request->input('content');

        // Tìm kiếm trong bảng comments theo nội dung
        $data_show['data'] = comments::where('content', 'LIKE', '%' . $data_input . '%')->get();

        // Kiểm tra có dữ liệu hay không
        $data_show['err'] = count($data_show['data']) == 0 ? 2 : 1; // 2: không có kết quả, 1: có kết quả

        // Trả về view với kết quả tìm kiếm
        return view('admin.Pages.comments.index')->with("data_search", $data_show);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {}

    /**
     * Update the status of the specified comment.
     */
    public function updateStatus(Request $request, string $id)
    {
        $comment = comments::findOrFail($id);
        $comment->status = $request->status;
        $comment->save();

        return response()->json(['success' => true]);
    }
}
