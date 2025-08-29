<x-guest-layout>
  <div class="login-box mx-auto mt-5 p-4 bg-white rounded shadow-sm" style="max-width:360px">
    <h4 class="mb-3 text-center">Đăng nhập</h4>
    <div id="loginForm">
        <sl-input id="email" name="email" type="email" label="Email" required clearable></sl-input>
        <div class="my-3">
            <sl-input id="password" name="password" type="password" label="Mật khẩu" required toggle-password></sl-input>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <sl-checkbox id="remember" name="remember">Ghi nhớ đăng nhập</sl-checkbox>
            <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
        </div>
        <sl-button id="btnLogin" variant="primary" class="w-100">
            <sl-spinner slot="prefix" style="display:none" id="loading"></sl-spinner>
            Đăng nhập
        </sl-button>
    </div>
  </div>
  <script>
  $(function () {
      $("#btnLogin").on("click", function () {
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let remember = $("#remember").is(":checked");
        if (!email || !password) {
            return showToast("Vui lòng nhập email và mật khẩu!", "danger");
        }
        $("#loading").show();
        $("#btnLogin").attr("disabled", true);
        $.ajax({
            url: "{{ route('login') }}",
            method: "POST",
            data: {
            _token: "{{ csrf_token() }}",
            email,
            password,
            remember
            },
            success: () => window.location.href = "{{ route('dashboard') }}",
            error: (xhr) => {
                $("#loading").hide();
                $("#btnLogin").attr("disabled", false);
                showToast(xhr.responseJSON?.message || "Đăng nhập thất bại", "danger");
        }
        });
      });
  });
  </script>
</x-guest-layout>
