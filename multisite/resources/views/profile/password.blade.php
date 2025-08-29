<x-app-layout>
  <div class="login-box mx-auto mt-5 p-4 bg-white rounded shadow-lg" style="max-width:360px">
    <h4 class="mb-3 text-center">Đổi mật khẩu</h4>
    <div id="changePasswordForm">
        <div class="mb-3">
          <sl-input id="current_password" name="current_password" type="password" label="Mật khẩu hiện tại" required password-toggle></sl-input>
        </div>
        <div class="mb-3">
          <sl-input id="new_password" name="new_password" type="password" label="Mật khẩu mới" required password-toggle></sl-input>
        </div>
        <div class="mb-3">
          <sl-input id="new_password_confirmation" name="new_password_confirmation" type="password" label="Nhập lại mật khẩu mới" required password-toggle></sl-input>
        </div>
        <sl-button id="btnChangePassword" variant="primary" class="w-100">
          <sl-spinner slot="prefix" style="display:none" id="loading"></sl-spinner>
          Đổi mật khẩu
        </sl-button>
    </div>
  </div>

  <script>
  $(function () {
      $("#btnChangePassword").on("click", function () {
        let current_password = $("#current_password").val().trim();
        let new_password = $("#new_password").val().trim();
        let new_password_confirmation = $("#new_password_confirmation").val().trim();

        if (!current_password || !new_password || !new_password_confirmation) {
            return showToast("Vui lòng nhập đầy đủ các trường!", "danger");
        }
        if (new_password !== new_password_confirmation) {
            return showToast("Mật khẩu nhập lại không khớp!", "danger");
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
                showToast(res.message || "Đổi mật khẩu thành công!", "success");
                $("#loading").hide();
                $("#btnChangePassword").attr("disabled", false);
                $("#current_password, #new_password, #new_password_confirmation").val("");
            },
            error: (xhr) => {
                $("#loading").hide();
                $("#btnChangePassword").attr("disabled", false);
                showToast(xhr.responseJSON?.message || "Đổi mật khẩu thất bại", "danger");
            }
        });
      });
  });
  </script>
</x-app-layout>
