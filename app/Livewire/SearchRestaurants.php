<?php

namespace App\Livewire;

use App\Models\Vendor;
use Livewire\Component;

class SearchRestaurants extends Component
{
    public $search='';

    public function render()
    {
        $restaurants = Vendor::where('business_name','LIKE',"%{$this->search}%")->get();;
        return view('livewire.search-restaurants',compact('restaurants'));
    }
}
