<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;
use App\Models\Track;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class TrackController extends Controller
{
    
	public function index(){

		$promo_code = PromoCode::all();
		return view('admin.track_category.list',compact('promo_code') );
	}

	public function create(){
			return view('admin.track_category.create'); 
	}


	public function store(Request $request)
	{
		
		/*print_r($_POST);
		die;*/
		$validated = $request->validate([
	        'track_category' => 'required|unique:track_category',
	        'status' => 'required',
   		 ]);

        $track = new Track;
        $track->track_category = $request->input('track_category');
         $track->status        = $request->input('status');
        $track->save();

       return redirect()->back()->with('success','track Category Added Successfully');
	}

    
    public function edit($id){

		$promo=PromoCode::findOrFail($id);
         return view('admin.promo_code.edit',compact('promo') );
	}

	public function promoCodeUpdate(Request $request,$id){
		 $promo=PromoCode::findOrFail($id);

        $data=$request->all();
        $status=$promo->fill($data)->save();
        if($status){
            request()->session()->flash('success','Promo code  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        //return redirect()->index();
        return redirect()->route('admin-promo-codes');
	}

	public function destroy($id){
		$promo = PromoCode::find($id);

    	$promo->delete();

   		request()->session()->flash('success','Promo Code  deleted successfully');

    	return redirect()->back();
	}

	

}
