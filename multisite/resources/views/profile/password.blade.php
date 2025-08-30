@extends('layouts.app')
@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <div class="card shadow mb-4">
          <h5 class="card-header text-center mb-0">Đổi mật khẩu</h5>
        <div class="card-body">
          <form id="changePasswordForm" autocomplete="off">
            <div class="mb-3">
              <label for="current_password" class="form-label">Mật khẩu hiện tại</label>
              <div class="input-group">
                <input type="password" class="form-control" id="current_password" name="current_password" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#current_password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
            <div class="mb-3">
              <label for="new_password" class="form-label">Mật khẩu mới</label>
              <div class="input-group">
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#new_password">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
            <div class="mb-3">
              <label for="new_password_confirmation" class="form-label">Nhập lại mật khẩu mới</label>
              <div class="input-group">
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#new_password_confirmation">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
            <button type="button" id="btnChangePassword" class="btn btn-primary w-100 position-relative">
              <span id="loading" class="spinner-border spinner-border-sm position-absolute start-0 ms-3" style="display:none"></span>
              Đổi mật khẩu
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <script>
  $(function () {
    // Nút ẩn/hiện mật khẩu
    $(".toggle-password").on("click", function () {
      const target = $($(this).data("target"));
      const icon = $(this).find("i");
      if (target.attr("type") === "password") {
        target.attr("type", "text");
        icon.removeClass("bi-eye").addClass("bi-eye-slash");
      } else {
        target.attr("type", "password");
        icon.removeClass("bi-eye-slash").addClass("bi-eye");
      }
    });

    $("#btnChangePassword").on("click", function () {
      let current_password = $("#current_password").val().trim();
      let new_password = $("#new_password").val().trim();
      let new_password_confirmation = $("#new_password_confirmation").val().trim();

      if (!current_password || !new_password || !new_password_confirmation) {
        showBootstrapToast("Vui lòng nhập đầy đủ các trường!", "danger");
        return;
      }
      if (new_password !== new_password_confirmation) {
        showBootstrapToast("Mật khẩu nhập lại không khớp!", "danger");
        return;
      }

      $("#loading").show();
      $("#btnChangePassword").attr("disabled", true);
      $.ajax({
        url: "{{ route('password.update') }}",
        method: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          current_password,
          new_password,
          new_password_confirmation
        },
        success: (res) => {
          showBootstrapToast(res.message || "Đổi mật khẩu thành công!", "success");
          $("#loading").hide();
          $("#btnChangePassword").attr("disabled", false);
          $("#current_password, #new_password, #new_password_confirmation").val("");
        },
        error: (xhr) => {
          $("#loading").hide();
          $("#btnChangePassword").attr("disabled", false);
          showBootstrapToast(xhr.responseJSON?.message || "Đổi mật khẩu thất bại", "danger");
        }
      });
    });
  });
  </script>
@endsection