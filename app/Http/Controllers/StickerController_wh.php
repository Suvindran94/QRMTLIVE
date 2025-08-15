<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class StickerController_wh extends Controller
{
    

     public function index() {
      
        return view('BS.sticker_wh');
     }
     
    public function view( Request $request) {
    
      $sonum = $request->input('sonum');
      $stockcode = $request->input('stockcode');
      $prints = DB::table('qrmaster_wh')->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')
      ->select(['stockcode','seq','sonum','asgnto',DB::raw('DATE_FORMAT(dt_whackwrev, "%d-%b-%Y") as dt_whackwrev'),'qrcode','pbag'])
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->paginate(5);
      $prints2 = DB::table('moresolist_wh')->where('stockcode','=', $stockcode) ->where('sonum','=', $sonum)->get();
      return view('BS.sticker_wh',['prints'=>$prints, 'prints2'=>$prints2]);
     }
   
    
}
