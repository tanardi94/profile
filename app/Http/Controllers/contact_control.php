<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class contact_control extends Controller
{
    public function send_mail()
    {
      $nama = input::get("name");
      $email = input::get("email");
      $pesan = input::get("message");
      $msg = 'Reply to: '.$email.'<br>Pesan: '.$pesan;
      // $data = ['nama'=>$nama,'email'=>$email,'pesan'=>$pesan];
      Mail::send('message.pesan', ['msg' => $msg], function ($message)
        {
          $nama = input::get("name");
          $email = input::get("email");
          $subject = input::get("subject");
          // $pesan = input::get("pesan");
          // $msg = 'Nama: '.$nama.'<br>Email: '.$email.'<br>Pesan: '.$pesan;
          $message->from($email,$nama);
          $message->to('tan.ardi94@gmail.com')->subject($subject);
        });
      return Redirect::to('/')->with('success',true)->with('message','Thankyou '.$nama.' for contacting me<br>I will reply asap !');
    }
}
