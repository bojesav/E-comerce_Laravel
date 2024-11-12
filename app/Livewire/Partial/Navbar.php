<?php

namespace App\Livewire\Partial;

use App\Helpers\CartManagement as HelpersCartManagement;
use Livewire\Component;
use App\Services\CartManagement; // Adjust the namespace according to the actual location of CartManagement
use Livewire\Attributes\On;

class Navbar extends Component
{

    public $total_count = 0;

    public function mount(){
        $this->total_count = count(HelpersCartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount($total_count){
        $this->total_count = $total_count;
    }
    public function render()
    {
        return view('livewire.partial.navbar');
    }
}
