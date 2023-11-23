@foreach ($menus as $menu)
    <tr>
        <td>
          <div class="d-flex justify-content-start align-items-center text-nowrap">
            <div class="avatar-wrapper">
                <div class="avatar me-2">
                    <img src="{{ asset('storage/menu-images/'.$menu->product_image) }}" alt="product image" class="rounded-2">
                </div>
            </div>
            <div class="d-flex flex-column">
                <h6 class="text-body mb-0">{{ $menu->name }}</h6>
                <small class="text-muted">{{ $menu->regular_price }}</small>
            </div>
          </div>
        </td>
        <td><span class="badge bg-label-success me-1">{{ $menu->category }}</span></td>
        <td>
          <div class="btn-group">
              <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end" style="">
                  <a class="dropdown-item" href="{{ route('menus.edit',$menu->id) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                  <form method="POST" action="{{ route('menus.destroy',$menu->id) }}">
                      @method('DELETE')
                      @csrf
                      <a class="dropdown-item" href="{{ route('menus.destroy',$menu->id) }}" onclick="event.preventDefault(); this.closest('form').submit();">
                          <i class="bx bx-trash me-1"></i>
                        <span class="align-middle">Delete</span>
                      </a>
                  </form>  
              </ul>
            </div>
        </td>
    </tr>
@endforeach
