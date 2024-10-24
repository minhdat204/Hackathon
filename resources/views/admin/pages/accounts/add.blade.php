@extends('admin.layout')
@section('title', 'Thêm Tài Khoản')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid" style="margin: 15px 5px">
            <h1>Thêm Tài Khoản</h1>

            <div>
                <form action="{{ route('admin.accounts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên người dùng</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Mật khẩu</label>
                        <input type="password" class="form-control" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="birdday">Ngày sinh</label>
                        <input type="date" class="form-control" name="birdday" required>
                    </div>
                    <div class="form-group">
                        <label for="img">Hình ảnh</label>
                        <input type="file" class="form-control" name="img" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-default">Thêm Tài Khoản</button>
                </form>
            </div>
        </div>
    </div>
@endsection
