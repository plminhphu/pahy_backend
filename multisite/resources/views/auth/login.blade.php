@extends('layouts.guest')
@section('content')
    <div class="mx-auto mt-5 p-4 bg-white rounded shadow-lg" style="max-width:360px">
        <h4 class="mb-3 text-center">Đăng nhập</h4>
        <form id="loginForm" autocomplete="off">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ghi nhớ đăng nhập</label>
                </div>
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            </div>
            <button type="button" id="btnLogin" class="btn btn-primary w-100 position-relative">
                <span id="loading" class="spinner-border spinner-border-sm position-absolute start-0 ms-3" style="display:none"></span>
                Đăng nhập
            </button>
        </form>
    </div>
    <script>
    $(function () {
        // Ẩn/hiện mật khẩu
        $("#togglePassword").on("click", function () {
            const passInput = $("#password");
            const icon = $(this).find("i");
            if (passInput.attr("type") === "password") {
                passInput.attr("type", "text");
                icon.removeClass("bi-eye").addClass("bi-eye-slash");
            } else {
                passInput.attr("type", "password");
                icon.removeClass("bi-eye-slash").addClass("bi-eye");
            }
        });

        // Kiểm tra các trường trước khi gửi
        $("#btnLogin").on("click", function () {
            let email = $("#email").val().trim();
            let password = $("#password").val().trim();
            let remember = $("#remember").is(":checked");
            if (!email) {
                showBootstrapToast("Vui lòng nhập email!", "danger");
                $("#email").focus();
                return;
            }
            // Kiểm tra định dạng email
            const emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            if (!emailPattern.test(email)) {
                showBootstrapToast("Email không hợp lệ!", "danger");
                $("#email").focus();
                return;
            }
            if (!password) {
                showBootstrapToast("Vui lòng nhập mật khẩu!", "danger");
                $("#password").focus();
                return;
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
                    showBootstrapToast(xhr.responseJSON?.message || "Đăng nhập thất bại", "danger");
                }
            });
        });
    });
    </script>
@endsection
