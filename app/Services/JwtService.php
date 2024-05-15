<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Models\User;
use JWTAuth;



class JwtService
{

    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
        $this->code_200                         = Response::HTTP_OK;
        $this->code_404                         = Response::HTTP_NOT_FOUND;
        $this->code_401                         = Response::HTTP_UNAUTHORIZED;
        $this->code_409                         = Response::HTTP_CONFLICT;
        $this->code_500                         = Response::HTTP_INTERNAL_SERVER_ERROR;
    }
    
    public function genarateToken($all)
    {
        $return[$this->status]                  = false;
        $return[$this->message]                 = 'Email id not found...';
        $return[$this->code]                    = $this->code_404;
        $return[$this->data]                    = [];

        $user                                   = User::where(
            [
                ["email", "=", $all['email_id']], 
            ])->first();

        if($user)
        {
            $return[$this->status]              = false;
            $return[$this->message]             = 'Incorrect Password...';
            $return[$this->code]                = $this->code_401;
            $return[$this->data]                = [];

            if (Hash::check($all['password'], $user->password)) 
            {
                $userData['user_id']            = $user->id;
                $userData['name']               = $user->name;
                $userData['email']              = $user->email;
                $token = JWTAuth::fromUser($user->first());
                $result = [
                    'user_data'                 => $userData,
                    'access_token'              => $token,
                    'token_type'                => 'bearer',
                    'expires_in'                => JWTAuth::factory()->getTTL()*1,
                ];

                $return[$this->status]          = true;
                $return[$this->message]         = 'Successfully login..';
                $return[$this->code]            = 200;
                $return[$this->data]            = $result;
            }           
        }        

        return $return;        
    }





}
