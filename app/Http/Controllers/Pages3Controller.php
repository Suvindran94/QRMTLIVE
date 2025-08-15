<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Page;
use DB;
class Pages3Controller extends Controller
{
    public function save3(Request $request){     
       
      if ($request->input('submit') != null ){
        // Update record
        
        if($request->input('qrcode') !=null ){
          $qrcode = $request->input('qrcode');
          $status = $request->input('status');
          $dt_qacheck = $request->input('dt_qacheck');
          $qacheck_by = $request->input('qacheck_by');
			
			$qrmasterinfo = DB::table('qrmaster')->where('qrcode','=', $qrcode)
			->join('moresolist', function($join)
				   {
					   $join->on('qrmaster.sonum','=','moresolist.sonum')
						   ->On('qrmaster.stockcode','=','moresolist.stockcode');
				   })->first();
			
          $null = DB::select('select dt_qacheck from qrmaster where qrcode = ?',[$qrcode]);
          ['null'=>$null];
          $null2 = DB::select('select dt_spvscanrev from qrmaster where qrcode = ?',[$qrcode]);
          ['null2'=>$null2];
          foreach ($null2 as $nulls2)
          if($nulls2->dt_spvscanrev !== null){
            foreach ($null as $nulls)
            if($nulls->dt_qacheck === null){
               $data = array('qrcode'=>$qrcode,"status"=>$status,"dt_qacheck"=>$dt_qacheck,"qacheck_by"=>$qacheck_by);
               // Update
               Page::updateData($qrcode, $data);
              Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

            }else{
             Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

            }
          }else{
            Session::flash('message3','Supervisor Need to Scan First.');
          }
         
        }
      }
      return redirect()->back();
      
    }

    public function retrieve(Request $request)
    {
      $sonum = $request->input('sonum');
      $data = DB::table('qrmaster')
      ->orderByRaw('LENGTH(stockcode)', 'ASC')->orderBy('stockcode', 'ASC')
      ->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')
      ->where('sonum','=', $sonum)->where('dt_spvscanrev','!=', NULL)->where('dt_qacheck','=', NULL) ->where('location',auth()->user()->location)->get();
   
        return view('BS.scanqa', compact('data'));
    }

 
}


