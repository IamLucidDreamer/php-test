<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailDemo;
use Symfony\Component\HttpFoundation\Response;

class MailController extends Controller {
    
    public function sendEmail() {
        
        $email = 'agst.vinay@gmail.com';
        $mailData = [
            'title' => 'Account OTP Verification',
            'url' => 'https://www.alexa.com'
        ];
       
      $mail = Mail::to($email)->send(new EmailDemo($mailData));
   
    }
}