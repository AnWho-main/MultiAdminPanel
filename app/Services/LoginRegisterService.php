<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\V1\BaseController;
use Symfony\Component\HttpFoundation\Response;
use Log;
use DB;
use App\Services\JwtService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\CommonService;
use App\Services\EmailService;
use Exception;




class LoginRegisterService
{

    public function __construct()
    {
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->data                         = 'data';
        $this->commonSer                    = new CommonService();
        $this->emailService                 = new EmailService();
        
    }
    
    public function register($param)
    {

        $return[$this->status]              = false;
        $return[$this->message]             = 'Oops, something went wrong...';
        $return[$this->code]                = 500;
        $return[$this->data]                = [];

        if($param['email'] != '' && !empty($param['email']))
        {
            $added_at                       = date("Y-m-d H:i:s");
            $exist                          = $this->checkEmailExist($param);

            if($exist[$this->status])
            {
                $return[$this->code]        = $exist[$this->code];
                $return[$this->status]      = $exist[$this->status];
                $return[$this->message]     = $exist[$this->message];
                $return[$this->data]        = $exist[$this->data];

                return $return;
            }
            \DB::beginTransaction();
            try{
                
                $user                       = new User;                
                $user->name                 = $param['name'];
                $user->email                = $param['email'];
                $user->mobile               = $param['mobile'];
                $user->password             = Hash::make($param['password']);
                $user->created_at           = $added_at;
                $user->updated_at           = $added_at;
                $store                      = $user->save();                
            }
            catch (Exception $e) {
                $except['status']           = false;
                $except['error'][]          = 'Exception Error...';
                $except['message']          = $e;
                $exception                  = new BaseController();
                $exception                  = $exception->throwExceptionError($except, 500);
            }
            \DB::commit();

            $data = [];
            $data['user_id']                = $user->id;
            $data['email']                  = $param['email'];

            if($store)
            {
                // send email here for verificaion
                $return[$this->status]      = true;
                $return[$this->message]     = 'Successfully Registered...';
                $return[$this->code]        = 200;
                $return[$this->data]        = $data;

            }
            else
            {
                $return[$this->status]      = false;
                $return[$this->message]     = 'Oops, please try again...';
                $return[$this->code]        = 500;
            }
        }
        
        return $return;        
        
    }


    public function checkEmailExist($param)
    {
        $user                                       = User::where('email',$param['email'])->first();

        if($user)
        {
            $data['user_id']                        = $user->id;
            $data['email']                          = $user->email;

            $return[$this->status]                  = false;
            $return[$this->message]                 = 'Email Id already exist...';
            $return[$this->code]                    = 409;
            $return[$this->data]                    = $data;
        }
        else
        {
            $return[$this->status]                  = false;
            $return[$this->message]                 = 'Email Id not found...';
            $return[$this->code]                    = 404;
            $return[$this->data]                    = [];
        }
        return $return;
    }





    public function loginUser($param)
    {
        $jwtServ = new JwtService();
        $result = $jwtServ->genarateToken($param);
        return $result;
    }


    public function updateEmailStatus($param)
    {
        $added_at                       = date("Y-m-d H:i:s");
        \DB::beginTransaction();
        try{

            $updateSt = UserMaster::where('email',$param['email_id'])
                        ->take(1)
                        ->update(
                            ['email_verified_at' => $added_at],
                            ['is_email_verify' => 1]
                        );
            if($updateSt)
            {
                $return[$this->status]          = true;
                $return[$this->message]         = 'Successfully email verified...';
                $return[$this->code]            = 200;
                $return[$this->data]            = [];
                
            }
            else
            {
                $return[$this->status]          = false;
                $return[$this->message]         = 'Oops, some problem occure, Please try again...';
                $return[$this->code]            = 201;
                $return[$this->data]            = [];
            }
            return $return;
        }catch (Exception $e) {
            $except['status'] = false;
            $except['error'][] = 'Exception Error...';
            $except['message'] = $e;
            $exception = new BaseController();
            $exception = $exception->throwExceptionError($except, $this->code_500);
        }
        \DB::commit();
    }




    public function checkEmailAvailable($param)
    {
        $user                                       = User::where('email',$param['email'])->first();

        if($user)
        {
            $data['user_id']                        = $user->id;
            $data['first_name']                     = $user->first_name;
            $data['last_name']                      = $user->last_name;
            $data['email']                          = $user->email;

            $return[$this->status]                  = true;
            $return[$this->message]                 = 'Email Id found...';
            $return[$this->code]                    = 200;
            $return[$this->data]                    = $data;
        }
        else
        {
            $return[$this->status]                  = false;
            $return[$this->message]                 = 'Email Id not found...';
            $return[$this->code]                    = 404;
            $return[$this->data]                    = [];
        }
        return $return;
    }



    public function passwordForgot($param)
    {
        $return[$this->status] = false;
        $return[$this->message] = 'Oops, something went wrong...';
        $return[$this->code] = 201;
        $return[$this->data] = [];

        if($param['email'] != '' && !empty($param['email']))
        {

            $added_at = date("Y-m-d H:i:s");
            $timestamp = date("YmdHis");

            $exist                                  = $this->checkEmailAvailable($param);

            if(!$exist[$this->status])
            {
                $return[$this->code]                = $exist[$this->code];
                $return[$this->status]              = $exist[$this->status];
                $return[$this->message]             = $exist[$this->message];
                $return[$this->data]                = $exist[$this->data];

                return $return;
            }


            $mail_data = array(
                'link' => url("change-forgot-password/" . base64_encode($exist[$this->data]['email'])),
                'to_email' => $exist[$this->data]['email'],
                'type' => 'ForgotPassword',
                'name' => $exist[$this->data]['name'],
                'sub_type' => 'Forgot Password',
                'body' => "Hello ". $exist[$this->data]['name']." ,\nClick the Url to reset the password.". url("change-forgot-password/" . base64_encode($exist[$this->data]['email'])),
            );


            $isEmailSent = $this->emailService->sendEmail($mail_data);

            if($isEmailSent)
            {
                $return[$this->status] = true;
                $return[$this->message] = 'Successfully email sent...';
                $return[$this->code] = 200;
                $return[$this->data] = [];
            }
            else
            {
                $return[$this->status] = false;
                $return[$this->message] = 'Oops, problem while sending email...';
                $return[$this->code] = 201;
                $return[$this->data] = [];
            }
        }

        return $return;
    }




    public function updateForgotPass($param)
    {
        $password =  Hash::make($param['new_password']);
        \DB::beginTransaction();
        $updatePass = User::where('email',$param['email'])
                    ->take(1)
                    ->update(['password' => $password]);
        
        if($updatePass)
        {
            $return[$this->status]          = true;
            $return[$this->message]         = 'Successfully password updated...';
            $return[$this->code]            = 200;
            $return[$this->data]            = [];
            
        }
        else
        {
            $return[$this->status]          = false;
            $return[$this->message]         = 'Oops, some problem occure, Please try again...';
            $return[$this->code]            = 201;
            $return[$this->data]            = [];
        }
        \DB::commit();
        return $return;
    }




}
