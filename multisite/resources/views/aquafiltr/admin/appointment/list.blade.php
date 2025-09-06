<div class="table-responsive mb-4 w-100">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã lịch hẹn</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Thiết bị</th>
                <th>Imei</th>
                <th>Ngày hẹn</th>
                <th>Chu kì</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $index => $appt)
                <tr>
                    <td>{{ $appt->code }}</td>
                    <td>{{ $appt->customer_name }}</td>
                    <td>{{ preg_replace('/(\+84|0)(\d{3})(\d{3})(\d{3})/', '+84.$2.$3.$4', $appt->customer_phone) }}</td>
                    <td>{{ $appt->device_name }} - {{ $appt->device_model }}</td>
                    <td>{{ $appt->device_imei }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>{{ $appt->reminder_cycle }} tháng</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btnShowAppointment" data-route="{{ route('appointment.show', $appt->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <a href="{{ route('appointment.edit', $appt->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteAppointment" data-route="{{ route('appointment.destroy', $appt->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
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
            // chuyển hướng đến route 
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
