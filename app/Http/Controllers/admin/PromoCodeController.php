<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PromoCode;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class PromoCodeController extends Controller
{
    
	public function index(){

		$promo_code = PromoCode::all();
		return view('admin.promo_code.list',compact('promo_code') );
	}

	public function create(){
			return view('admin.promo_code.create'); 
	}


	public function store(Request $request)
	{
		
		$validated = $request->validate([
	        'promo_name' => 'required|unique:promo_codes',
	        'promo_type' => 'required',
	        'price' => 'required',
	        'status' => 'required',
   		 ]);

        $promo = new PromoCode;
        $promo->promo_name = $request->input('promo_name');
         $promo->promo_type        = $request->input('promo_type');
        $promo->price        = $request->input('price');
        $promo->status        = $request->input('status');
        $promo->start_date        = $request->input('start_date');
        $promo->expiry_date        = $request->input('expiry_date');
        $promo->save();

       return redirect()->back()->with('success','Promo Code Added Successfully');
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
