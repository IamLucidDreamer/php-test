<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interest;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class InterestController extends Controller
{
    
	public function index(){

		$interest = Interest::all();
		return view('admin.interest.list',compact('interest') );
	}

	public function create(){
			return view('admin.interest.create'); 
	}


	public function store(Request $request)
	{
         

		$validated = $request->validate([
	        'name' => 'required|unique:interests,name',
	        'status' => 'required',
   		 ]);

        $interest = new Interest;
        $interest->name = $request->input('name');
        $interest->status = $request->input('status');

        $interest->save();

       return redirect()->route('admin-interest-list')->with('success','Interest Added Successfully');
	}

    
    public function edit($id){

		$interest=Interest::findOrFail($id);
		
         return view('admin.interest.edit',compact('interest') );
	}

	

	public function update(Request $request,$id){

		$interest =  Interest::findOrFail($id);
         $interest->name = $request->input('name');
        $interest->status = $request->input('status');

        $status = $interest->save();

      //  $status= $promo->fill($data)->save();

        if($status){
            request()->session()->flash('success','Interest name  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        return redirect()->route('admin-interest-list');
	}





	public function destroy($id){

		$interest = Interest::find($id);

    	$interest->delete();

   		request()->session()->flash('success','Interest name  deleted successfully');

    	return redirect()->back();
	}

	

}
