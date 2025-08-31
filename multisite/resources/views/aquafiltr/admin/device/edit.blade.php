<form id="formEditDevice" action="{{ route('device.update', $device->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <label for="name" class="form-label">Tên thiết bị:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $device->name }}" required>
    </div>
    <div class="mb-2">
        <label for="model" class="form-label">Kiểu thiết bị:</label>
        <input type="text" name="model" id="model" class="form-control" value="{{ $device->model }}" required>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnUpdateDevice">
            Cập nhật
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formEditDevice').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnUpdateDevice');
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
                        $('#deviceEditModal').modal('hide');
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