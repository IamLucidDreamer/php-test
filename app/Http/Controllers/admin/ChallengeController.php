<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Challenge;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class ChallengeController extends Controller
{

    public function index(){

    	$challenge = Challenge::all();   

    	return view('admin.challenge.list',compact('challenge'));
    }



    public function create(){
	   
      return view('admin.challenge.create'); 
    }

     public function store(Request $request)
        {
           $validated = $request->validate([
            'challenge_name' => 'required|unique:challenges,challenge_name',
            'status' => 'required',
         ]);

            $challenge = new Challenge;
            $challenge->challenge_name = $request->input('challenge_name');
             $challenge->expiry_date = $request->input('expiry_date');
            
            $challenge->status = $request->input('status');
            $challenge->save();
           return redirect()->back()->with('success','Challenge Added Successfully');
        }


        public function edit($id)
           {     
                $challenge=Challenge::findOrFail($id);
                 return view('admin.challenge.edit',compact('challenge') );
           }




public function update(Request $request,$id)
  {
        $challenge = Challenge::findOrFail($id);
        $validated = $request->validate([
            'challenge_name' => 'required|unique:challenges,challenge_name',
            'status' => 'required',
            'expiry_date'  => 'required',
         ]);
        
        $data=$request->all();
        
        $status=$challenge->fill($data)->save();
        
        if($status){
            request()->session()->flash('success','Challenge  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        //return redirect()->index();
        return redirect()->route('admin-challenge-list');

    }





   


    public function destroy($id){

    	$challenge = Challenge::find($id);

    	$challenge->delete();

   		request()->session()->flash('success','Challenge deleted successfully');

     return redirect()->route('admin-challenge-list');
    }
}
