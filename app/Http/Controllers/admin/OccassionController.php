<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Occassion;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OccassionController extends Controller
{

    public function index(){

    	$profile = Auth::guard('admin')->user();

    	$occassion = Occassion::all();   

    	return view('admin.occassion.list',compact('profile','occassion'));
    }



    public function create(){
	   
      return view('admin.occassion.create'); 
    }



public function occassionUpdate(Request $request,$id)
  {
        $user=Package::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Occassion  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        //return redirect()->index();
        return redirect()->route('admin-package');

    }


    public function store(Request $request)
    {
       // $profile = Auth::guard('admin')->user();
        $occassion = new Occassion;
        $occassion->occassion_name = $request->input('occassion_name');
        $occassion->save();
       return redirect()->back()->with('success','Occassion Added Successfully');
    }


   public function edit($id)
   {     
        $package=Package::findOrFail($id);
         return view('admin.occassion.edit',compact('package') );
   }



    public function destroy($id){

    	$occassion = Occassion::find($id);

    	$package->delete();

   		request()->session()->flash('success','Occassion deleted successfully');

    	return redirect()->back();
    }
}
