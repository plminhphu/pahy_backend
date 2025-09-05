@extends('layouts.guest')
@section('content')
<div class="pt-md-5 pt-2 mt-md-5 mt-2">
    <div class="mx-auto mt-5 p-4 mx-2 bg-white rounded shadow-lg" style="max-width:400px">
        <h4 class="mb-3 text-center">Đăng nhập</h4>
        <form id="loginForm" autocomplete="off">
            <div class="mb-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Mật khẩu</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>
            <button type="button" id="btnLogin" class="btn btn-primary w-100 position-relative mt-4">
                Đăng nhập
            </button>
        </form>
    </div>
</div>
@endsection
@push('scripts')
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
        $("#btnLogin").attr("disabled", true);
        $("#btnLogin").html('<span class="spinner-border spinner-border-sm" role="status"></span>');
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
                $("#btnLogin").attr("disabled", false);
                $("#btnLogin").html('Đăng nhập');
                showBootstrapToast(xhr.responseJSON?.message || "Đăng nhập thất bại", "danger");
            }
        });
    });
});
</script>
@endpush