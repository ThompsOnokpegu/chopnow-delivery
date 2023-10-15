@extends('vendor.layouts.main')

@section('content')
<!-- Product List Widget -->

<div class="card mb-4">
    <div class="card-widget-separator-wrapper">
      <div class="card-body card-widget-separator">
        <div class="row gy-4 gy-sm-1">
          <div class="col-sm-6 col-lg-3">
            <div class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
              <div>
                <h6 class="mb-2">In-store Sales</h6>
                <h4 class="mb-2">$5,345.43</h4>
                <p class="mb-0"><span class="text-muted me-2">5k orders</span><span class="badge bg-label-success">+5.7%</span></p>
              </div>
              <div class="avatar me-sm-4">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="bx bx-store-alt bx-sm"></i>
                </span>
              </div>
            </div>
            <hr class="d-none d-sm-block d-lg-none me-4">
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
              <div>
                <h6 class="mb-2">Website Sales</h6>
                <h4 class="mb-2">$674,347.12</h4>
                <p class="mb-0"><span class="text-muted me-2">21k orders</span><span class="badge bg-label-success">+12.4%</span></p>
              </div>
              <div class="avatar me-lg-4">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="bx bx-laptop bx-sm"></i>
                </span>
              </div>
            </div>
            <hr class="d-none d-sm-block d-lg-none">
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
              <div>
                <h6 class="mb-2">Discount</h6>
                <h4 class="mb-2">$14,235.12</h4>
                <p class="mb-0 text-muted">6k orders</p>
              </div>
              <div class="avatar me-sm-4">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="bx bx-gift bx-sm"></i>
                </span>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="d-flex justify-content-between align-items-start">
              <div>
                <h6 class="mb-2">Affiliate</h6>
                <h4 class="mb-2">$8,345.23</h4>
                <p class="mb-0"><span class="text-muted me-2">150 orders</span><span class="badge bg-label-danger">-3.5%</span></p>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="bx bx-wallet bx-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Product List Table -->
  <div class="card">
    <div class="card-header">
      <h5 class="card-title">Filter</h5>
      <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
        <div class="col-md-4 product_status"><select id="ProductStatus" class="form-select text-capitalize"><option value="">Status</option><option value="Scheduled">Scheduled</option><option value="Publish">Publish</option><option value="Inactive">Inactive</option></select></div>
        <div class="col-md-4 product_category"><select id="ProductCategory" class="form-select text-capitalize"><option value="">Category</option><option value="Household">Household</option><option value="Office">Office</option><option value="Electronics">Electronics</option><option value="Shoes">Shoes</option><option value="Accessories">Accessories</option><option value="Game">Game</option></select></div>
        <div class="col-md-4 product_stock"><select id="ProductStock" class="form-select text-capitalize"><option value=""> Stock </option><option value="Out_of_Stock">Out of Stock</option><option value="In_Stock">In Stock</option></select></div>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table card-table">
          <thead>
            <tr>
              <th>Project</th>
              <th>Client</th>
              <th>Users</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <tr>
              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Angular Project</strong></td>
              <td>Albert Cook</td>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <img src="assets/img/avatars/5.png" alt="Avatar" class="rounde-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Sophia Wilkerson">
                    <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                  </li>
                  
                </ul>
              </td>
              <td><span class="badge bg-label-primary me-1">Active</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><i class="fab fa-react fa-lg text-info me-3"></i> <strong>React Project</strong></td>
              <td>Barry Hunter</td>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Sophia Wilkerson">
                    <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                  </li>
                  
                </ul>
              </td>
              <td><span class="badge bg-label-success me-1">Completed</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td><i class="fab fa-vuejs fa-lg text-success me-3"></i> <strong>VueJs Project</strong></td>
              <td>Trevor Baker</td>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Sophia Wilkerson">
                    <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                  </li>
                  
                </ul>
              </td>
              <td><span class="badge bg-label-info me-1">Scheduled</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <i class="fab fa-bootstrap fa-lg text-primary me-3"></i> <strong>Bootstrap Project</strong>
              </td>
              <td>Jerry Milton</td>
              <td>
                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Lilian Fuller">
                    <img src="assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                  </li>
                  <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="" data-bs-original-title="Sophia Wilkerson">
                    <img src="assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
                  </li>
                  
                </ul>
              </td>
              <td><span class="badge bg-label-warning me-1">Pending</span></td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-show-alt me-1"></i> View</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
  @endsection