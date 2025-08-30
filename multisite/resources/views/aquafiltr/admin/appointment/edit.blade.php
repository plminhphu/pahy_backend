<form id="formEditAppointment" action="{{ route('appointment.update', $appointment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="customer_name" class="form-label">Tên khách hàng</label>
        <input type="text" name="customer_name" id="customer_name" class="form-control" value="{{ $appointment->customer_name }}" required>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Số điện thoại</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ $appointment->phone }}" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Địa chỉ</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $appointment->address }}" required>
    </div>
    <div class="mb-3">
        <label for="product_type" class="form-label">Thiết bị</label>
        <input type="text" name="product_type" id="product_type" class="form-control" value="{{ $appointment->product_type }}" required>
    </div>
    <div class="mb-3">
        <label for="appointment_date" class="form-label">Ngày giờ hẹn</label>
        <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}" required>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnUpdateAppointment">Cập nhật</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formEditAppointment').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnUpdateAppointment');
        var $htmlBtn = $btn.html();
        $btn.attr('disabled', true);
        $btn.html('<span class="spinner-border spinner-border-sm" role="status"></span>');
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(res, status, xhr) {
                $btn.attr('disabled', false);
                $btn.html($htmlBtn);
                if (xhr.status === 202) {
                    showBootstrapToast(res.message ?? 'Cập nhật thành công!', "success");
                    $('#appointmentEditModal').modal('hide');
                    loadListData();
                } else {
                    showBootstrapToast(res.message ?? "Vui lòng kiểm tra lại thông tin đã nhập", "danger");
                }
            },
            error: function(err) {
                $btn.attr('disabled', false);
                $btn.html($htmlBtn);
                showBootstrapToast(err.responseJSON.message ?? 'Lỗi quyền truy cập!','danger');
            }
        });
    });
});
</script>