<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


     //protected $table = "interests";

   protected $fillable = ['user_id','event_name','event_date','start_time','end_time','entry_fee','location','event_type','description'
    ];

}
