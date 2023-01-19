<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;   

class Level extends Model
{
    use HasFactory,Notifiable;
   


  protected $fillable = [
        'level_name','challenge_id','level_description','reward_points'
    ];
}
