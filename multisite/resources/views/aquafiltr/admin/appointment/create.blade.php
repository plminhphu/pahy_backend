@extends('layouts.app')
@section('content')
<form class="row p-md-4 p-2" id="formCreateAppointment" action="{{ route('appointment.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">Phần khách hàng</h6>
                    <p class="mb-0 text-muted fw-lighter fs-sm">Nếu khách chưa tồn tại hãy nhập thông tin để tạo tự động</p>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="customer_id" class="form-label">Chọn một khách hàng:</label>
                        <select class="form-control" id="customer_id" name="customer_id" data-placeholder="Vui lòng chọn khách hàng">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->code }} - {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="customer_name" class="form-label">Tên khách hàng:</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">Phần thiết bị</h6>
                    <p class="mb-0 text-muted fw-lighter fs-sm">hãy chọn một thiết bị để đặt lịch</p>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="device_id" class="form-label">Chọn các thiết bị:</label>
                        <select class="form-control" id="device_id" name="device_id" data-placeholder="Vui lòng chọn thiết bị">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->code }} - {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="customer_name" class="form-label">Imei hoặc mã máy:</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">Phần thiết bị</h6>
                    <p class="mb-0 text-muted fw-lighter fs-sm">hãy chọn một thiết bị để đặt lịch</p>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="appointment_date" class="form-label">Ngày giờ hẹn</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnSaveAppointment">Tạo lịch hẹn</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
@endsection
@push('scripts')
<script>
$(function() {
    $("#formCreateAppointment #customer_id").select2({
        placeholder: 'Hãy chọn khách hàng',
        allowClear: true,
    });
    $("#formCreateAppointment #device_id").select2({
        placeholder: 'Hãy chọn thiết bị',
        allowClear: true,
    });
    $('#formCreateAppointment').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnSaveAppointment');
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
                if (xhr.status === 201) {
                    showBootstrapToast(res.message ?? 'Tạo lịch hẹn thành công!', "success");
                    $('#appointmentCreateModal').modal('hide');
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
@endpush