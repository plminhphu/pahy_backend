<nav class="navbar navbar-light bg-light px-2 shadow-sm border-bottom">
    <div class="d-flex">
        <button type="button" id="openMenu" class="btn btn-light py-0 px-2" data-bs-toggle="offcanvas" data-bs-target="#menu">
            <i id="openMenuI" class="bi bi-chevron-bar-right d-none" style="font-size: 1.4rem;"></i>
            <span class="bi bi-list d-block d-md-none" style="font-size: 1.8rem;"></span>
        </button>
    </div>
    <div class="btn-group">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            @if (Auth::check()) 
                <i class="bi bi-person-circle me-2"></i>
                {{ Auth::user()->name }}
            @else
                <a href="{{ rote('login') }}">Đăng nhập</a>
            @endif
        </button>
        <ul class="dropdown-menu me-3 shadow-lg">
            <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-circle me-2"></i>
                    Thông tin cá nhân
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('password.edit') }}">
                    <i class="bi bi-braces-asterisk me-2"></i>
                    Đổi mật khẩu
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalLogout">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Đăng xuất
                </a>
            </li>
        </ul>
    </div>
</nav>
<div id="modalLogout" class="modal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Đăng xuất tài khoản</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Bạn có muốn đăng xuất khỏi trình duyệt này?</p>
      </div>
      <div class="modal-footer">
        <a  href="{{ route('logout') }}" type="button" class="btn btn-danger">Đăng xuất ngay</a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
      </div>
    </div>
  </div>
</div>