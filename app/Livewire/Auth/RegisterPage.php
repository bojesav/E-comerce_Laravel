<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
#[Title('Register')]
class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;
    
    public function save(){
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255',
        ]);
        
        // save to database
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

    
        Auth::login($user);
        return redirect()->intended();

        }
    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
