

<div class="table-scroll mb-4">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Mã quyền</th>
                <th>Tên quyền</th>
                <th>Đọc</th>
                <th>Xem</th>
                <th>Tạo</th>
                <th>Sửa</th>
                <th>Xóa</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $index => $role)
                <tr>
                    <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $index + 1 }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->title }}</td>
                    <td>
                      {{ $role->permissions->where('getall', 1)->count() }}
                    </td>
                    <td>
                      {{ $role->permissions->where('getone', 1)->count() }}
                    </td>
                    <td>
                      {{ $role->permissions->where('created', 1)->count() }}
                    </td>
                    <td>
                      {{ $role->permissions->where('updated', 1)->count() }}
                    </td>
                    <td>
                      {{ $role->permissions->where('deleted', 1)->count() }}
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btnShowRole"
                            data-route="{{ route('role.show', $role->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning btnEditRole"
                            data-route="{{ route('role.edit', $role->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteRole"
                            data-route="{{ route('role.destroy', $role->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted my-5 py-5">Chưa có vai trò nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{!! $roles->links('pagination::bootstrap-5') !!}
<script>
    $(function() {
        $('#roleListData').off('click', '.pagination a').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = 1;
            var match = url.match(/page=(\d+)/);
            if (match) page = match[1];
            loadListData();
        });

        // Thêm role
        $('#btnCreateRole').on('click', function() {
            $('#roleCreateModalBody').html(shimmerloader);
            $.get("{{ route('role.create') }}", function(data) {
                $('#roleCreateModalBody').html(data);
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Xem role
        $('.btnShowRole').on('click', function() {
            $('#roleShowModalBody').html(shimmerloader);
            var route = $(this).data('route');
            $.get(route, function(data) {
                $('#roleShowModalBody').html(data);
                $('#roleShowModal').modal('show');
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Sửa role
        $('.btnEditRole').on('click', function() {
            $('#roleEditModalBody').html(shimmerloader);
            var route = $(this).data('route');
            $.get(route, function(data) {
                $('#roleEditModalBody').html(data);
                $('#roleEditModal').modal('show');
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Xóa role
        $('.btnDeleteRole').on('click', function() {
            var id = $(this).data('id');
            $('#roleDeleteModalBody').html(
                '<p>Bạn có chắc muốn xóa vai trò này?</p><div class="d-flex justify-content-end gap-2"><button class="btn btn-danger" id="confirmDeleteRole">Xóa</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button></div>'
            );
            $('#roleDeleteModal').modal('show');
            var route = $(this).data('route');
            $(document).off('click', '#confirmDeleteRole').on('click',
                '#confirmDeleteRole',
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
                                $('#roleDeleteModal').modal(
                                    'hide');
                                loadListData();
                            } else {
                                showBootstrapToast(res
                                    .message ??
                                    "Lỗi khi xóa vai trò!",
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
