<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class UserController extends Controller
{
    
    public function index(){
    	$profile = Auth::guard('admin')->user();
     	$users = User::where('role','subscriber')
     			->orderBy('id','DESC')
     			->get();
     		
     	return view('admin.user.all_user',compact('users','profile')); 
    }

     public function destroy($id)
	    {
	        
	        $user = User::find($id);
	        $user->delete();
	        // redirect
	         request()->session()->flash('success','User deleted successfully. ');
	        return redirect()->back();
	    }


}


