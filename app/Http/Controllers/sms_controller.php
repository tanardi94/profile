<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class sms_controller extends Controller
{
    public function send_message() {
           
    	$nama_pemesan = input::get("nama");
    	$alamat = input::get("alamat");
    	$notelp = input::get("notelp");
    	$bh = input::get("bhpesan");
    	$bk = input::get("bkpesan");
    	$bg = input::get("bgpesan");
    	$sb = input::get("sbpesan");
    	$sg = input::get("sgpesan");
    	$ug = input::get("ugpesan");
    	$th = input::get("thpesan");
    	$bu = input::get("bupesan");
    	$jumlah = ($bh + $bk + $bg +$sb + $sg + $ug + $th + $bu);
    	$harga = $jumlah * 2500;
    	if ($bh == "")
        $bh = 0;
    	if ($bk == "")
        $bk = 0;
    	if ($bg == "")
        $bg = 0;
    	if ($bu == "")
        $bu = 0;
    	if ($sb == "")
        $sb = 0;
    	if ($sg == "")
        $sg = 0;
    	if ($th == "")
        $th = 0;
    	if ($ug == "")
        $ug = 0;
        $pesan = "pesanan untuk ".$nama_pemesan." ke alamat ".$alamat." dengan no telp ".$notelp.
                 "\npesanan berupa : \nbakwan halus : ".$bh."\nbakwan kasar : ".$bk."\nbakwan goreng : ".$bg.
                 "\nbakwan udang : ".$bu."\nsiomay basah : ".$sb."\nsiomay goreng : ".$sg."\ntahu ikan : ".$th.
                 "\nbakwan udang goreng : ".$ug."\nmaka total pembayaran adalah : Rp".$harga;

    	if($jumlah<40) {
    		return Redirect::to('/')->with('fail','Pengiriman hanya berlaku untuk pemesanan minimal 40 biji');
    	}
    	else {
            Mail::send('emails.order', ['pesan' => $pesan], function ($message) 
            {
                $message->to('w.basuki1962@gmail.com', 'Waluyo Basuki')->subject('Order Pengiriman'); 
            });

    	   return Redirect::to('/')->with('success','Terima Kasih, pemesanan anda sedang diproses.');
    	}
        /*require '/../class-Clockwork.php';

        $apikey = " 4d4e37f197a1c7ea71255505684f567b8f648be0"
                $clock = new Clockwork( $apikey );

                // Setup and send a message
                $message = array( 'to' => '+62895355281385', 'message' => 'This is a test!' );
                $result = $clock->send( $message );

            /*try
            {
                

                // Check if the send was successful
            /*    if($result['success']) {
                    echo 'Message sent - ID: ' . $result['id'];
                } else {
                    echo 'Message failed - Error: ' . $result['error_message'];
                }
            }
            catch (ClockworkException $e)
            {
                echo 'Exception sending SMS: ' . $e->getMessage();
            } */
    }
}
