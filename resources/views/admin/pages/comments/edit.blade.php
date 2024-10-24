@extends('admin.layout')
@section('', '')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid" style="margin: 15px 5px">
            <h1>Đây Là Trang Sửa Danh Mục Bài Viết </h1>
            <div>
                <form action={{ route('admin.catetories.update', $data->id) }} method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description" value="{{ $data->description }}">
                    </div>
                    <button type="submit" class="btn btn-default">Sửa Danh Mục Bài Viết</button>
                </form>
            </div>
        </div>
    </div>
@endsection
