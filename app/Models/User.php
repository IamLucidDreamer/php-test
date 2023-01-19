<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array pinterest
     */
    protected $fillable = [
        'name', 'email', 'password','contact','image','facebook','twitter','linkedin','instagram','pinterest'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function generateCode()
    {
        $code = rand(1000, 9999);
        UserCode::updateOrCreate(
            [ 'user_id' => auth()->user()->id ],
            [ 'code' => $code ]
        );
        try {
            $details = [
                'title' => 'Mail from Albumer',
                'code' => $code
            ];

         //Vinay's Email Setup >>> 
          Mail::to($email)->send(new EmailDemo($mailData));
        // Mail::to(auth()->user()->email)->send(new SendCodeMail($details));

        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }

  /*  public function generateTwoFactorCode()
        {
            $this->timestamps = false;
            $this->two_factor_code = rand(100000, 999999);
            $this->two_factor_expires_at = now()->addMinutes(10);
            $this->save();
        }*/




}
