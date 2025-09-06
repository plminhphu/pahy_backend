@extends('layouts.app')
@section('content')
<form class="row p-md-4 p-2" id="formEditAppointment" action="{{ route('appointment.update', $appointment->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">Phần khách hàng</h6>
                    <p class="mb-0 text-muted fw-lighter fs-sm">Nếu khách chưa tồn tại hãy nhập thông tin để tạo tự động</p>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="select_customer_id" class="form-label">Chọn một khách hàng:</label>
                        <select disabled class="form-control" id="select_customer_id" data-placeholder="Vui lòng chọn khách hàng">
                            <option disabled>Chọn từ {{ $customers->count() }} khách hàng</option>
                            @foreach ($customers as $customer)
                                <option value="{{ route('customer.info',$customer->id) }}" {{ $appointment->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->code }} - {{ $customer->name }}</option>
                            @endforeach
                        </select>
                        <input hidden name="customer_id" id="customer_id" value="{{ $appointment->customer_id }}">
                        <input hidden name="customer_region" id="customer_region" value="{{ $appointment->customer_region }}">
                    </div>
                    <div class="mb-2">
                        <label for="customer_name" class="form-label">Tên khách hàng:</label>
                        <input type="text" name="customer_name" id="customer_name" class="form-control" required value="{{ $appointment->customer_name }}">
                    </div>
                    <div class="mb-2">
                        <label for="customer_phone" class="form-label">Số điện thoại:</label>
                        <input disabled type="text" name="customer_phone" id="customer_phone" class="form-control" required value="{{ $appointment->customer_phone }}">
                    </div>
                    <div class="mb-2">
                        <label for="customer_address" class="form-label">Địa chỉ:</label>
                        <input type="text" name="customer_address" id="customer_address" class="form-control" required value="{{ $appointment->customer_address }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">Phần thiết bị</h6>
                    <p class="mb-0 text-muted fw-lighter fs-sm">Chọn một thiết bị để đặt lịch, và thêm Imei hoặc mã máy để ghi chú</p>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="select_device_id" class="form-label">Chọn các thiết bị:</label>
                        <select class="form-control" id="select_device_id" data-placeholder="Vui lòng chọn thiết bị">
                            <option disabled>Chọn từ {{ $devices->count() }} thiết bị</option>
                            @foreach ($devices as $device)
                                <option value="{{ route('device.info',$device->id) }}" {{ $appointment->device_id == $device->id ? 'selected' : '' }}>{{ $device->code }} - {{ $device->name }}</option>
                            @endforeach
                        </select>
                        <input hidden name="device_id" id="device_id" value="{{ $appointment->device_id }}">
                    </div>
                    <div class="mb-2">
                        <label for="device_code_and_name" class="form-label">Thiết bị:</label>
                        <input type="text" id="device_code_and_name" class="form-control" value="{{ $appointment->device_code }} - {{ $appointment->device_name }}">
                        <input hidden name="device_code" id="device_code" value="{{ $appointment->device_code }}">
                        <input hidden name="device_name" id="device_name" value="{{ $appointment->device_name }}">
                    </div>
                    <div class="mb-2">
                        <label for="device_model" class="form-label">Model:</label>
                        <input type="text" name="device_model" id="device_model" class="form-control" value="{{ $appointment->device_model }}">
                    </div>
                    <div class="mb-2">
                        <label for="device_imei" class="form-label">Imei hoặc mã máy:</label>
                        <input type="text" name="device_imei" id="device_imei" class="form-control" required value="{{ $appointment->device_imei }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="card-title mb-0">Phần lịch hẹn</h6>
                    <p class="mb-0 text-muted fw-lighter fs-sm">Thiết lập thời gian và chu kì, hệ thống sẽ căn cứ vào ngày để nhắc nhở</p>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="appointment_date" class="form-label">Ngày giờ hẹn:</label>
                        <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" required value="{{ date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) }}">
                    </div>
                    <div class="mb-2">
                        <label for="reminder_cycle" class="form-label">Nhắc nhở bảo dưỡng:</label>
                        <select name="reminder_cycle" id="reminder_cycle" class="form-control">
                            <option value="3" {{ $appointment->reminder_cycle == 3 ? 'selected' : '' }}>Định kỳ 3 tháng</option>
                            <option value="6" {{ $appointment->reminder_cycle == 6 ? 'selected' : '' }}>Định kỳ 6 tháng</option>
                            <option value="12" {{ $appointment->reminder_cycle == 12 ? 'selected' : '' }}>Định kỳ 1 năm</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="note" class="form-label">Ghi chú:</label>
                        <textarea name="note" id="note" class="form-control" rows="4">{{ $appointment->note }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <a href="{{ route('appointment.index') }}" type="button" class="btn btn-secondary">Trở lại</a>
        <button type="submit" class="btn btn-primary" id="btnUpdateAppointment">Cập nhật lịch hẹn</button>
    </div>
</form>
@endsection
@push('scripts')
<script>
$(function() {
    $("#formCreateAppointment #select_customer_id").select2({
        placeholder: 'Hãy chọn khách hàng',
        allowClear: true,
    });
    // khi "#formCreateAppointment #customer_id " thay đổi thì điền thông tin khách hàng vào các trường tương ứng
    $('#formCreateAppointment #select_customer_id').on('change', function() {
        var routeCustomer = $(this).val();
        if (routeCustomer) {
            $.ajax({
                url: routeCustomer,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#formCreateAppointment #customer_id').val(data.id);
                    $('#formCreateAppointment #customer_name').val(data.name);
                    $('#formCreateAppointment #customer_phone').val(data.phone);
                    $('#formCreateAppointment #customer_address').val(data.address);
                    $('#formCreateAppointment #customer_region').val(data.region);
                },
                error: function() {
                    $('#formCreateAppointment #customer_id').val('');
                    $('#formCreateAppointment #customer_name').val('');
                    $('#formCreateAppointment #customer_phone').val('');
                    $('#formCreateAppointment #customer_address').val('');
                    $('#formCreateAppointment #customer_region').val('');
                }
            });
        } else {
            $('#formCreateAppointment #customer_id').val('');
            $('#formCreateAppointment #customer_name').val('');
            $('#formCreateAppointment #customer_phone').val('');
            $('#formCreateAppointment #customer_address').val('');
            $('#formCreateAppointment #customer_region').val('');
        }
    });
    $("#formCreateAppointment #select_device_id").select2({
        placeholder: 'Hãy chọn thiết bị',
        allowClear: true,
    });
    // khi "#formCreateAppointment #device_id " thay đổi thì điền thông tin thiết bị vào các trường tương ứng
    $('#formCreateAppointment #select_device_id').on('change', function() {
        var routeDevice = $(this).val();
        if (routeDevice) {
            $.ajax({
                url: routeDevice,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#formCreateAppointment #device_id').val(data.id);
                    $('#formCreateAppointment #device_code_and_name').val(data.code + ' - ' + data.name);
                    $('#formCreateAppointment #device_code').val(data.code);
                    $('#formCreateAppointment #device_name').val(data.name);
                    $('#formCreateAppointment #device_model').val(data.model);
                    $('#formCreateAppointment #device_model_show').val(data.model);
                },
                error: function() {
                    $('#formCreateAppointment #device_id').val('');
                    $('#formCreateAppointment #device_code_and_name').val('');
                    $('#formCreateAppointment #device_code').val('');
                    $('#formCreateAppointment #device_name').val('');
                    $('#formCreateAppointment #device_model').val('');
                    $('#formCreateAppointment #device_model_show').val('');
                }
            });
        } else {
            $('#formCreateAppointment #device_id').val('');
            $('#formCreateAppointment #device_code_and_name').val('');
            $('#formCreateAppointment #device_code').val('');
            $('#formCreateAppointment #device_name').val('');
            $('#formCreateAppointment #device_model').val('');
            $('#formCreateAppointment #device_model_show').val('');
        }
    });
    // xử lý submit form
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
                if (xhr.status === 201) {
                    showBootstrapToast(res.message ?? 'Cập nhật lịch hẹn thành công!', "success");
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
@endpush