<?php

namespace App\Services;

use App\Models\Country;
use App\Models\State;
use App\Models\Deno;
use App\Models\Source;
use App\Models\Mode;
use App\Models\PartyDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Exception;
use App\Http\Controllers\Api\V1\BaseController;
use Log;



class DashboardService
{

    public function __construct()
    {
        $this->status                   = 'status';
        $this->message                  = 'message';
        $this->code                     = 'status_code';
        $this->data                     = 'data';
        $this->total                    = 'total_count';
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
    
    
    public function fetchDashboardData($param)
    {
        $response = [
            $this->status                  => false,
            $this->message                 => 'Data not found...',
            $this->code                    => 404,
            $this->data                    => [],
        ];

        $deno_count                         = Deno::where('status', 1)
                                                        ->where('is_live', 1)
                                                        ->where('user_id', $param['user_id'])->count();
        $party_count                        = PartyDetail::where('status', 1)
                                                                ->where('is_live', 1)
                                                                ->where('user_id', $param['user_id'])->count();

        $response[$this->status]            = true;
        $response[$this->message]           = 'Successfully data get...';
        $response[$this->code]              = 200;
        $response[$this->data]['deno']      = $deno_count;
        $response[$this->data]['party']     = $party_count;
        $response[$this->data]['total_payment_received']     = 10000;
        $response[$this->data]['total_this_month_payment_received']     = 10001;
        
        return $response;
    }
    
    
    
    


}
