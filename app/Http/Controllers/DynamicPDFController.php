<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use PDF;
use Auth;
use Carbon\Carbon;
class DynamicPDFController extends Controller
{
    function index()
    {
     $customer_data = $this->get_customer_data();
     return view('dynamic_pdf')->with('customer_data', $customer_data);
    }

    function get_customer_data($stockcode, $sonum, $var, $var2, $total, $quantity4)
    {
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
			 $prints = DB::table('qrmaster')->select(['stockcode','seq','sonum','asgnto','qrcode','pbag','dt_printseal','soTotalSeq'])
             ->where('stockcode','=', $stockcode)->where('sonum','=', $sonum)->where('asgnto','=', $name)->orderBy('dt_printseal','DESC')->limit($var2)->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')->get();
			
            
             $prints2 = DB::table('moresolist')
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
            // ->where('uom2', '!=', 'PALLET')
             ->get();


             $pallet = DB::table('moresolist')
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
             //->where('uom2', '!=', 'PALLET')
             ->first();
			
			//return dd($pallet);
			
     $prints3 = DB::table('qrmastersmb')
           
				->orderBy('dt_printseal', 'desc')
				 ->orderBy('number', 'desc')
				 
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
             ->where('asgnto','=', $name)
				 ->where('printseal_by', '!=', NULL)
				 ->where('dt_opscancomplete', '=', NULL)
      			->where('dt_printseal',  '!=', NULL)
				
				 ->take($total)
             ->get();
        }
          return view('BS.printtest',['prints'=>$prints, 'prints2'=>$prints2, 'prints3'=>$prints3,'pallet'=>$pallet]);
    }

    public function pdfview(Request $request)
    {
     $sonum = $request->input('sonum');
     $stockcode = $request->input('stockcode');
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
            
             $prints = DB::table('qrmaster')
             ->orderByRaw('LENGTH(seq)', 'ASC')
             ->orderBy('seq', 'ASC')
             ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag'])
             ->where('stockcode','=', $stockcode)->where('sonum','=', $sonum)
             ->where('asgnto','=', $name)
             ->paginate(10);
             $prints2 = DB::table('moresolist')->where('sonum','=', $sonum)->where('stockcode','=', $stockcode)->get();
        }
    
     return view('BS.printtestview',['prints'=>$prints, 'prints2'=>$prints2]);
    }
    function pdf(Request $request)
    {
     $stockcode = $request->input('stockcode');
     $quantity1 = $request->input('quantity1');
     $quantity2 = $request->input('quantity2');
     $quantity4 = ($quantity1 * 5) - 5;
     $var = $quantity1 - 1;
     $var3 = $quantity2 - $quantity1;
     $var2 = $quantity2 - $var;
     $var4 = $var3 +1;
     $sonum = $request->input('sonum');
      $status = $request->input('status');
      $status2 = $request->input('status2');
      $asgnto = $request->input('asgnto');
      $printseal_by = $request->input('printseal_by');
      $dt_printseal = Carbon::now();
      $ttlpsmb = $request->input('ttlpsmb');
		
		
     $prints4 = DB::table('qrmastersmb')
           
				->orderBy('number', 'desc')
             	->where('stockcode','=', $stockcode)
             	->where('sonum','=', $sonum)
             	->where('asgnto','=', $asgnto)
				->where('printseal_by', '=', NULL)
				->where('dt_opscancomplete', '=', NULL)
      
				
             ->count();
	  
      $totals = ($ttlpsmb * (($quantity2 - $quantity1) + 1));
	if($prints4 <= $totals){
		$total = $prints4;
	}
		else{
			$total = ($ttlpsmb * (($quantity2 - $quantity1) + 1));
		}
      $totalskip = (($quantity2 - $quantity1) + 1);
      DB::table('qrmaster')->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')->where('stockcode', '=', $stockcode)
      ->where('sonum', '=', $sonum)->where('asgnto', '=', $asgnto)->where('dt_printseal', '=', NULL)
      ->limit($var4, $var3)->update(['printseal_by'=>$printseal_by
      ,'dt_printseal'=>$dt_printseal,'status'=>$status2]);

      $checkpallet = DB::table('moresolist')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=',  $sonum)
      ->first();

      if($checkpallet->uom2 != 'PALLET'){
          DB::table('qrmastersmb')
          ->orderByRaw('LENGTH(number)', 'ASC')
          ->orderBy('number', 'ASC')->where('stockcode', '=', $stockcode)
          ->where('sonum', '=', $sonum)->where('asgnto', '=', $asgnto)->where('dt_printseal', '=', NULL)
          ->limit($total)->update(['printseal_by'=>$printseal_by,'dt_printseal'=>$dt_printseal]);
      }
      
      DB::update('update moresolist set status = ? where stockcode = ?',[$status,$stockcode]);
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
             $prints = DB::select('select * from qrmaster where stockcode = ? AND asgnto= ?',[$stockcode, $name]);
             $prints2 = DB::select('select * from moresolist where stockcode = ?',[$stockcode]);
        }
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_customer_data($stockcode, $sonum, $var, $var2, $total, $quantity4));
     return $pdf->stream();
     return ['prints'=>$prints, 'prints2'=>$prints2];
    }
	
	function smbpdf(Request $request)
    {
     $stockcode = $request->input('stockcode');
     $quantity1 = $request->input('quantity1');
     $quantity2 = $request->input('quantity2');
     $quantity4 = ($quantity1 * 5) - 5;
     $var = $quantity1 - 1;
     $var3 = $quantity2 - $quantity1;
     $var2 = $quantity2 - $var;
     $var4 = $var3 +1;
     $sonum = $request->input('sonum');
      $status = $request->input('status');
      $status2 = $request->input('status2');
      $asgnto = $request->input('asgnto');
      $printseal_by = $request->input('printseal_by');
      $dt_printseal = Carbon::now();
      $ttlpsmb = $request->input('ttlpsmb');
		
		
     $prints4 = DB::table('qrmastersmb')
     
		->orderBy('number', 'desc')
          ->where('stockcode','=', $stockcode)
          ->where('sonum','=', $sonum)
          ->where('asgnto','=', $asgnto)
		->where('printseal_by', '=', NULL)
		->where('dt_opscancomplete', '=', NULL)
           ->count();
	  
     $totals = ($ttlpsmb * (($quantity2 - $quantity1) + 1));
	
	$total = ($ttlpsmb * (($quantity2 - $quantity1) + 1));
		
      $totalskip = (($quantity2 - $quantity1) + 1);
      DB::table('qrmastersmb')
      ->orderByRaw('LENGTH(number)', 'ASC')
      ->orderBy('number', 'ASC')
      ->where('stockcode', '=', $stockcode)
      ->where('sonum', '=', $sonum)->where('asgnto', '=', $asgnto)
      ->where('dt_printseal', '=', NULL)
      ->limit($var4, $var3)
      ->update(['printseal_by'=>$printseal_by,'dt_printseal'=>$dt_printseal]);

      
      
      DB::update('update moresolist set status = ? where stockcode = ?',[$status,$stockcode]);
        if (Auth::check())
        {
             $name = auth()->user()->StaffID;
             $prints = DB::select('select * from qrmastersmb where stockcode = ? AND asgnto= ?',[$stockcode, $name]);
             $prints2 = DB::select('select * from moresolist where stockcode = ?',[$stockcode]);
        }
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_smb_data($stockcode, $sonum, $var, $var2, $total, $quantity4,$var4));
     return $pdf->stream();
     return ['prints'=>$prints, 'prints2'=>$prints2];

    }
	
	function get_smb_data($stockcode, $sonum, $var, $var2, $total, $quantity4,$var4)
    {
         
        if (Auth::check())
        {
          $name = auth()->user()->StaffID;
		$prints = DB::table('qrmastersmb')
          ->select(['stockcode','sonum','number','asgnto','qrcode','dt_printseal'])
          ->where('stockcode','=', $stockcode)
          ->where('sonum','=', $sonum)
          ->where('asgnto','=', $name)
          ->orderBy('dt_printseal','DESC')
          ->orderByRaw('LENGTH(number)', 'ASC')
          ->orderBy('number', 'ASC')->get();
			
            
          $prints2 = DB::table('moresolist')
          ->where('stockcode','=', $stockcode)
          ->where('sonum','=', $sonum)
          ->get();

          $prints3 = DB::table('qrmastersmb')
		->orderBy('dt_printseal', 'desc')
		->orderBy('number', 'desc')	 
          ->where('stockcode','=', $stockcode)
          ->where('sonum','=', $sonum)
          ->where('asgnto','=', $name)
		->where('printseal_by', '!=', NULL)
		->where('dt_opscancomplete', '=', NULL)
      	->where('dt_printseal',  '!=', NULL)
		->take($var4)
          ->get();
        }
          return view('BS.customSmallSticker',['prints'=>$prints, 'prints2'=>$prints2, 'prints3'=>$prints3]);
    }
   
  
}

