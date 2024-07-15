<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class UserRepo{
    public function register($data){

        Log::info('in repo');
        // Create a new user record in the database
        $user = User::create([
            'name' => $data['name'],
            'contact'=>$data['contact'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']), // Hash the password for security
        ]);

        // Return the created user object
        return $user;

    }

   
 
    public function findByEmail($email)
    {
        $user = User::where('email', $email)->first();
        
        return $user ? $user : null;
    }
    
}