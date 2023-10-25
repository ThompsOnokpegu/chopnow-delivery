<?php

namespace App\Livewire;

use Livewire\Component;

class MakeSlug extends Component
{
    public $slug='dodo-pizza';
    public $business_name;
    public function render()
    {
        //$this->slug = str()->slug($this->business_name);
        return view('livewire.make-slug');
    }
}
