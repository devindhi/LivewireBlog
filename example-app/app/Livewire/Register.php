<?php

namespace App\Livewire;


use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use PgSql\Lob;

class Register extends Component
{
   

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $contact;
    
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'contact' => 'required',
        'password' => 'required|string|min:8|confirmed',
        'password_confirmation' => 'required|string|min:8',
    ];

    public function register()
    {
        $this->validate();
        
            Log::info('Starting registration process in Livewire');
           
             
            $response = Http::post(route('register.post'), [
                'name' => $this->name,
                'email' => $this->email,
                'contact'=>$this->contact,
                'password' => $this->password
               
            ]);
    
            Log::info('Received response', ['status' => $response->status()]);
    
            if ($response->successful()) {
                Log::info('Registration successful');
                return redirect()->to('/');
               
            } else {
                Log::error('Registration failed', [
                   
                ]);
                
            }
        
    }

    public function render()
    {
        return view('livewire.register-form');
    }

   
}
