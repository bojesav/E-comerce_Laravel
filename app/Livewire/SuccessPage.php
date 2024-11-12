<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url ;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class SuccessPage extends Component
{
    #[Url]
    public $session_id;
    public function render(){
        $latest_order= Order::with('address')->where('user_id',Auth::user()->id)->latest()->first();
        if($this->session_id){
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session_info = Session::retrieve($this->session_id);

            if($session_info->payment_status != 'paid'){
                $latest_order->payment_status = 'failed';
                $latest_order->save();
                return redirect()->route('cancel');

            }else if($session_info->payment_status == 'paid'){
                $latest_order->payment_status = 'paid';
                $latest_order->save(); 

            }
        }
        return view('livewire.success-page',[
            'order'=>$latest_order,
        ]);
    }
}