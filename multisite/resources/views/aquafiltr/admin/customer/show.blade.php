<div class="container py-2">
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