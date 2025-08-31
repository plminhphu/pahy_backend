
<form id="formCreateDevice" action="{{ route('device.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên thiết bị:</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="model" class="form-label">Kiểu thiết bị:</label>
        <input type="tel" name="model" id="model"
            class="form-control @error('model') is-invalid @enderror" value="{{ old('model') }}" required>
        @error('model')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnSaveDevice">
            Tạo mới
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>

<script>
$(function() {
    $('#formCreateDevice').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnSaveDevice');
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
                        $('#deviceCreateModal').modal('hide');
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
