<?php

namespace App\Services;

use App\CustomException\CustomException as CustomExceptionCustomException;
use App\Exceptions\GeneralJsonException;
use App\Repositories\UserRepo;
use App\ResponseHandlers\CustomException;
use App\ResponseHandlers\UnAuthorizedException;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class UserService{

    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register($data)
    {
        Log::info('in service');
        
        $existingUser = $this->userRepo->findByEmail($data['email']);
        if ($existingUser) {
            throw new GeneralJsonException('User with this email already exists',404);
        }
        $result = $this->userRepo->register($data);
       
    }

    public function login($data)
    {

        $user = $this->userRepo->findByEmail($data['email']);
    
        if (!$user) {
            throw new GeneralJsonException('Invalid Email',404);
        }
    
        if (!Hash::check($data['password'], $user->password)) {
            throw new GeneralJsonException('Invalid Password',404);
        }
    
        Log::info('User authenticated successfully', ['user_id' => $user->id]);
        return $user;
    }

  
}