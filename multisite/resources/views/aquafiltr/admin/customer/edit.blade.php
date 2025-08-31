<form id="formEditCustomer" action="{{ route('customer.update', $customer->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <label for="name" class="form-label">Tên khách hàng:</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $customer->name }}" required>
    </div>
    <div class="mb-2">
        <label for="phone" class="form-label">Số điện thoại:</label>
        <input type="text" name="phone" id="phone" class="form-control" value="{{ $customer->phone }}" required>
    </div>
    <div class="mb-2">
        <label for="address" class="form-label">Địa chỉ:</label>
        <input type="text" name="address" id="address" class="form-control" value="{{ $customer->address }}" required>
    </div>
    <div class="mb-2">
        <label for="region" class="form-label">Vùng:</label>
        <input type="text" name="region" id="region" class="form-control" value="{{ $customer->region }}" required>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnUpdateCustomer">
            Cập nhật
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formEditCustomer').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnUpdateCustomer');
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
                        $('#customerEditModal').modal('hide');
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
