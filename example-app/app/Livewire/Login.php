<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Http;


class Login extends Component
{



    public $email;
    public $password;

    protected $rules = [

        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',

    ];

    public function login()
    {
        $this->validate();

        Log::info('Starting loggging process in Livewire');


        $response = Http::post(route('login.post'), [

            'email' => $this->email,
            'password' => $this->password

        ]);

        Log::info('Received response', ['status' => $response->status()]);

        if ($response->successful()) {
            Log::info('login ok');
        } 
    }

    public function render()
    {
        return view('livewire.login-form');
    }
}
