<div class="container py-2">
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Mã phân quyền:</div>
        <div class="col-8">{{ $role->name }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Tên phân quyền:</div>
        <div class="col-8">{{ $role->title }}</div>
    </div>
    <div class="row my-3">
        <div class="col-12 fw-semibold text-secondary">Cụ thể:</div>
        <div class="col-12 px-0">
            <div class="table-responsive table-responsive-sm">
                <table class="table table-sm align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tên</th>
                            <th class="text-center th-sm">Đọc</th>
                            <th class="text-center th-sm">Xem</th>
                            <th class="text-center th-sm">Tạo</th>
                            <th class="text-center th-sm">Sửa</th>
                            <th class="text-center th-sm">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($role->permissions as $key=> $permission)
                        <tr>
                            <td>{{ $permission->title }}</td>
                            <td class="text-center th-sm">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->getall ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-center th-sm">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->getone ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-center th-sm">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->created ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-center th-sm">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->updated ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td class="text-center th-sm">
                                <div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->deleted ? 'checked' : '' }}>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày tạo:</div>
        <div class="col-8">{{ $role->created_at }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày cập nhật:</div>
        <div class="col-8">{{ $role->updated_at }}</div>
    </div>
</div>
