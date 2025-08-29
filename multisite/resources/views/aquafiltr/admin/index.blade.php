@extends('layouts.app')
@section('content')
  <div id="dashboard" class="container py-5" style="display:none">
      <h2 class="mb-4 text-center">Chào mừng bạn đến Dashboard 🎉</h2>
      <div class="row g-3">
          <div class="col-md-4">
              <div class="card shadow-sm h-100">
                  <div class="card-header">
                      <h5 class="mb-0">Thống kê</h5>
                  </div>
                  <div class="card-body">
                      <p>Bạn đã đăng nhập thành công.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card shadow-sm h-100">
                  <div class="card-header">
                      <h5 class="mb-0">Thông tin</h5>
                  </div>
                  <div class="card-body">
                      <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card shadow-sm h-100">
                  <div class="card-header">
                      <h5 class="mb-0">Hành động</h5>
                  </div>
                  <div class="card-body">
                      <form id="logoutForm">
                          @csrf
                          <button type="submit" class="btn btn-danger w-100">Đăng xuất</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <script>
    $(function () {
        $("#dashboard").fadeIn(600);
        // logout ajax
        $("#logoutForm").on("submit", function(e){
            e.preventDefault();

            $.post("{{ route('logout') }}", {
                _token: "{{ csrf_token() }}"
            }).done(() => {
                window.location.href = "{{ route('login') }}";
            });
        });
    });
  </script>
@endsection
