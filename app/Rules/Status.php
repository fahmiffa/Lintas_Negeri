<?php

namespace App\Rules;

use App\Models\Participant;
use App\Models\Log;
use Auth;

class Status 
{
   public static function grade($head,$state,$status)
   {    
        $par = new Participant;
        $par->users_id = $head->participant; 
        $par->head = $head->id;
        $par->state = $state; 
        $par->status = $status;           
        $par->save();
   }

   public static function state($id, $state)
   {   
        $payment = [1,6,12];

        if($id == 0)
        {
            return 'Baru';
        }

        if(in_array($id,$payment))
        {
            return 'Mohon menunggu verifikasi pembayaran '.$state;
        }

        if($id == 2)
        {
            return 'Silahkan isi identitas data';
        }

        if($id == 3)
        {
            return 'Ujian Test Online';
        }    

        if($id == 5)
        {
            return 'Mohon menunggu verifikasi kelas';
        }    

        if($id == 7)
        {
            return 'Silahkan Pilih Pekerjaan';
        }    

        if($id == 8)
        {
            return 'Mohon menunggu verifikasi cv & Video';
        }   
        
        if($id == 9)
        {
            return 'Mohon menunggu Jadwal Interview';
        }   

        if($id == 10)
        {
            return 'Jadwal Interview';
        }   

        if($id == 11)
        {
            return $state;
        }   

        if($id == 13)
        {
            return 'Silahkan melanjutkan proses tanda tangan kontrak';
        }   

   }

   public static function log($logs)
   {
        $log            = New Log;
        $log->users      = Auth::user()->id;
        $log->activity  = $logs;
        $log->save();
   }

  public static function gambar($val)
  {
        $imagePath = public_path($val); // Replace with your image path
        $imageData = Image::make($imagePath)->encode('data-url')->encoded;
        return $imageData;
  }
}
