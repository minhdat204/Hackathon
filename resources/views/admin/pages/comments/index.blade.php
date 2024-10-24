@extends('admin.layout')
@section('title', 'Danh Sách Bình Luận')
@section('content')
    @php
        $isSearch = 0;
        $data_view = null;
        if (isset($data_search)) {
            if ($data_search['err'] == 0) {
                $isSearch = 1;
            } else {
                $isSearch = 2;
                $data_view = $data_search['data'];
            }
        } else {
            $data_view = $data;
        }
    @endphp

    <div id="page-wrapper">
        <div class="container-fluid" style="margin: 15px 5px">
            {{-- Tiêu đề trang --}}
            <div class="row">
                <div class="col-lg-12">
                    <h1 style="margin-bottom: 0">Comments</h1>
                </div>
            </div>

            {{-- Chứa các button thêm, trang chủ, tìm kiếm --}}
            <div class="row" style="margin-top: 1rem; margin-bottom: 1rem">
                <div class="col-lg-6">
                    <a href={{ route('admin.comments.index') }} class="btn bg-info" style="padding: 6px 2rem;">
                        <i class="fa fa-home"></i>
                    </a>
                </div>
                <div class="col-lg-6" style="margin: 10px 0;">
                    <form action={{ route('admin.comments.search') }} method="POST">
                        @csrf
                        @method('POST')
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" name="content" placeholder="Tìm kiếm bình luận...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Bảng hiển thị danh sách bình luận --}}
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-hover">
                        <thead class="bg-info">
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-warning">
                            @if ($isSearch == 1)
                                <p style="color: red">Không tìm thấy kết quả cho nội dung bạn đang tìm kiếm, vui lòng tìm
                                    kiếm lại</p>
                            @else
                                @php $stt = 1; @endphp
                                @foreach ($data_view as $item)
                                    <tr>
                                        <td>{{ $stt++ }}</td>
                                        <td>{{ $item->account->name ?? 'N/A' }}</td> {{-- Lấy tên tài khoản --}}
                                        <td>{{ $item->content }}</td>
                                        <td>
                                            <a href="#" class="toggle-status" data-id="{{ $item->id }}"
                                                data-status="{{ $item->status }}">
                                                @if ($item->status == 1)
                                                    <i class="fa fa-check-circle" style="color: green;"></i>
                                                @else
                                                    <i class="fa fa-times-circle" style="color: red;"></i>
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    {{-- Phân Trang --}}
                    @if ($data_view instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="clearfix">
                            <div class="hint-text">
                                Hiển thị <b>{{ $data_view->count() }}</b> trong tổng số
                                <b>{{ $data_view->total() }}</b> mục
                            </div>
                            <div class="d-flex justify-content-start pagination-wrapper">
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
            document.querySelectorAll('.toggle-status').forEach(function(element) {
                element.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');
                    const currentStatus = this.getAttribute('data-status');
                    const newStatus = currentStatus == 1 ? 0 : 1;

                    // Xác nhận từ người dùng
                    if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái bình luận?')) {
                        // Gửi yêu cầu AJAX để cập nhật trạng thái
                        fetch(`/admin/comments/${id}/status`, {
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
