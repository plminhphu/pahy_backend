<form id="formEditUser" action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <label for="name" class="form-label">Tên khách hàng:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="mb-2">
        <label for="email" class="form-label">Tài khoản - Email:</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div>
    <div class="mb-2">
        <label for="password" class="form-label">Mật khẩu mới:</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Để trống nếu không đổi">
    </div>
    <div class="mb-2">
        <label for="role_id" class="form-label">Vai trò:</label>
        <select name="role_id" id="role_id" class="form-select" required>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnUpdateUser">
            Cập nhật
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formEditUser').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnUpdateUser');
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
                    if (xhr.status === 202) {
                        showBootstrapToast(res.message ?? 'Cập nhật thành công!', "success");
                        $('#userEditModal').modal('hide');
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