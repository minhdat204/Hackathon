@extends('admin.layout')
@section('', '')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid" style="margin: 15px 5px">
            <h1>Đây là trang thêm danh mục bài viết </h1>
            <div>
                <form action={{ route('admin.catetories.store') }} method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <button type="submit" class="btn btn-default">Thêm Danh Mục Bài Viết</button>
                </form>
            </div>
        </div>
    </div>
@endsection


{{-- {{route('admin.posts.store')}} --}}
