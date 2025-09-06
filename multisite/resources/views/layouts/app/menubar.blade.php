@php
$menuItems = [
  [
    'label' => 'Khách hàng',
    'icon' => 'bi bi-person-rolodex',
    'children' => [
      [
        'label' => 'DS khách hàng',
        'icon' => 'bi bi-person-bounding-box',
        'route' => route('customer.index'),
      ],
    ],
  ],
  [
    'label' => 'Lịch hẹn',
    'icon' => 'bi bi-calendar-day',
    'children' => [
      [
        'label' => 'Đặt lịch hẹn',
        'icon' => 'bi bi-calendar-plus',
        'route' => route('appointment.create'),
      ],
      [
        'label' => 'DS lịch hẹn',
        'icon' => 'bi bi-calendar-date',
        'route' => route('appointment.index'),
      ],
      [
        'label' => 'Lịch Bảo trì',
        'icon' => 'bi bi-calendar-check',
        'route' => route('dashboard'),
      ],
    ],
  ],
  [
    'label' => 'Thiết bị',
    'icon' => 'bi bi-cpu',
    'children' => [
      [
        'label' => 'DS thiết bị',
        'icon' => 'bi bi-list',
        'route' => route('device.index'),
      ],
    ],
  ],
  // [
  //   'label' => 'Nhân viên',
  //   'icon' => 'bi bi-person-circle',
  //   'children' => [
  //     [
  //       'label' => 'DS nhân viên',
  //       'icon' => 'bi bi-person-vcard',
  //       'route' => route('user.index'),
  //     ],
  //     [
  //       'label' => 'Phân quyền',
  //       'icon' => 'bi bi-person-gear',
  //       'route' => route('role.index'),
  //     ],
  //   ],
  // ],
];
$currentRoute = url()->current();
@endphp
<div class="offcanvas offcanvas-start vh-100 border-0" tabindex="-1" id="menu">
  <div class="offcanvas-header bg-light border-bottom pe-1">
    <div class="d-flex justify-content-between align-items-center w-100">
      <div class="offcanvas-title fw-bold">Admin Dashboard</div>
      <div class="d-flex justify-content-center align-items-center">
        <button type="button" class="btn-close d-md-none d-block" data-bs-dismiss="offcanvas"></button>
        <button type="button" id="closeMenu" class="btn btn-light py-0 px-2" data-bs-toggle="offcanvas" data-bs-target="#menu">
          <i class="bi bi-chevron-bar-left d-none d-md-block" style="font-size: 1.4rem;"></i>
        </button>
      </div>
    </div>
  </div>
  <div class="offcanvas-body shadow-sm border-end p-0">
    <ul class="nav flex-column">
      @foreach ($menuItems as $menuItem)
        <li class="nav-item">
          @if (isset($menuItem['children']))
            <a class="m-2 px-2 py-1 nav-link d-flex align-items-center fw-medium text-secondary-emphasis" data-bs-toggle="collapse" href="#menu-{{ Str::slug($menuItem['label']) }}" role="button" aria-expanded="{{ collect($menuItem['children'])->pluck('route')->contains($currentRoute) ? 'true' : 'false' }}" aria-controls="menu-{{ Str::slug($menuItem['label']) }}">
              <i class="{{ $menuItem['icon'] }} me-2" style="font-size: 1.2rem;"></i>
              {{ $menuItem['label'] }}
              <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <div class="collapse {{ collect($menuItem['children'])->pluck('route')->contains($currentRoute) ? 'show' : '' }}" id="menu-{{ Str::slug($menuItem['label']) }}">
              <ul class="nav flex-column ms-3">
                @foreach ($menuItem['children'] as $child)
                  <li class="nav-item">
                    <a class="px-2 py-1 mx-1 nav-link d-flex align-items-center {{ $child['route'] == $currentRoute ? 'active fw-bolder text-primary bg-primary-subtle rounded my-0' : 'fw-medium text-secondary-emphasis my-1' }}" href="{{ $child['route'] }}">
                      @if ($child['icon'])
                        <i class="{{ $child['icon'] }} me-2" style="font-size: 1rem;"></i>
                      @endif
                      {{ $child['label'] }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </div>
          @else
            <a class="m-2 px-2 py-1 nav-link d-flex align-items-center {{ $menuItem['route'] == $currentRoute ? 'active fw-bolder text-primary bg-primary-subtle rounded' : 'fw-medium text-secondary-emphasis' }}" href="{{ $menuItem['route'] }}">
              <i class="{{ $menuItem['icon'] }} me-2" style="font-size: 1.2rem;"></i>
              {{ $menuItem['label'] }}
            </a>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</div>