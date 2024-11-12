<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;
#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;
    public function render()
    {
        $my_orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view('livewire.my-orders-page',[
            'orders'=>$my_orders,
        ]);
       
    }
}