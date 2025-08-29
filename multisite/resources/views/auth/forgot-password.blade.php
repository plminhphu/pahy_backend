@extends('layouts.guest')
@section('content')
  <div class="mx-auto mt-5 p-4 bg-white rounded shadow-lg" style="max-width:360px">
    <h4 class="mb-3 text-center">Quên mật khẩu</h4>
    <form id="forgotForm" autocomplete="off">
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <button type="button" id="btnForgot" class="btn btn-primary w-100 position-relative mt-3">
        <span id="loading" class="spinner-border spinner-border-sm position-absolute start-0 ms-3" style="display:none"></span>
        Lấy lại mật khẩu
      </button>
    </form>
  </div>
  <script>
  $(function () {
      $("#btnForgot").on("click", function () {
        let email = $("#email").val().trim();
        if (!email) {
            return toastr.error("Vui lòng nhập email!");
        }
        $("#loading").show();
        $("#btnForgot").attr("disabled", true);
        $.ajax({
            url: "{{ route('password.email') }}",
            method: "POST",
            data: {
            _token: "{{ csrf_token() }}",
            email
            },
            success: (res) => {
                toastr.success(res.message || "Vui lòng kiểm tra email!");
                $("#loading").hide();
                $("#btnForgot").attr("disabled", false);
                $("#email").val("");
            },
            error: (xhr) => {
                $("#loading").hide();
                $("#btnForgot").attr("disabled", false);
                toastr.error(xhr.responseJSON?.message || "Lấy lại mật khẩu thất bại");
        }
        });
      });
  });
  </script>
@endsection