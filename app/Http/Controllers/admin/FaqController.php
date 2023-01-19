<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class faqController extends Controller
{

    public function index(){

    	//$profile = Auth::guard('admin')->user();

    	$faq = Faq::all();   

    	return view('admin.faq.list',compact('faq'));
    }



    public function create(){

	    $profile = Auth::guard('admin')->user();

      return view('admin.faq.create',compact('profile')); 
    }



public function Update(Request $request,$id)
  {
        $faq=Faq::findOrFail($id);
       $faq->title = $request->input('title');
        $faq->description        = $request->input('description');
        $faq->status    = $request->input('status');
      
      $status = $faq->save();
        if($status){
            request()->session()->flash('success','Faq  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        //return redirect()->index();
        return redirect()->route('admin-list-faq');

    }


    public function store(Request $request)
    {
        //$profile = Auth::guard('admin')->user();
        $faq = new Faq;
        $faq->title = $request->input('title');
        $faq->description        = $request->input('description');
        $faq->status    = $request->input('status');
      
        $faq->save();
    
          request()->session()->flash('success','FAQ added successfully');
          return redirect()->route('admin-list-faq');
    }


   public function edit($id)
   {     
        $faq=Faq::findOrFail($id);
         return view('admin.faq.edit',compact('faq') );
   }



    public function destroy($id){

    	$faq = Faq::find($id);

    	$faq->delete();

   		request()->session()->flash('success','Faq deleted successfully');

    	return redirect()->back();
    }
}
