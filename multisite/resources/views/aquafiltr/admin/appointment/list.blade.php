<div class="table-responsive mb-4 w-100">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã đơn</th>
                <th>Tên KH</th>
                <th>SĐT</th>
                <th>Địa chỉ</th>
                <th>Thiết bị</th>
                <th>Ngày hẹn</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $index => $appt)
                <tr>
                    <td>
                        <img src="{{ route('appointment.barcode', $appt->id) }}" class="img-fluid">
                    </td>
                    <td>{{ $appt->customer_name }}</td>
                    <td>{{ $appt->phone }}</td>
                    <td>{{ $appt->address }}</td>
                    <td>{{ $appt->product_type }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btnShowAppointment" data-route="{{ route('appointment.show', $appt->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning btnEditAppointment" data-route="{{ route('appointment.edit', $appt->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteAppointment" data-route="{{ route('appointment.destroy', $appt->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        <a href="{{ route('appointment.invoice', $appt->id) }}" class="btn btn-sm btn-info"><i class="bi bi-file-earmark-pdf"></i></a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted my-5 py-5">Chưa có lịch hẹn nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{!! $appointments->links('pagination::bootstrap-5') !!}
<script>
    $(function() {
        $('#appointmentListData').off('click', '.pagination a').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var page = 1;
            var match = url.match(/page=(\d+)/);
            if (match) page = match[1];
            loadListData();
        });
        // Xem
        $('.btnShowAppointment').on('click', function() {
            $('#appointmentShowModalBody').html(shimmerloader());
            var route = $(this).data('route');
            $.get(route, function(data) {
                $('#appointmentShowModalBody').html(data);
                $('#appointmentShowModal').modal('show');
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Sửa
        $('.btnEditAppointment').on('click', function() {
            $('#appointmentEditModalBody').html(shimmerloader());
            var route = $(this).data('route');
            $.get(route, function(data) {
                $('#appointmentEditModalBody').html(data);
                $('#appointmentEditModal').modal('show');
            }).fail(function(err) {
                let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON.message : (err.message ?? 'Lỗi quyền truy cập!');
                showBootstrapToast(msg, 'danger');
            });
        });
        // Xóa
        $('.btnDeleteAppointment').on('click', function() {
            $('#appointmentDeleteModalBody').html('<p>Bạn có chắc muốn xóa lịch hẹn này?</p><div class="d-flex justify-content-end gap-2"><button class="btn btn-danger" id="confirmDeleteAppointment">Xóa</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button></div>');
            $('#appointmentDeleteModal').modal('show');
            var route = $(this).data('route');
            $(document).off('click', '#confirmDeleteAppointment').on('click', '#confirmDeleteAppointment', function() {
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    data: { _token: "{{ csrf_token() }}" },
                    success: function(res, status, xhr) {
                        if (xhr.status === 202) {
                            showBootstrapToast(res.message ?? 'Xóa thành công!', 'success');
                            $('#appointmentDeleteModal').modal('hide');
                            loadListData();
                        } else {
                            showBootstrapToast(res.message ?? 'Lỗi khi xóa lịch hẹn!', 'danger');
                        }
                    },
                    error: function(err) {
                        showBootstrapToast(err.responseJSON.message ?? 'Lỗi quyền truy cập!', 'danger');
                    }
                });
            });
        });
    });
</script>
