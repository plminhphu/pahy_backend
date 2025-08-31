
<form id="formCreateUser" action="{{ route('user.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label for="name" class="form-label">Tên nhân viên:</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="email" class="form-label">Tài khoản - Email:</label>
        <input type="email" name="email" id="email"
            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="password" class="form-label">Mật khẩu:</label>
        <input type="password" name="password" id="password"
            class="form-control @error('password') is-invalid @enderror" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-2">
        <label for="role_id" class="form-label">Vai trò:</label>
        <select name="role_id" id="role_id" class="form-select" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}"
                    {{ collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnSaveUser">
            Tạo mới
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formCreateUser').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnSaveUser');
        var $htmlBtn = $btn.html();
        $btn.attr('disabled', true);
        $btn.html('<span class="spinner-border spinner-border-sm" role="status"></span>');
        setTimeout(() => {
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function(res, status, xhr) {
                    $btn.attr('disabled', false);
                    $btn.html($htmlBtn);
                    if (xhr.status === 201) {
                        showBootstrapToast(res.message ?? 'Tạo mới thành công!', "success");
                        $('#userCreateModal').modal('hide');
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
        }, 500);
    });
});
</script>