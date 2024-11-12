<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\HomePage;
use Illuminate\Support\Facades\Route;
use App\Livewire\CategoriesPage;
use App\Livewire\ProductsPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\SuccessPage;
use Illuminate\Support\Facades\Auth;

Route::get('/',HomePage::class);
Route::get('/categories',CategoriesPage::class);
Route::get('/products',ProductsPage::class);
Route::get('/cart',CartPage::class);
Route::Get('/products/{slug}',ProductDetailPage::class);


Route::middleware('guest')->group(function(){
    Route::Get('/login',LoginPage::class)->name('login');
    Route::Get('/register',RegisterPage::class);
    Route::Get('/forgot',ForgotPasswordPage::class)->name('password.request');
    Route::Get('/reset/{token}',ResetPasswordPage::class)->name('password.reset'); 
});


Route::middleware('auth')->group(function(){
    Route::Get('/logout',function(){
        Auth::logout();
        return redirect('/');
    });
    Route::Get('/checkout',CheckoutPage::class);
Route::Get('/my-orders',MyOrdersPage::class);
Route::Get('/my-orders/{order_id}',MyOrderDetailPage::class)->name('my-orders.show');
Route::Get('/success',SuccessPage::class)->name('success');
Route::Get('/cancel',CancelPage::class)->name('cancel');
});