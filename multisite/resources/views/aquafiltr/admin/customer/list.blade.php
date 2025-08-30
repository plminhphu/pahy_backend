<div class="table-scroll mb-4">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Mã KH</th>
                <th>Tên KH</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Vùng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($customers as $index => $customer)
                <tr>
                    <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
                    <td>{{ $customer->code }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->region }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-info btnShowCustomer"
                            data-route="{{ route('customer.show', $customer->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning btnEditCustomer"
                            data-route="{{ route('customer.edit', $customer->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteCustomer"
                            data-route="{{ route('customer.destroy', $customer->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted my-5 py-5">Chưa có khách hàng nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{!! $customers->links('pagination::bootstrap-5') !!}
<script>
    $(function() {
        $('#customerListData').off('click', '.pagination a').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = 1;
            var match = url.match(/page=(\d+)/);
            if (match) page = match[1];
            loadListData();
        });

        // Thêm customer
        $('#btnCreateCustomer').on('click', function() {
            $('#customerCreateModalBody').html(shimmerloader);
            $.get("{{ route('customer.create') }}", function(data) {
                $('#customerCreateModalBody').html(data);
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Xem customer
        $('.btnShowCustomer').on('click', function() {
            $('#customerShowModalBody').html(shimmerloader);
            var route = $(this).data('route');
            $.get(route, function(data) {
                $('#customerShowModalBody').html(data);
                $('#customerShowModal').modal('show');
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Sửa customer
        $('.btnEditCustomer').on('click', function() {
            $('#customerEditModalBody').html(shimmerloader);
            var route = $(this).data('route');
            $.get(route, function(data) {
                $('#customerEditModalBody').html(data);
                $('#customerEditModal').modal('show');
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                    .message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Xóa customer
        $('.btnDeleteCustomer').on('click', function() {
            var id = $(this).data('id');
            $('#customerDeleteModalBody').html(
                '<p>Bạn có chắc muốn xóa khách hàng này?</p><div class="d-flex justify-content-end gap-2"><button class="btn btn-danger" id="confirmDeleteCustomer">Xóa</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button></div>'
            );
            $('#customerDeleteModal').modal('show');
            var route = $(this).data('route');
            $(document).off('click', '#confirmDeleteCustomer').on('click',
                '#confirmDeleteCustomer',
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
                                $('#customerDeleteModal').modal(
                                    'hide');
                                loadListData();
                            } else {
                                showBootstrapToast(res
                                    .message ??
                                    "Lỗi khi xóa khách hàng!",
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
