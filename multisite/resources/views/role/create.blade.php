<form id="formCreateRole" action="{{ route('role.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label for="name" class="form-label">Mã phân quyền:</label>
        <input type="text" name="name" id="name" class="form-control" required autocomplete="off">
        <div class="invalid-feedback" id="nameError"></div>
    </div>
    <div class="mb-2">
        <label for="title" class="form-label">Tên phân quyền:</label>
        <input type="text" name="title" id="title" class="form-control" required autocomplete="off">
        <div class="invalid-feedback" id="titleError"></div>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnSaveRole">
            Tạo mới
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formCreateRole').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnSaveRole');
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
                        showBootstrapToast(res.message ?? 'Tạo vai trò thành công!', "success");
                        $('#roleCreateModal').modal('hide');
                        loadListData();
                    } else {
                        showBootstrapToast(res.message ?? "Vui lòng kiểm tra lại thông tin đã nhập", "danger");
                    }
                },
                error: function(err) {
                    $btn.attr('disabled', false);
                    $btn.html($htmlBtn);
                    showBootstrapToast(err.responseJSON.message ?? 'Lỗi quyền truy cập!','danger');
                    if (err.responseJSON && err.responseJSON.errors && err.responseJSON.errors.name) {
                        $('#name').addClass('is-invalid');
                        $('#nameError').text(err.responseJSON.errors.name[0]);
                    } else {
                        $('#name').removeClass('is-invalid');
                        $('#nameError').text('');
                    }
                }
            });
        }, 500);
    });
});
</script>