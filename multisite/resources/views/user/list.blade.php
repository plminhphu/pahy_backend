<div class="table-scroll mb-4">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge bg-primary text-light">{{ $user->role_name }}</span>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btnShowUser"
                            data-route="{{ route('user.show', $user->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning btnEditUser"
                            data-route="{{ route('user.edit', $user->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteUser"
                            data-route="{{ route('user.destroy', $user->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">Chưa có người dùng nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{!! $users->links('pagination::bootstrap-5') !!}
<script>
    $(function() {
        $('#userListData').off('click', '.pagination a').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = 1;
            var match = url.match(/page=(\d+)/);
            if (match) page = match[1];
            loadListData();
        });

        // Thêm user
        $('#btnCreateUser').on('click', function() {
            $('#userCreateModalBody').html(shimmerloader);
            $.get("{{ route('user.create') }}", function(data) {
                $('#userCreateModalBody').html(data);
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
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
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
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
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
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
                                loadListData();
                            } else {
                                showBootstrapToast(res
                                    .message ??
                                    "Lỗi khi xóa nhân viên!",
                                    "danger");
                            }
                        },
                        error: function(err) {
                            showBootstrapToast(err.responseJSON.message ??
                                'Lỗi quyền truy cập!', 'danger');
                        }
                    });
                });
        });
    });
</script>
