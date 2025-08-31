<div class="table-responsive mb-4 w-100">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>Mã thiết bị</th>
                <th>Tên thiết bị</th>
                <th>Kiểu thiết bị</th>
                <th>Hình ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($devices as $index => $device)
                <tr>
                    <td>{{ $device->code }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->model }}</td>
                    @php
                        $imagePath = $device->image ?? null;
                        $imageFile = $imagePath && file_exists(public_path('aquafiltr/images/' . basename($imagePath))) ? (asset('public/aquafiltr/images/' . basename($imagePath)).'?ver='.$device->updated_at->timestamp) : asset('public/images/device-aqua.png');
                    @endphp
                    <td>
                        <form enctype="multipart/form-data" method="POST" action="{{ route('device.upload', $device->id) }}">
                        @csrf
                        @method('PUT')
                            <img class="upload-btn" id="image-preview-{{ $device->id }}" src="{{ $imageFile }}" alt="Image">
                            <input type="file" class="inputFileImage" name="image" accept="image/*" data-id="{{ $device->id }}">
                        </form>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-info btnShowDevice"
                            data-route="{{ route('device.show', $device->id) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning btnEditDevice"
                            data-route="{{ route('device.edit', $device->id) }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger btnDeleteDevice"
                            data-route="{{ route('device.destroy', $device->id) }}">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted my-5 py-5">Chưa có thiết bị nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{!! $devices->links('pagination::bootstrap-5') !!}
<script>
$(function() {
    $('#deviceListData').off('click', '.pagination a').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var page = 1;
        var match = url.match(/page=(\d+)/);
        if (match) page = match[1];
        loadListData();
    });

    // Thêm device
    $('#btnCreateDevice').on('click', function() {
        $('#deviceCreateModalBody').html(shimmerloader());
        $.get("{{ route('device.create') }}", function(data) {
            $('#deviceCreateModalBody').html(data);
        }).fail(function(err) {
            let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                .message : (err.message ?? 'Lỗi quyền truy cập!');
            showBootstrapToast(msg, 'danger');
        });
    });
    // Xem device
    $('.btnShowDevice').on('click', function() {
        $('#deviceShowModalBody').html(shimmerloader());
        var route = $(this).data('route');
        $.get(route, function(data) {
            $('#deviceShowModalBody').html(data);
            $('#deviceShowModal').modal('show');
        }).fail(function(err) {
            let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                .message : (err.message ?? 'Lỗi quyền truy cập!');
            showBootstrapToast(msg, 'danger');
        });
    });
    // Sửa device
    $('.btnEditDevice').on('click', function() {
        $('#deviceEditModalBody').html(shimmerloader());
        var route = $(this).data('route');
        $.get(route, function(data) {
            $('#deviceEditModalBody').html(data);
            $('#deviceEditModal').modal('show');
        }).fail(function(err) {
            let msg = err.responseJSON && err.responseJSON.message ? err.responseJSON
                .message : (err.message ?? 'Lỗi quyền truy cập!');
            showBootstrapToast(msg, 'danger');
        });
    });
    // Xóa device
    $('.btnDeleteDevice').on('click', function() {
        var id = $(this).data('id');
        $('#deviceDeleteModalBody').html(
            '<p>Bạn có chắc muốn xóa thiết bị này?</p><div class="d-flex justify-content-end gap-2"><button class="btn btn-danger" id="confirmDeleteDevice">Xóa</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button></div>'
        );
        $('#deviceDeleteModal').modal('show');
        var route = $(this).data('route');
        $(document).off('click', '#confirmDeleteDevice').on('click',
            '#confirmDeleteDevice',
            function() {
                $.ajax({
                    url: route,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res, status, xhr) {
                        if (xhr.status === 202) {
                            showBootstrapToast(res
                                .message ??
                                'Xóa thành công!',
                                'success');
                            $('#deviceDeleteModal').modal(
                                'hide');
                            loadListData();
                        } else {
                            showBootstrapToast(res
                                .message ??
                                "Lỗi khi xóa thiết bị!",
                                "danger");
                        }
                    },
                    error: function(err) {
                        showBootstrapToast(err.responseJSON.message ??
                            'Lỗi quyền truy cập!', 'danger');
                    }
                });
            });
    });
});
// nếu nhấn vào upload-btn thì kích hoạt input file
$(document).on('click', '.upload-btn', function() {
    var id = $(this).next('input[type="file"]').data('id');
    $('#image-preview-' + id).next('input[type="file"]').click();
});
// Xem trước ảnh khi chọn tệp
$('.inputFileImage').on('change', function(e) {
    e.preventDefault();
    var input = this;
    let id = $(this).data('id');
    if (input.files && input.files[0]) {        
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#image-preview-'+id).attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    //formData bằng cha của nó
    var myForm = $(this).closest('form')[0];
    var formData = new FormData(myForm);
    $.ajax({
        url: $(myForm).attr('action'),
        type: $(myForm).attr('method'),
        data: formData,
        processData: false,
        contentType: false,
        success: function(res, status, xhr) { 
            if (xhr.status === 202) {
                showBootstrapToast(res.message ?? 'Cập nhật ảnh thành công!', "success");
                $('#image-preview-'+id).attr('src', res.image ?? $('#image-preview-'+id).attr('src'));
            } else {
                showBootstrapToast(res.message ?? "Vui lòng kiểm tra lại thông tin đã nhập", "danger");
            }
        },
        error: function(err) {
        showBootstrapToast(err.responseJSON.message ?? 'Lỗi quyền truy cập!','danger');
        }
    });
});
</script>
