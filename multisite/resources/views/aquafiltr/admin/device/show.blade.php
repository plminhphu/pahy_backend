<div class="container py-2">
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Mã thiết bị:</div>
        <div class="col-8">{{ $device->code }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Tên thiết bị:</div>
        <div class="col-8">{{ $device->name }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Kiểu thiết bị:</div>
        <div class="col-8">{{ $device->model }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày tạo:</div>
        <div class="col-8">{{ $device->created_at }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày cập nhật:</div>
        <div class="col-8">{{ $device->updated_at }}</div>
    </div>
</div>