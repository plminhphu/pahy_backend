<div class="container py-2">
    <img src="{{ route('appointment.barcode', $appointment->id) }}" class="img-fluid mb-3">
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Tên khách hàng:</div>
        <div class="col-8">{{ $appointment->customer_name }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Số điện thoại:</div>
        <div class="col-8">{{ $appointment->phone }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Địa chỉ:</div>
        <div class="col-8">{{ $appointment->address }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Thiết bị:</div>
        <div class="col-8">{{ $appointment->product_type }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày hẹn:</div>
        <div class="col-8">{{ $appointment->appointment_date }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày tạo:</div>
        <div class="col-8">{{ $appointment->created_at }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày cập nhật:</div>
        <div class="col-8">{{ $appointment->updated_at }}</div>
    </div>
    <div class="d-flex gap-4">
        <button onclick="window.location='{{ route('appointment.invoice', $appointment->id) }}'" class="btn btn-primary mt-3">
            <i class="bi bi-receipt-cutoff me-2"></i>Xem hóa đơn
        </button>
    </div>
</div>