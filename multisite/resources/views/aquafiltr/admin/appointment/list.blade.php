<div class="table-responsive mb-4 w-100">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã lịch hẹn</th>
                <th>Khách hàng</th>
                <th>Số điện thoại</th>
                <th>Thiết bị</th>
                <th>Giá thiết bị</th>
                <th>Imei</th>
                <th>Ngày hẹn</th>
                <th>Chu kì</th>
                <th>STT</th>
                <th class="text-center">Thao tác</th>
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
                    <td>{{ number_format($appt->device_price ?? 0) }}</td>
                    <td>{{ $appt->device_imei }}</td>
                    <td>{{ $appt->appointment_date }}</td>
                    <td>{{ $appt->reminder_cycle }} tháng</td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" value="{{ $appt->id }}" {{ ($appt->status == true || $appt->status == 1)?'checked':'' }} role="switch" id="switchCheckDefault">
                        </div>
                    </td>
                    <td class="text-center">
                        @if ($appt->customer_phone )
                            @php $d = date('d', strtotime($appt->appointment_date));$m = date('m', strtotime($appt->appointment_date));$y = date('Y', strtotime($appt->appointment_date)); @endphp
                            <a href="sms:{{ ltrim($appt->customer_phone, '0') }}&body=📢 Aquafiltrshop kính chào Quý khách {{ $appt->customer_name }}, cảm ơn Quý khách đã tin tưởng.Chúng tôi xin thông báo lịch lắp đặt của Quý khách đã được duyệt.⏰ Thời gian: ngày {{ $d }} tháng {{ $m }} năm {{ $y }}" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-chat-dots-fill me-1"></i>🇻🇳</a>
                            <a href="sms:{{ ltrim($appt->customer_phone, '0') }}&body=📢 Aquafiltrshop Vás srdečně zdraví a děkuje za Vaši důvěru {{ $appt->customer_name }}.Rádi bychom Vás informovali, že Váš termín instalace byl schválen.⏰ Termín: {{ $d }}-{{ $m }}-{{ $y }}" target="_blank" class="btn btn-sm btn-info"><i class="bi bi-chat-dots-fill me-1"></i>🇨🇿</a>
                            <a href="tel:{{ $appt->customer_phone }}" class="btn btn-sm btn-primary"><i class="bi bi-telephone-fill"></i></a>
                        @endif
                    </td>
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
    // Cập nhật trạng thái
    $('input[type="checkbox"]').change(function() {
        var status = $(this).is(':checked') ? 1 : 0;
        var appointmentId = $(this).val();
        $.ajax({
            url: "{{ route('appointment.status') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id: appointmentId,
                status: status
            },
            success: function(res, status, xhr) {
                if (xhr.status === 201) {
                    showBootstrapToast(res.message ?? 'Cập nhật trạng thái thành công!', 'success');
                } else {
                    showBootstrapToast(res.message ?? 'Lỗi khi cập nhật trạng thái!', 'danger');
                }
            },
            error: function(err) {
                showBootstrapToast(err.responseJSON.message ?? 'Lỗi quyền truy cập!', 'danger');
            }
        });
    });
</script>
