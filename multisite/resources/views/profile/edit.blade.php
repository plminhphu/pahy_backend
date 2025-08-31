@extends('layouts.app')
@section('content')
@php $user = auth()->user(); @endphp
<div class="container py-4">
  <div class="row">
    <div class="col-md-4">
      <div class="card shadow-sm mb-4">
        <form id="avatar-upload-form" enctype="multipart/form-data" method="POST" action="{{ route('profile.avatar.upload') }}">
          @csrf
          @method('PUT')
          <div class="d-flex flex-column align-items-center p-3">
            @php
              $avatarPath = auth()->user()->avatar ?? null;
              $avatarFile = file_exists(public_path('aquafiltr/images/' . basename($avatarPath))) ? (asset('public/aquafiltr/images/' . basename($avatarPath)).'?ver='.auth()->user()->updated_at->timestamp) : asset('public/images/avatar.png');
            @endphp
            <img class="upload-btn upload-btn-lg" id="avatar-preview" src="{{ $avatarFile }}" alt="Avatar">
            <input type="file" id="inputGroupFileAvatar" name="avatar" accept="image/*">
          </div>
        </form>
        <div class="card-body text-center">
          <h5 class="card-title mb-0">{{ $user->name ?? 'N/A' }}</h5>
          <div class="badge bg-primary text-light my-2">
            {{ $role->title ?? 'N/A' }}
          </div>
          <hr>
          <div class="text-muted my-2">
            {{ $user->email ?? 'N/A' }}
          </div>
          <div class="text-muted mb-2">
            @if (isset($user->email_verified_at) && $user->email_verified_at)
              <span class="badge bg-success text-light ms-2">Đã xác thực</span>
            @else
              <span class="badge bg-warning text-dark ms-2">Chưa xác thực</span>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card shadow-sm mb-4">
        <div class="card-header fw-bold">Quyền truy cập của bạn</div>
        <div class="card-body p-0">
          <div class="table-responsive table-responsive-sm">
            <table class="table table-sm align-middle mb-0">
              <thead class="table-light">
                  <tr>
                      <th></th>
                      <th class="text-center">Đọc</th>
                      <th class="text-center">Xem</th>
                      <th class="text-center">Tạo</th>
                      <th class="text-center">Sửa</th>
                      <th class="text-center">Xóa</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($permissions as $key=> $permission)
                  <tr>
                      <td>{{ $permission->title }}</td>
                      <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                              <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->getall ? 'checked' : '' }}>
                          </div>
                      </td>
                      <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                              <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->getone ? 'checked' : '' }}>
                          </div>
                      </td>
                      <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                              <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->created ? 'checked' : '' }}>
                          </div>
                      </td>
                      <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                              <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->updated ? 'checked' : '' }}>
                          </div>
                      </td>
                      <td class="text-center">
                          <div class="form-check form-switch d-flex justify-content-center">
                              <input class="form-check-input" type="checkbox" role="switch" disabled {{ $permission->deleted ? 'checked' : '' }}>
                          </div>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-header fw-bold">Liên kết khác</div>
        <div class="card-body">
          <a href="{{ route('password.edit') }}">Đổi mật khẩu</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
$(function() {
  // nếu nhấn vào #avatar-preview thì kích hoạt input file
  $('#avatar-preview').on('click', function() {
      $('#inputGroupFileAvatar').click();
  });
  // Xem trước ảnh đại diện khi chọn tệp
  $('#inputGroupFileAvatar').on('change', function() {
      var input = this;
      if (input.files && input.files[0]) {        
          var reader = new FileReader();
          reader.onload = function(e) {
            $('#avatar-preview').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
          // Tự động gửi biểu mẫu khi chọn tệp
          $('#avatar-upload-form').submit();
      }
  });
});
// Xử lý gửi biểu mẫu tải lên ảnh đại diện
$('#avatar-upload-form').on('submit', function(e) {
  e.preventDefault();
  var formData = new FormData(this);
  $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function(res, status, xhr) { 
          if (xhr.status === 200) {
            showBootstrapToast(res.message ?? 'Cập nhật ảnh đại diện thành công!', "success");
            $('#avatar-preview').attr('src', res.avatar ?? $('#avatar-preview').attr('src'));
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
@endpush