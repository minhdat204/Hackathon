<?php

use App\Http\Controllers\accountsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\commentsController;
use App\Http\Controllers\HackathonController;
use App\Http\Controllers\UserController;
use App\Models\comments;
use Illuminate\Support\Facades\Route;


//trang chinh
Route::get('/', [AuthController::class, 'showLogin'])->name('showlogin');
Route::Post('/login', [AuthController::class, 'login'])->name('login');
//sau khi dang nhap
Route::middleware(['auth'])->group(function () {
    Route::get('/hackathon', [HackathonController::class, 'index'])->name('hackathon');
    Route::Post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::Post('/vote', [HackathonController::class, 'vote'])->name('vote');
    Route::post('/createcomment', [HackathonController::class, 'createcomment'])->name('createcomment');
    Route::get('/get-comments', [HackathonController::class, 'getComments'])->name('getcomments');
});

//admin
Route::resource('admin/accounts', accountsController::class)->names([
    'index' => 'admin.accounts.index',
    'create' => 'admin.accounts.create',
    'store' => 'admin.accounts.store',
    'show' => 'admin.accounts.show',
    'edit' => 'admin.accounts.edit',
    'update' => 'admin.accounts.update',
    'destroy' => 'admin.accounts.destroy',
]);
Route::post('/admin/accounts/{id}/active', [AccountsController::class, 'updateActive'])->name('admin.accounts.updateActive');


Route::controller(AccountsController::class)->group(function () {
    route::post("/admin/accounts/search", "search")->name("admin.accounts.search");
});

Route::resource('admin/comments', commentsController::class)->names([
    'index' => 'admin.comments.index',
    'update' => 'admin.comments.update',

]);

Route::controller(commentsController::class)->group(function () {
    route::post("/admin/comments/search", "search")->name("admin.comments.search");
});
Route::post('/admin/comments/{id}/status', [CommentsController::class, 'updateStatus'])->name('admin.comments.updateStatus');