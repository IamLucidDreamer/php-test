<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;   

class Faq extends Model
{
    use HasFactory,Notifiable;
   


  protected $fillable = [
        'package_name','price','feature','features'
    ];
}
