<ul class="nav nav-pills flex-column flex-md-row mb-3">
    <li class="nav-item">
      <a wire:navigate class="nav-link{{ Request::is('vendor/profile') ? ' active' : '' }}" href="{{ route('vendor.profile') }}"><i class="bx bx-user me-1"></i> Account</a>
    </li>
    <li class="nav-item">
      <a wire:navigate class="nav-link{{ Request::is('vendor/payout') ? ' active' : '' }}" href="{{ route('vendor.payout') }}">
        <i class="bx bx-transfer me-1"></i> 
        Payout
      </a>
    </li>
    <li class="nav-item">
      <a wire:navigate class="nav-link{{ Request::is('vendor/authentication') ? ' active' : '' }}" href="{{ route('vendor.auth') }}">
        <i class="bx bx-lock me-1"></i> 
        Authentication
      </a>
    </li>
    <li class="nav-item">
      <a wire:navigate class="nav-link{{ Request::is('vendor/compliance') ? ' active' : '' }}" href="{{ route('vendor.compliance') }}">
        <i class="bx bx-certification me-1"></i> 
        KYC Compliance
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('vendor.dashboard') }}">
        <i class="bx bx-exit me-1"></i> 
        Return to Dashboard</a>
    </li>
</ul>