@foreach ($menus as $menu)
    <tr>
        <td>
        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-md pull-up" title="" data-bs-original-title="Lilian Fuller">
            <img src="{{ asset('product-images/'.$menu->product_image) }}" alt="product_image" style="border-radius: 10px;">
            
            </li>
        </ul>
        </td>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $menu->name }}</strong></td>
        <td>{{ $menu->regular_price }}</td>
       
        <td><span class="badge bg-label-primary me-1">{{ $menu->category }}</span></td>
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
