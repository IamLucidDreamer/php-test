<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PromoCode;
use App\Models\Interest;
use App\Models\Challenge;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PromoCodeController extends Controller
{
    public function getAllPromoCode()
    {
        $promo_code = PromoCode::all();

        $response['status'] = true;
        $response['message'] = "Promo Code List.";
        $response['data'] = $promo_code;
        return response()->json($promo_code);
    }


    public function interest(){
        $interest = Interest::all()->where('status','Active');
        $response['status'] = true;
        $response['message'] = "Promo Code List.";
        $response['data'] = $interest;
        return response()->json($interest);
    }

     public function challenge()
     {

        $challenge = Challenge::all()->where('status','Active');
        $response['status'] = true;
        $response['message'] = "Promo Code List.";
        $response['data'] = $challenge;
        return response()->json($challenge);
    }


    



}
