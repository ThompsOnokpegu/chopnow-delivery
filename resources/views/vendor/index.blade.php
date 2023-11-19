@extends('vendor.layouts.main')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 order-1">
    <div class="row row-cols-2">
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <div class="me-2">
                  <span class="badge bg-label-info p-2"><span class="bx text-info" style="content: '\20A6';">&#8358;</span></span>
                </div>
              </div>
            </div>
            <span>Sales</span>
            <h3 class="card-title text-nowrap mb-1">₦{{ $summary['totalSales'] }}</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0%</small>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <div class="me-2">
                  <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                </div>
              </div>
            </div>
            <span>Orders</span>
            <h3 class="card-title text-nowrap mb-1">{{ $summary['orderCount'] }}</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0%</small>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <div class="me-2">
                  <span class="badge bg-label-warning p-2"><i class="bx bx-dish text-warning"></i></span>
                </div>
              </div>
            </div>
            <span>Products</span>
            <h3 class="card-title text-nowrap mb-1">{{ $summary['productCount'] }}</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0%</small>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <div class="me-2">
                  <span class="badge bg-label-primary p-2"><i class="bx bx-user text-primary"></i></span>
                </div>
              </div>
            </div>
            <span>Customers</span>
            <h3 class="card-title text-nowrap mb-1">{{ $summary['customerCount'] }}</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +0%</small>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Total Revenue -->
  <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
        <div class="col-md-8">
          <h5 class="card-header m-0 me-2 pb-3">Withdrawal History</h5>
          <div id="totalRevenueChart" class="px-2"></div>
        </div>
        <div class="col-md-4">
          <div class="card-body">
            <div class="text-center">
              <div class="dropdown">
                <button
                  class="btn btn-sm btn-outline-primary dropdown-toggle"
                  type="button"
                  id="growthReportId"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  2022
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                  <a class="dropdown-item" href="javascript:void(0);">2021</a>
                  <a class="dropdown-item" href="javascript:void(0);">2020</a>
                  <a class="dropdown-item" href="javascript:void(0);">2019</a>
                </div>
              </div>
            </div>
          </div>
          <div id="growthChart"></div>
          <div class="text-center fw-semibold pt-3 mb-2">62% Company Growth</div>

          <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>2022</small>
                <h6 class="mb-0">₦32.5k</h6>
              </div>
            </div>
            <div class="d-flex">
              <div class="me-2">
                <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
              </div>
              <div class="d-flex flex-column">
                <small>2021</small>
                <h6 class="mb-0">₦41.2k</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <div class="me-2">
                  <span class="badge bg-label-info p-2"><i class="bx bx-money text-info"></i></span>
                </div>
              </div>
            </div>
            <span class="d-block mb-1">Cash</span>
            <h3 class="card-title text-nowrap mb-2">₦{{ $summary['cashPayment'] }}</h3>
            <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
          </div>
        </div>
      </div>
      <div class="col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <img src="{{asset('vendor/assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded" />
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Online</span>
            <h3 class="card-title mb-2">₦{{ $summary['onlinePayment'] }}</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
          </div>
        </div>
      </div>
      <!-- </div>
<div class="row"> -->
      <div class="col-12 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
              <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                  <h5 class="text-nowrap mb-2">Wallet Balance</h5>
                  <span class="badge bg-label-warning rounded-pill">Available for Withdrawal</span>
                </div>
                <div class="mt-sm-auto">
                  <small class="text-success text-nowrap fw-semibold">
                  <h5 class="mb-0">₦{{ $summary['walletBalance'] }}</h5>
                </div>
              </div>
              {{-- <div id="profileReportChart"></div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection