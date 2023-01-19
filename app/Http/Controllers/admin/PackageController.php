<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Package;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PackageController extends Controller
{

    public function index(){

    	$profile = Auth::guard('admin')->user();

    	$packages = Package::all();   

    	return view('admin.package.list',compact('profile','packages'));
    }



    public function create(){

	    $profile = Auth::guard('admin')->user();

      return view('admin.package.create',compact('profile')); 
    }



public function packageUpdate(Request $request,$id)
  {
        $user=Package::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Package  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        //return redirect()->index();
        return redirect()->route('admin-package');

    }


    public function store(Request $request)
    {
        $profile = Auth::guard('admin')->user();
        $package = new Package;
        $package->package_name = $request->input('package_name');
        $package->price        = $request->input('price');
        $package->features    = $request->input('features');
      
        $package->save();
       return redirect()->back()->with('success','Package Added Successfully');
    }


   public function edit($id)
   {     
        $package=Package::findOrFail($id);
         return view('admin.package.edit',compact('package') );
   }



    public function destroy($id){

    	$package = Package::find($id);

    	$package->delete();

   		request()->session()->flash('success','Package deleted successfully');

    	return redirect()->back();
    }
}
