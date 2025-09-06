{{ $date = request('date', date('Y-m-d')) }}
{{ $tomorow = date('Y-m-d', strtotime($date . ' +1 day')) }}
<div class="table-responsive mb-4 w-100">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Ngày hẹn</th>
                <th>Chu kì</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Thiết bị</th>
                <th>Giá thiết bị</th>
                <th>Imei</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $index => $appt)
                <tr>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>{{ $appt->reminder_cycle }} tháng</td>
                    <td>{{ $appt->customer_name }}</td>
                    <td>
                        <a href="tel:{{ $appt->customer_phone }}" class="btn btn-primary">
                            <i class="bi bi-telephone-fill me-2"></i>
                            {{ preg_replace('/(\+84|0)(\d{3})(\d{3})(\d{3})/', '+84.$2.$3.$4', $appt->customer_phone) }}
                        </a>
                    </td>
                    <td>{{ $appt->device_name }} - {{ $appt->device_model }}</td>
                    <td>{{ number_format($appt->device_price ?? 0) }}</td>
                    <td>{{ $appt->device_imei }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-success btnShowAppointment" data-route="{{ route('appointment.show', $appt->id) }}">
                            <i class="bi bi-eye me-2"></i> xem
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
<script>
    $(function() {
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
    });
</script>
