@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="my-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userCreateModal"
                id="btnCreateUser">
                <i class="bi bi-person-plus"></i> Thêm nhân viên
            </button>
        </div>
        <div id="userListData">
            <div class="shimmer-loader" style="min-height:60vh;">
                <div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div>
                <div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div>
                <div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div>
            </div>
        </div>
    </div>
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
    <script>
        const shimmerloader = `
    <div class="shimmer-loader">
        <div class="shimmer-line mb-2" style="width: 80%; height: 20px;"></div>
        <div class="shimmer-line mb-2" style="width: 60%; height: 20px;"></div>
        <div class="shimmer-line mb-2" style="width: 90%; height: 20px;"></div>
    </div>
`;
        var page = 1;
        $(function() {
            // Load danh sách user
            $('#userListData').html(shimmerloader);
            loadListData(page);
        });

        function loadListData(page) {
            setTimeout(() => {
                $.ajax({
                    url: "{{ route('user.index') }}",
                    type: 'GET',
                    data: {
                        page: page
                    },
                    success: function(res, status, xhr) {
                        $('#userListData').html(res);
                        // Thêm user
                        $('#btnCreateUser').on('click', function() {
                            $('#userCreateModalBody').html(shimmerloader);
                            $.get("{{ route('user.create') }}", function(data) {
                                $('#userCreateModalBody').html(data);
                            }).fail(function(err) {
                                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
                                showBootstrapToast(msg, 'danger');
                            });
                        });
                        // Xem user
                        $('.btnShowUser').on('click', function() {
                            $('#userShowModalBody').html(shimmerloader);
                            var route = $(this).data('route');
                            $.get(route, function(data) {
                                $('#userShowModalBody').html(data);
                                $('#userShowModal').modal('show');
                            }).fail(function(err) {
                                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
                                showBootstrapToast(msg, 'danger');
                            });
                        });
                        // Sửa user
                        $('.btnEditUser').on('click', function() {
                            $('#userEditModalBody').html(shimmerloader);
                            var route = $(this).data('route');
                            $.get(route, function(data) {
                                $('#userEditModalBody').html(data);
                                $('#userEditModal').modal('show');
                            }).fail(function(err) {
                                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
                                showBootstrapToast(msg, 'danger');
                            });
                        });
                        // Xóa user
                        $('.btnDeleteUser').on('click', function() {
                            var id = $(this).data('id');
                            $('#userDeleteModalBody').html(
                                '<p>Bạn có chắc muốn xóa nhân viên này?</p><div class="d-flex justify-content-end gap-2"><button class="btn btn-danger" id="confirmDeleteUser">Xóa</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button></div>'
                                );
                            $('#userDeleteModal').modal('show');
                            var route = $(this).data('route');
                            $(document).off('click', '#confirmDeleteUser').on('click',
                                '#confirmDeleteUser',
                                function() {
                                    $.ajax({
                                        url: route,
                                        type: 'DELETE',
                                        data: {
                                            _token: "{{ csrf_token() }}"
                                        },
                                        success: function(res, status, xhr) {
                                            if (xhr.status === 202) {
                                                showBootstrapToast(res
                                                    .message ??
                                                    'Xóa thành công!',
                                                    'success');
                                                $('#userDeleteModal').modal(
                                                    'hide');
                                                loadListData(page);
                                            } else {
                                                showBootstrapToast(res
                                                    .message ??
                                                    "Lỗi khi xóa nhân viên!",
                                                    "danger");
                                            }
                                        },
                                        error: function(err) {
                                            showBootstrapToast(err.responseJSON.message ?? 'Lỗi quyền truy cập!','danger');
                                        }
                                    });
                                });
                        });
                    },
                    error: function(xhr) {
                        $('#userListData').html('<p class="text-danger">Lỗi tải dữ liệu!</p>');
                    }
                });
            }, 200);
        }
    </script>
@endsection
