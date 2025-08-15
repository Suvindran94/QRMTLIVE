<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use App\Page;
use DB;
class Pages2Controller extends Controller{
  public function save(Request $request){     
    if ($request->input('submit') != null ){
      // Update record
      if($request->input('qrcode') !=null ){
        $qrcode = $request->input('qrcode');
        $layer = $request->input('layer');
        $pallet = $request->input('pallet');
        $save = $request->input('save');
        $status = $request->input('status');
        $dt_spvscanrev = $request->input('dt_spvscanrev');
        $spvscanrev_by = $request->input('spvscanrev_by');
		  
		$qrmasterinfo = DB::table('qrmaster')->where('qrcode','=', $qrcode)
			->join('moresolist', function($join)
				   {
					   $join->on('qrmaster.sonum','=','moresolist.sonum')
						   ->On('qrmaster.stockcode','=','moresolist.stockcode');
				   })->first();
			
		  
        $null = DB::select('select dt_spvscanrev from qrmaster where qrcode = ?',[$qrcode]);
        ['null'=>$null];
        $null2 = DB::select('select dt_opscancomplete from qrmaster where qrcode = ?',[$qrcode]);
        ['null2'=>$null2];
        foreach ($null2 as $nulls2)
        if($nulls2->dt_opscancomplete !== null){
          foreach ($null as $nulls)
          if($nulls->dt_spvscanrev == null){
             $data = array('qrcode'=>$qrcode,"pallet"=>$pallet,"status"=>$status,"dt_spvscanrev"=>$dt_spvscanrev,"spvscanrev_by"=>$spvscanrev_by,"layer"=>$layer);
			     Page::updateData($qrcode, $data);
			  
             // Update
			 
            $SvScanQty = DB::table('qrmaster')
            ->where('stockcode',$qrmasterinfo->stockcode)
            ->where('sonum',$qrmasterinfo->sonum)
            ->where('dt_spvscanrev','!=',null)
            ->sum('pbag');


            if($qrmasterinfo->quantity == $SvScanQty)
            {
              
              $WOHdr = DB::connection('mysqlPM')->table('PRD_WO_HDR')
              ->where('WO_STK_FG_NO',$qrmasterinfo->stockcode)
              ->where('WO_SOUCE_ID',$qrmasterinfo->sonum)
              ->first();

              

              $StartorNot = DB::connection('mysqlPM')->table('PRD_TRX')
              ->where('TRX_SOURCE_ID',$WOHdr->WO_ID)
              ->where(function ($query) {
                $query->where('TRX_TYPE', 'SQ')
                      ->orWhere('TRX_TYPE', 'EP');
              })->count();
            
              if($StartorNot>1){

              }else{
                $WOHdrUpd =  DB::connection('mysqlPM')->table('PRD_WO_HDR')
                ->where('WO_STK_FG_NO',$qrmasterinfo->stockcode)
                ->where('WO_SOUCE_ID',$qrmasterinfo->sonum)
                ->where('WO_STATUS', 'I')
                ->update([
                  'WO_STATUS' =>  'C',
                  'WO_UPD_DATE' => $dt_spvscanrev,
                  'WO_UPD_BY' => auth()->user()->id,
                ]);

                DB::connection('mysqlPM')->table('PRD_WO_DT')->where('WO_ID',$WOHdr->WO_ID)
                ->where('WO_D_STATUS' , 'A')
                ->update([
                  'WO_D_STATUS' =>  'C',
                  'WO_UPD_DATE' => $dt_spvscanrev,
                  'WO_UPD_BY' => auth()->user()->id,
                ]);
				  
				DB::connection('mysqlPM')->table('PS_BOOK_DT')
					 ->where('PS_BOOK_STK_FG',$qrmasterinfo->stockcode)
                	 ->where('PS_BOOK_SONUM',$qrmasterinfo->sonum)
					->where('PS_BOOK_STATUS' , '!=', 'D')
	           ->update([
                  'PS_BOOK_STATUS' =>  'C',
                  'PS_BOOK_UPD_DATE' => $dt_spvscanrev,
                  'PS_BOOK_UPD_BY' => auth()->user()->id,
                ]);

              }    
            }

             


          
			  
             Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
          }else{
            Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
			   
          }
        }else{
          Session::flash('message3','Operator need to scan first');
        }
      }
    }
    return redirect()->back();
  }
	
	
	
}


