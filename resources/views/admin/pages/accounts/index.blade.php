@extends('admin.layout')
@section('title', 'Danh Sách Tài Khoản')
@section('content')
    @php
        $isSearch = isset($err) ? $err : 0;
        $data_view = isset($data_show) ? $data_show : $data;
    @endphp

    <div id="page-wrapper">
        <div class="container-fluid" style="margin: 15px 5px">
            {{-- Tiêu đề trang --}}
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="margin-bottom: 0">Users</h1>
                </div>
            </div>

            {{-- Chứa các button thêm, trang chủ, tìm kiếm --}}
            <div class="row" style="margin-top: 1rem; margin-bottom: 1rem">
                <div class="col-lg-6">
                    <a href="{{ route('admin.accounts.create') }}" class="btn bg-warning">Thêm Tài Khoản</a>
                    <a href="{{ route('admin.accounts.index') }}" class="btn bg-info" style="padding: 6px 2rem;">
                        <i class="fas fa-home"></i> <!-- Cập nhật cú pháp icon Font Awesome -->
                    </a>
                </div>
                <div class="col-lg-6" style="margin: 10px 0;">
                    <form action="{{ route('admin.accounts.search') }}" method="POST">
                        @csrf
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" name="name" placeholder="Tìm kiếm..."
                                value="{{ request()->input('name') }}">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i> <!-- Cập nhật cú pháp icon Font Awesome -->
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bảng hiển thị danh sách tài khoản --}}
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-hover">
                        <thead class="bg-info">
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Islike</th>
                                <th>Status</th>
                                <th>Active</th>
                            </tr>
                        </thead>
                        <tbody class="bg-warning">
                            @if ($isSearch == 1)
                                <tr>
                                    <td colspan="5">
                                        <p style="color: red">Không tìm thấy kết quả cho nội dung bạn đang tìm kiếm, vui
                                            lòng tìm kiếm lại</p>
                                    </td>
                                </tr>
                            @else
                                @php
                                    $stt = ($data_view->currentPage() - 1) * $data_view->perPage() + 1;
                                @endphp
                                @foreach ($data_view as $item)
                                    <tr>
                                        <td>{{ $stt++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->islike == 1)
                                                <i class="fas fa-heart" style="color: red;"></i> <!-- Đã thích -->
                                            @else
                                                <i class="far fa-heart" style="color: gray;"></i> <!-- Chưa thích -->
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status == 1)
                                                <i class="fas fa-check-circle" style="color: green;"></i>
                                                <!-- Đã kích hoạt -->
                                            @else
                                                <i class="fas fa-times-circle" style="color: red;"></i>
                                                <!-- Chưa kích hoạt -->
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="toggle-active" data-id="{{ $item->id }}"
                                                data-active="{{ $item->status }}">
                                                @if ($item->status == 1)
                                                    <i class="fas fa-eye" style="color: rgb(0, 51, 128);"></i>
                                                    <!-- Đang hiển thị -->
                                                @else
                                                    <i class="fas fa-eye-slash" style="color: gray;"></i>
                                                    <!-- Không hiển thị -->
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{-- Liên kết phân trang --}}
                    @if ($data_view instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="clearfix">
                            <div class="hint-text">
                                Hiển thị <b>{{ $data_view->count() }}</b> trong tổng số
                                <b>{{ $data_view->total() }}</b> mục
                            </div>
                            <div class="d-flex justify-content-start pagination-wrapper" style="text-align: left;">
                                {{ $data_view->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- Thêm phần script để xử lý sự kiện --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-active').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    const currentStatus = this.getAttribute('data-active');
                    const newStatus = currentStatus == 1 ? 0 : 1;

                    // Xác nhận từ người dùng
                    if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái hiển thị?')) {
                        // Gửi yêu cầu AJAX để cập nhật trạng thái
                        fetch(`/admin/accounts/${id}/active`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    status: newStatus
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Cập nhật giao diện mà không cần tải lại trang
                                    window.location.reload();
                                } else {
                                    alert('Cập nhật trạng thái thất bại!');
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                            });
                    }
                });
            });
        });
    </script>
@endsection
