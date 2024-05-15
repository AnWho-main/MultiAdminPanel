<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;


use Log;


class CommonLibrary
{

    public function __construct()
    {
        $this->commonSer                        = new CommonService();        
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->error                            = 'error';
        $this->error_code                       = 'error_code';
        $this->data                             = 'data';
        $this->total                            = 'total_count';
    }

    
    
    /*

        User's Profile

    */

    public function userProfileGet($param)
    {
        $this->commonSer->inputValidators('userProfileGet', $param);
        $serviceResponse                        = $this->commonSer->getUserProfile($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }



    public function passwordChange($param)
    {
        $this->commonSer->inputValidators('passwordChange', $param);
        $serviceResponse                        = $this->commonSer->changeUserPassword($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }





    public function allSourceGet()
    {
        $serviceResponse                        = $this->commonSer->fetchAllSource();
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }

    


    public function sourceGetById($param)
    {
        $this->commonSer->inputValidators('sourceGetById', $param);
        $serviceResponse                        = $this->commonSer->fetchSourceById($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }




    public function allDenoGetByUserId($param)
    {
        $this->commonSer->inputValidators('allDenoGetByUserId', $param);
        $serviceResponse                        = $this->commonSer->fetchAllDenoByUserId($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }


    public function denoCreate($param)
    {
        $this->commonSer->inputValidators('denoCreate', $param);
        $serviceResponse                        = $this->commonSer->storeDeno($param);
        
        if($serviceResponse[$this->status])
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = $serviceResponse[$this->data];
        }
        else
        {
            $return[$this->code]                = $serviceResponse[$this->code];
            $return[$this->status]              = $serviceResponse[$this->status];
            $return[$this->message]             = $serviceResponse[$this->message];
            $return[$this->data]                = [];
        }
        return $return;
    }



}
