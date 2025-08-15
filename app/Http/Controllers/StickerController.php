<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class StickerController extends Controller
{
    

     public function index() {
      
        return view('BS.sticker');
     }
    public function view( Request $request) {
    
      $sonum = $request->input('sonum');
      $stockcode = $request->input('stockcode');
      $prints = DB::table('qrmaster')->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')
      ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag'])
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->paginate(5);
      $prints2 = DB::table('moresolist')->where('stockcode','=', $stockcode) ->where('sonum','=', $sonum)->get();
      return view('BS.sticker',['prints'=>$prints, 'prints2'=>$prints2]);
     }
   
    
}
