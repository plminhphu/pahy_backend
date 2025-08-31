
<form id="formEditRole" action="{{ route('role.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="mb-2 col-md-6 col-12">
          <label for="name" class="form-label">Mã phân quyền:</label>
          <input type="text" name="name" id="name" class="form-control" value="{{ $role->name }}" required>
      </div>
      <div class="mb-2 col-md-6 col-12">
          <label for="title" class="form-label">Tên phân quyền:</label>
          <input type="text" name="title" id="title" class="form-control" value="{{ $role->title }}" required>
      </div>
    </div>
    <div class="my-2">
        <label class="form-label">Cụ thể quyền:</label>
        <div class="table-responsive table-responsive-sm">
            <table class="table table-sm align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Tên</th>
                        <th class="text-center">Đọc</th>
                        <th class="text-center">Xem</th>
                        <th class="text-center">Tạo</th>
                        <th class="text-center">Sửa</th>
                        <th class="text-center">Xóa</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($permissions as $key => $permission)
                    @php $perKey = $permission->name; $perRole=$role->permissions->where('name',$perKey)->first()??null; @endphp
                    <tr>
                        <td>{{ $permission->title }}</td>
                        <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                              <input class="form-check-input" type="checkbox" name="{{ $permission->name }}[getall]" value="1" {{ ($perRole->getall??false) ? 'checked' : '' }}>
                          </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" name="{{ $permission->name }}[getone]" value="1" {{ ($perRole->getone??false) ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" name="{{ $permission->name }}[created]" value="1" {{ ($perRole->created??false) ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" name="{{ $permission->name }}[updated]" value="1" {{ ($perRole->updated??false) ? 'checked' : '' }}>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-switch d-flex justify-content-center">
                                <input class="form-check-input" type="checkbox" name="{{ $permission->name }}[deleted]" value="1" {{ ($perRole->deleted??false) ? 'checked' : '' }}>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary" id="btnUpdateRole">
            Cập nhật
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    </div>
</form>
<script>
$(function() {
    $('#formEditRole').on('submit', function(e) {
        e.preventDefault();
        var $btn = $('#btnUpdateRole');
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
                        $('#roleEditModal').modal('hide');
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