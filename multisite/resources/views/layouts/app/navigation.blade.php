
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-calendar-day" viewBox="0 0 16 16">
                <path
                    d="M4.684 11.523v-2.3h2.261v-.61H4.684V6.801h2.464v-.61H4v5.332zm3.296 0h.676V8.98c0-.554.227-1.007.953-1.007.125 0 .258.004.329.015v-.613a2 2 0 0 0-.254-.02c-.582 0-.891.32-1.012.567h-.02v-.504H7.98zm2.805-5.093c0 .238.192.425.43.425a.428.428 0 1 0 0-.855.426.426 0 0 0-.43.43m.094 5.093h.672V7.418h-.672z" />
                <path
                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
            </svg>
            <span class="fw-semibold text-dark">{{ __('Dashboard') }}</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <form class="d-flex ms-auto me-3 align-items-center" role="search"
                onsubmit="event.preventDefault(); showBootstrapToast('Tìm kiếm: ' + this.elements.search.value, 'info');">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="Tìm kiếm..." aria-label="Search"
                        name="search">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
            <ul class="navbar-nav align-items-center">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" id="userDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://yevgenysim-turkey.github.io/dashbrd/assets/img/photos/photo-2.jpg"
                                alt="avatar" width="28" height="28" class="rounded-circle me-2">
                            {{ Auth::user()->name ?? 'N/A' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            @if (Route::has('profile.edit'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="bi bi-person-square me-2"></i>Trang cá nhân
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('password.edit'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('password.edit') }}">
                                        <i class="bi bi-person-lock me-2"></i>Đổi mật khẩu
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('logout'))
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="bi bi-power me-2"></i>Đăng xuất
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endauth
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary ms-2">Đăng nhập</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>
