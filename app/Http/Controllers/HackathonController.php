<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\accounts;
use App\Models\comments;

class HackathonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Đếm số lượng tài khoản có islike = 1
        $count = accounts::where('islike', 1)->count();

        // Lưu giá trị islike vào session
        session()->put('islike', $user->islike);
        $islike = $user->islike;
        // Lấy tất cả bình luận cha (parent_id = NULL) và lấy luôn các replies
        $comments = comments::with('replies', 'account')->whereNull('parent_id')->orderBy('created_at', 'desc')->get();

        // Trả về view với các biến cần thiết
        return view('hackathon.pages.hackathon', [
            'data' => [
                'user' => $user,
                'count' => $count,
                'islike' => $islike // Trả về giá trị islike của người dùng hiện tại
            ],
            'comments' => $comments
        ]);
    }

    public function vote(Request $request)
    {
        $user = Auth::user(); // Lấy user hiện tại (nếu đã đăng nhập)

        $user->update([
            'islike' => 1 // Cập nhật giá trị isLike
        ]);
        $followersCount = accounts::where('islike', 1)->count(); // Đếm số lượng người theo dõi

        return response()->json([
            'success' => true,
            'message' => 'Bạn đã bình chọn thành công!',
            'count' => $followersCount // Trả về số lượng followers
        ]);
    }
    public function createcomment(Request $request)
    {
        $user_id = Auth::id();

        // Thực hiện validate
        $request->validate([
            'content' => 'required|max:500',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        // Tạo comment
        $comment = comments::create([
            'id_accounts' => $user_id,
            'content' => $request->input('content'),
            'parent_id' => $request->input('parent_id')
        ]);

        // Kiểm tra nếu là yêu cầu AJAX
        if ($request->ajax()) {
            $comment_html = view('hackathon.partials.comment', ['comment' => $comment, 'level' => 0])->render();

            return response()->json([
                'success' => true,
                'comment_html' => $comment_html
            ]);
        }

        return redirect()->back()->with('success', 'Bình luận thành công!');
    }
    public function getComments(Request $request)
    {
        $page = $request->input('page', 1);
        $commentsPerPage = 20;

        $comments = comments::whereNull('parent_id')
            ->with('replies', 'account')
            ->latest()
            ->paginate($commentsPerPage, ['*'], 'page', $page);

        if ($request->ajax()) {
            $commentHtml = '';
            foreach ($comments as $comment) {
                $commentHtml .= view('hackathon.partials.comment', ['comment' => $comment, 'level' => 0])->render();
            }

            return response()->json([
                'success' => true,
                'comment_html' => $commentHtml,
                'has_more' => $comments->hasMorePages()
            ]);
        }

        return view('comments.index', compact('comments'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
