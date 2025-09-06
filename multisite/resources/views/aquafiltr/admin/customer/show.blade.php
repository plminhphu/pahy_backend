<div class="container py-2">
<img src="{{ route('customer.barcode', $customer->id) }}" class="img-fluid mb-3">
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Mã khách hàng:</div>
        <div class="col-8">{{ $customer->code }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Tên khách hàng:</div>
        <div class="col-8">{{ $customer->name }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Số điện thoại:</div>
        <div class="col-8">{{ $customer->phone }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Địa chỉ:</div>
        <div class="col-8">{{ $customer->address }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Vùng:</div>
        <div class="col-8">{{ $customer->region }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày tạo:</div>
        <div class="col-8">{{ $customer->created_at }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày cập nhật:</div>
        <div class="col-8">{{ $customer->updated_at }}</div>
    </div>
</div>
@if($customer->phone)
<div class="d-flex gap-2">
    <a href="tel:{{ $customer->phone }}" class="col-6 btn btn-primary mt-3">
        <i class="bi bi-telephone-fill me-2"></i>Gọi điện
    </a>
    <a href="sms:{{ $customer->phone }}" class="col-6 btn btn-primary mt-3">
        <i class="bi bi-chat-dots-fill me-2"></i>Nhắn tin
    </a>
</div>
@endif
<div class="d-flex gap-2">
    <button onclick="window.location='{{ route('appointment.create', ['customer_id' => $customer->id]) }}'" class="col-6 btn btn-success mt-3">
        <i class="bi bi-plus-circle-fill me-2"></i>Tạo đơn hàng
    </button>
    <a href="https://www.ppl.cz/balik-pro-tebe/formular?recipientPhone={{ preg_replace('/(\+84|0)(\d{3})(\d{3})(\d{3})/', '+84$2$3$4', $customer->phone) }}&recipientName={{ urlencode($customer->name) }}&recipientAddress={{ urlencode($customer->address) }}" target="_blank" class="col-6 btn btn-dark mt-3">
        <i class="bi bi-box-seam me-2"></i>Gửi hàng PPL
    </a>
</div>