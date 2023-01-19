<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{
    public function getAllPackage()
    {


        $packages = Package::all();   

       /*  if (($packages)) {
            echo 'not found';
           //  $response['message'] = "sub categories list.";
            return $this->sendError('Package not found.');
           }*/

        $response['status'] = true;
        $response['message'] = "Package list.";
        $response['data'] = $packages;
        return response()->json($packages);
    }


    public function getAllInterest()
    {
        echo 'vinay';
        
      /*  $packages = Package::all();   

      

        $response['status'] = true;
        $response['message'] = "Package list.";
        $response['data'] = $packages;
        return response()->json($packages);*/
    }

}
