<x-app-layout>
  <div id="dashboard" class="container py-5" style="display:none">
      <h2 class="mb-4 text-center">Chào mừng bạn đến Dashboard 🎉</h2>
      <div class="row g-3">
          <div class="col-md-4">
              <sl-card class="shadow-sm">
                  <h5 slot="header">Thống kê</h5>
                  <p>Bạn đã đăng nhập thành công.</p>
              </sl-card>
          </div>
          <div class="col-md-4">
              <sl-card class="shadow-sm">
                  <h5 slot="header">Thông tin</h5>
                  <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
              </sl-card>
          </div>
          <div class="col-md-4">
              <sl-card class="shadow-sm">
                  <h5 slot="header">Hành động</h5>
                  <form id="logoutForm">
                      @csrf
                      <sl-button type="submit" variant="danger" class="w-100">
                          Đăng xuất
                      </sl-button>
                  </form>
              </sl-card>
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
</x-app-layout>
