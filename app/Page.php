<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Page extends Model {
 

  public static function insertData($data){
    $value=DB::table('scan')->where('qrcode', $data['qrcode'])->get();
  
    if($value->count() == 0){
      DB::table('scan')->insert($data);
      return 1;
     }else{
       return 0;
     }
 
  }
  public static function updateDataMf($qrcode,$data){
    DB::table('scans')
      ->where('qrcode', $qrcode)
      ->update($data);
  }
  public static function updateData($qrcode,$data){
    DB::table('qrmaster')
      ->where('qrcode', $qrcode)
      ->update($data);
  }
  public static function updateData2($sonum,$data){
    DB::table('scan')
      ->where('sonum', $sonum)
      ->update($data);
  }


  public static function deleteData($id){
    DB::table('users')->where('id', '=', $id)->delete();
  }
 
}
