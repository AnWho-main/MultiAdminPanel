<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CommonService;
use App\Services\DashboardService;
use Log;


class DashboardLibrary
{

    public function __construct()
    {
        
        $this->commonSer                    = new CommonService();
        $this->dashboardSer                 = new DashboardService();
        $this->status                       = 'status';
        $this->message                      = 'message';
        $this->code                         = 'status_code';
        $this->error                        = 'error';
        $this->error_code                   = 'error_code';
        $this->data                         = 'data';
    }

    
    
    
   /**
        * @param[]
        * categoryId
        *
        * @return 
        * 200
        * 
        * @error
        * 404/201
        * 
    **/
    
    public function dasboardGet($param)
    {
        $this->commonSer->inputValidators('dasboardGet', $param);
        $serviceResponse = $this->dashboardSer->fetchDashboardData($param);

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
