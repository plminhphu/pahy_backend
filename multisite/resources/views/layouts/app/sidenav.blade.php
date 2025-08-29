<nav class="d-flex flex-column flex-shrink-0 p-3 bg-white border-end shadow-sm" style="width: 240px; min-height: 100vh;">
    <ul class="nav nav-pills flex-column mb-auto">
        @if (Route::has('dashboard'))
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link active" aria-current="page">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
        @endif
        @if (Route::has('appointments.index'))
            <li>
                <a href="{{ route('appointments.index') }}" class="nav-link link-dark">
                    <i class="bi bi-calendar-check me-2"></i> Lịch hẹn
                </a>
            </li>
        @endif
        @if (Route::has('profile.edit'))
            <li>
                <a href="{{ route('profile.edit') }}" class="nav-link link-dark">
                    <i class="bi bi-person me-2"></i> Hồ sơ
                </a>
            </li>
        @endif
        @if (Route::has('settings'))
            <li>
                <a href="{{ route('settings') }}" class="nav-link link-dark">
                    <i class="bi bi-gear me-2"></i> Cài đặt
                </a>
            </li>
        @endif
    </ul>
</nav>
