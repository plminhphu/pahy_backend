
<form id="formCreateCustomer" action="{{ route('customer.store') }}" method="POST">
    @csrf
    <div class="mb-2">
        <label for="name" class="form-label">Tên khách hàng:</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-2">
        <label for="phone" class="form-label">Số điện thoại:</label>
        <input type="tel" name="phone" id="phone"
            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-2">
        <label for="address" class="form-label">Địa chỉ:</label>
        <input type="text" name="address" id="address"
            class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-2">
        <label for="region" class="form-label">Vùng:</label>
        <select class="form-control" name="region" id="region" required data-placeholder="Vui lòng chọn vùng">
            <option disabled selected>Chọn vùng</option>
            @foreach (config('app.aquafiltr_regions') as $region)
                <option value="{{ trim($region) }}" {{ old('region') == trim($region) ? 'selected' : '' }}>{{ trim($region) }}</option>
            @endforeach
        </select>
    </div>
    <hr class="my-4">
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnSaveCustomer">
            Tạo mới
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>

<script>
$(function() {
    $('#formCreateCustomer').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnSaveCustomer');
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
                        $('#customerCreateModal').modal('hide');
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
