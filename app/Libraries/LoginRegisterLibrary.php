<?php

namespace App\Libraries;

use App\Services\LoginRegisterService;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Log;


class LoginRegisterLibrary
{

    public function __construct()
    {
        $this->loginRegSer = new LoginRegisterService();
        $this->commonService = new CommonService();
        $this->status = 'status';
        $this->message = 'message';
        $this->code = 'status_code';
        $this->error = 'error';
        $this->error_code = 'error_code';
        $this->data = 'data';
    }

    
    /**
     * @param []
     * eamil, first_name, last_name, mobile, password, dob
     *
     * @return 
     * 
     */
    
    public function register($param)
    {
        $this->commonService->inputValidators('register', $param);

        $serviceResponse = $this->loginRegSer->register($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        return $return;
    }
    


    /**
     * @param []
     * email_id, password
     *
     * @return 
     * 
     */
    
    public function userLogin($param)
    {
        $this->commonService->inputValidators('userLogin', $param);

        $serviceResponse = $this->loginRegSer->loginUser($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        return $return;
    }


    /**
     * @param []
     * email
     *
     * @return 
     * 
     */
    
    public function forgotPass($param)
    {
        $this->commonService->inputValidators('forgotPass', $param);

        $serviceResponse = $this->loginRegSer->passwordForgot($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        return $return;
    }


    
/**
     * @param []
     * email,password
     *
     * @return 
     * 
     */
    
    public function forgotPassUpdate($param)
    {
        $this->commonService->inputValidators('changeforgotPass', $param);

        $serviceResponse = $this->loginRegSer->updateForgotPass($param);

        if($serviceResponse[$this->status])
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code] = $serviceResponse[$this->code];
            $return[$this->status] = $serviceResponse[$this->status];
            $return[$this->message] = $serviceResponse[$this->message];
            $return[$this->data] = [];
        }
        return $return;
    }


   
    


}
