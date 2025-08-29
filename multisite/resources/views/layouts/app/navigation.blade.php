<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <x-application-logo class="me-2" style="height:32px;" />
            <span class="fw-semibold text-dark">MyApp</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
            data-bs-target="#navbarContent" aria-controls="navbarContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold' : '' }}"
                       href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                @auth
                    <sl-dropdown hoist>
                        <sl-button slot="trigger" caret>
                            {{ Auth::user()->name ?? 'N/A'}}
                        </sl-button>
                        <sl-menu>
                            @if (Route::has('profile.edit'))
                            <sl-menu-item class="px-0">
                                <sl-button variant="text" href="{{ route('profile.edit') }}">
                                    <sl-icon slot="prefix" name="person-square"></sl-icon>
                                    Trang cá nhân
                                </sl-button>
                            </sl-menu-item>
                            @endif
                            @if (Route::has('password.edit'))
                            <sl-menu-item>
                                <sl-button variant="text" href="{{ route('password.edit') }}">
                                    <sl-icon slot="prefix" name="person-lock"></sl-icon>
                                    Đổi mật khẩu
                                </sl-button>
                            </sl-menu-item>
                            @endif
                            @if (Route::has('logout'))
                            <sl-divider></sl-divider>
                            <sl-menu-item>
                                <sl-button variant="text" href="{{ route('logout') }}">
                                    <sl-icon slot="prefix" name="power"></sl-icon>
                                    Đăng xuất
                                </sl-button>
                            </sl-menu-item>
                            @endif
                        </sl-menu>
                    </sl-dropdown>
                @endauth
                @guest
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Đăng nhập</a>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>