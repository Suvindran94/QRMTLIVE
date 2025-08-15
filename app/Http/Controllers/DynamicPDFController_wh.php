<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;
class DynamicPDFController_wh extends Controller
{
    function index()
    {
     $customer_data = $this->get_customer_data();
     return view('sticker_pdf')->with('customer_data', $customer_data);
    }

    function get_customer_data($stockcode, $sonum)
    {
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
             $prints = DB::table('qrmaster_wh')->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')->select(['stockcode','seq','sonum','asgnto','qrcode','pbag','dt_printseal'])
             ->where('stockcode','=', $stockcode)->where('sonum','=', $sonum)->where('asgnto','=', $name)->get();
             $prints2 = DB::table('moresolist')->where('stockcode','=', $stockcode)->where('sonum','=', $sonum)->get();
            
        }
          return view('BS.printtest_wh',['prints'=>$prints, 'prints2'=>$prints2]);
    }

    public function pdfview(Request $request)
    {
     $sonum = $request->input('sonum');
     $stockcode = $request->input('stockcode');
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
            
             $prints = DB::table('qrmaster_wh')
             ->orderByRaw('LENGTH(seq)', 'ASC')
             ->orderBy('seq', 'ASC')
             ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag'])
             ->where('stockcode','=', $stockcode)->where('sonum','=', $sonum)
             ->where('asgnto','=', $name)
             ->paginate(10);
             $prints2 = DB::table('moresolist_wh')->where('sonum','=', $sonum)->where('stockcode','=', $stockcode)->get();
        }
    
     return view('BS.printtestview_wh',['prints'=>$prints, 'prints2'=>$prints2]);
    }

    public function pdf(Request $request)
    {
     $stockcode = $request->input('stockcode');
    
     $sonum = $request->input('sonum');
      $status = $request->input('status');
      $status2 = $request->input('status2');
      $asgnto = $request->input('asgnto');
      $printseal_by = $request->input('printseal_by');
      $dt_printseal = $request->input('dt_printseal');
     
      DB::table('qrmaster_wh')->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')->where('stockcode', '=', $stockcode)
      ->where('sonum', '=', $sonum)->where('asgnto', '=', $asgnto)->where('dt_printseal', '=', NULL)
      ->update(['printseal_by'=>$printseal_by
      ,'dt_printseal'=>$dt_printseal,'status'=>$status2]);
      
      DB::update('update moresolist_wh set status = ? where stockcode = ?',[$status,$stockcode]);
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
             $prints = DB::select('select * from qrmaster_wh where stockcode = ? AND asgnto= ?',[$stockcode, $name]);
             $prints2 = DB::select('select * from moresolist_wh where stockcode = ?',[$stockcode]);
        }
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_customer_data($stockcode, $sonum));
     return $pdf->stream();
     return ['prints'=>$prints, 'prints2'=>$prints2];
    }
   
  
}

