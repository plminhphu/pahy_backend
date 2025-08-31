@extends('layouts.app')
@section('content')
<div class="m-3">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#deviceCreateModal"
        id="btnCreateDevice">
        <i class="bi bi-person-plus"></i> Thêm thiết bị
    </button>
    <div class="input-group" style="max-width: 300px; float: right;">
        <span class="input-group-text" id="searching-data"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Tìm kiếm..." aria-label="Search"
            aria-describedby="searching-data" id="searchInput">
    </div>
</div>
<div id="deviceListData"></div>
<div class="modal fade" id="deviceShowModal" tabindex="-1" aria-labelledby="deviceShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deviceShowModalLabel">Thông tin thiết bị</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deviceShowModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="deviceCreateModal" tabindex="-1" aria-labelledby="deviceCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deviceCreateModalLabel">Thêm thiết bị</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deviceCreateModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="deviceEditModal" tabindex="-1" aria-labelledby="deviceEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deviceEditModalLabel">Sửa thiết bị</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deviceEditModalBody"></div>
        </div>
    </div>
</div>
<div class="modal fade" id="deviceDeleteModal" tabindex="-1" aria-labelledby="deviceDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deviceDeleteModalLabel">Xóa thiết bị</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="deviceDeleteModalBody"></div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    var page = 1;
    var keywords = '';
    $(function() {
        // Load danh sách device
        $('#deviceListData').html(shimmerloader());
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
                url: "{{ route('device.index') }}",
                type: 'GET',
                data: { page: page, keywords: keywords },
                success: function(res, status, xhr) {
                    $('#deviceListData').html(res);
                    // Sau khi load xong thì chuyển lại icon tìm kiếm
                    $('#searching-data').html('<i class="bi bi-search"></i>');
                },
                error: function(xhr) {
                    $('#deviceListData').html('<p class="text-danger">Lỗi tải dữ liệu!</p>');
                }
            });
        }, 300);
    }
</script>
@endpush