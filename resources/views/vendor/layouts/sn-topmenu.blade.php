<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <!-- Search -->
  <div class="navbar-nav align-items-center">
    <div class="nav-item d-flex align-items-center">
      <i class="bx bx-search fs-4 lh-0"></i>
      <input
        type="text"
        class="form-control border-0 shadow-none"
        placeholder="Search..."
        aria-label="Search..."
      />
    </div>
  </div>
  <!-- /Search -->

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    
    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="{{asset('vendor/avatar.gif') }}" alt class="w-px-40 h-auto rounded-circle" />
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="{{asset('vendor/user.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                </div>
              </div>
              <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{ Auth::guard('vendor')->user()->first_name }}</span>
                <small class="text-muted">{{ Auth::guard('vendor')->user()->email }}</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('vendor.profile') }}">
            <i class="bx bx-cog me-2"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('vendor.compliance') }}">
            <i class="bx bx-certification me-2"></i>
            <span class="align-middle">Compliance</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('vendor.payout') }}">
            <i class="bx bx-transfer me-1"></i> 
            <span class="align-middle">Payout</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('vendor.auth') }}">
              <i class="flex-shrink-0 bx bx-lock me-2"></i>
              <span class="flex-grow-1 align-middle">Change Password</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('vendor.auth') }}">
            <span class="d-flex align-items-center align-middle">
              <i class="flex-shrink-0 bx bx-bell me-2"></i>
              <span class="flex-grow-1 align-middle">Notifications</span>
              <span class="flex-shrink-0 badge badge-center rounded-pill bg-info w-px-20 h-px-20">0</span>
            </span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
          <form method="POST" action="{{ route('vendor.logout') }}">
            @csrf
            <a class="dropdown-item" href="{{ route('vendor.logout') }}"
            onclick="event.preventDefault();
                        this.closest('form').submit();">
              <i class="bx bx-power-off me-2"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </form>
        </li>
      </ul>
    </li>
    <!--/ User -->
  </ul>
</div>
</nav>