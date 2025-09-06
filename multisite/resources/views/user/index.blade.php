@extends('layouts.app')
@section('content')
<div class="m-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userCreateModal"
        id="btnCreateUser">
        <i class="bi bi-person-plus"></i> Thêm <span class="d-none d-sm-block">nhân viên</span>
    </button>
    <div class="input-group" style="max-width: 250px; float: right;">
        <span class="input-group-text" id="searching-data"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search"
            aria-describedby="searching-data" id="searchInput">
    </div>
</div>
<div id="userListData"></div>
<div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="userShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userShowModalLabel">Thông tin nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userShowModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="userCreateModal" tabindex="-1" aria-labelledby="userCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userCreateModalLabel">Thêm nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userCreateModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="userEditModal" tabindex="-1" aria-labelledby="userEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userEditModalLabel">Sửa nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userEditModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="userDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userDeleteModalLabel">Xóa nhân viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="userDeleteModalBody"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var page = 1;
    var keywords = '';
    $(function() {
        // Load danh sách user
        $('#userListData').html(shimmerloader());
        loadListData();
    });
    // khi nhấn tìm kiếm phải debaounce để tránh gọi hàm loadListData quá nhiều
    let debounceTimer;
    $('#searchInput').on('input', function() {
        // kiểm tra nó có đang xoay không
        if ($('#searching-data').find('span').length) {
            return; // Nếu đang xoay thì không làm gì cả
        }else {
            // chuyển icon #searching-data sang spinner
            $('#searching-data').html('<span class="spinner-border spinner-border-sm" role="status"></span>');
        }
        clearTimeout(debounceTimer);
        var query = $(this).val();
        debounceTimer = setTimeout(function() {
            keywords = query;
            page = 1; // Reset về trang đầu tiên khi tìm kiếm
            loadListData();
        }, 500); // Chờ 500 sau khi người dùng ngừng gõ
    });

    function loadListData() {
        setTimeout(() => {
            $.ajax({
                url: "{{ route('user.index') }}",
                type: 'GET',
                data: { page: page, keywords: keywords },
                success: function(res, status, xhr) {
                    $('#userListData').html(res);
                    // Sau khi load xong thì chuyển lại icon tìm kiếm
                    $('#searching-data').html('<i class="bi bi-search"></i>');
                },
                error: function(xhr) {
                    $('#userListData').html('<p class="text-danger">Lỗi tải dữ liệu!</p>');
                }
            });
        }, 300);
    }
</script>
@endpush
