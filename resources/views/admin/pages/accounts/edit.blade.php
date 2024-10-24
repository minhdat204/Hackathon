@extends('admin.layout')
@section('title', 'Sửa Tài Khoản')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid" style="margin: 15px 5px">
            <h1>Đây Là Trang Sửa Tài Khoản</h1>
            <div>
                <form action="{{ route('admin.accounts.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $data->name }}">
                    </div>

                    <div class="form-group">
                        <label for="islike">Is Like</label>
                        <input type="number" class="form-control" name="islike" value="{{ $data->islike }}">
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" name="status">
                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Cập Nhật Tài Khoản</button>
                </form>
            </div>
        </div>
    </div>
@endsection
