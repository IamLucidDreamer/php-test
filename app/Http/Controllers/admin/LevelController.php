<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Level;
use App\Models\Challenge;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LevelController extends Controller
{

    public function index()
    {
        $challenge = Challenge::all();
         $level = DB::table('levels')
                ->join('challenges', 'levels.challenge_id', '=', 'challenges.id')
                 ->get();

    	return view('admin.level.list',compact('challenge','level'));
    }



    public function create()
    {
      $challenge = Challenge::all()->where('status','Active');
	   
      return view('admin.level.create',compact('challenge') ); 
    }


public function store(Request $request)
    {
       
        $level = new Level;
       
        $level->challenge_id = $request->input('challenge_id');
       
        $level->level_name = $request->input('level_name');
       
        $level->level_description = $request->input('level_description');
       
        $level->reward_points = $request->input('reward_points');
       
        $level->save();
       
         request()->session()->flash('success','Level Added Successfully. ');

         return redirect()->route('admin-level-list');
    }

    public function edit($id)
           {     
                $challenge = Challenge::all();
                $level=Level::findOrFail($id);
                 return view('admin.level.edit',compact('level','challenge') );
           }



public function update(Request $request,$id)
  {
        $user=Level::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();
        if($status){
            request()->session()->flash('success','Level  updated successfully. ');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }

        //return redirect()->index();
        return redirect()->route('admin-level-list');

    }


    


   


    public function destroy($id){

    	$level = Level::find($id);

    	$level->delete();

   		request()->session()->flash('success','Level  deleted successfully');

    	return redirect()->back();
    }
}
