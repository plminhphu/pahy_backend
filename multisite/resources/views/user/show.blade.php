<div class="container py-2">
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Tên:</div>
        <div class="col-8">{{ $user->name }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Email:</div>
        <div class="col-8">{{ $user->email }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Vai trò:</div>
        <div class="col-8">
            @if(isset($user->role_name))
                <span class="badge bg-primary text-light">{{ $user->role_name }}</span>
            @elseif(method_exists($user, 'roles'))
                @foreach($user->roles as $role)
                    <span class="badge bg-primary text-light">{{ $role->name }}</span>
                @endforeach
            @endif
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày tạo:</div>
        <div class="col-8">{{ $user->created_at }}</div>
    </div>
    <div class="row mb-2">
        <div class="col-4 fw-semibold text-secondary">Ngày cập nhật:</div>
        <div class="col-8">{{ $user->updated_at }}</div>
    </div>
</div>