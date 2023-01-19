<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PromoCode;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class InterestAPIController extends Controller
{
   

     public function allInterests(Request $request)
        { 
             echo 'vinay';
        
            /*$interests = Interest::all();

            $response['status'] = true;
            $response['message'] = "All Interests";
            $response['data'] = $interests;
            return response()->json($interests);*/
        }



}
   