<?php

namespace App\Http\Controllers;
use DB;
use PDF;
use Auth;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;

class RepController extends Controller
{ 
    function reprint(Request $request)
    {
     $stockcode = $request->input('stockcode');
     $seq = $request->input('seq');
     $sonum = $request->input('sonum');
     $prints = DB::select('select * from qrmaster where seq = ? AND stockcode= ?',[$seq, $stockcode]);
     $prints2 = DB::table('moresolist')->where('sonum','=', $sonum)->where('stockcode','=', $stockcode)->get();
     $prints3 = DB::table('qrmaster')->where('sonum','=', $sonum)->where('stockcode','=', $stockcode)->get();
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_customer_data($stockcode,$seq,$sonum));
     return $pdf->stream();
     return ['prints'=>$prints, 'prints2'=>$prints2, 'prints3'=>$prints3];
    }
    
    function get_customer_data($stockcode,$seq,$sonum)
    {
      $prints = DB::select('select * from qrmaster where seq = ? AND stockcode= ?',[$seq, $stockcode]);
      $prints2 = DB::table('moresolist')->where('sonum','=', $sonum)->where('stockcode','=', $stockcode)->get();
      return view('BS.printtest',['prints'=>$prints, 'prints2'=>$prints2]);
    
    }

    function reprintrange(Request $request)
    {
      $stockcode = $request->input('stockcode');
      $quantity1 = $request->input('quantity1');
      $quantity2 = $request->input('quantity2');
      $var = $quantity1 - 1;
      $var3 = $quantity2 - $quantity1;
      $var2 = $quantity2 - $var;
      $var4 = $var3 +1;
      $sonum = $request->input('sonum');
      $pdf = \App::make('dompdf.wrapper');
		
		$check = DB::table('qrmaster')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum) 
	  ->whereRaw('SUBSTRING_INDEX(seq,"/", 1) >= '.$quantity1)
	  ->whereRaw('SUBSTRING_INDEX(seq,"/", 1) <= '.$quantity2)
	->whereNotNull('dt_printseal')
      ->count();
		
     		if($check == $var4){
    
      $pdf->loadHTML($this->get_range_data($stockcode,$var2,$sonum,$var,$quantity1,$quantity2));
      return $pdf->stream();
      return ['prints'=>$prints, 'prints2'=>$prints2];
			
	}
	else{
		Session::flash('message','Please print sticker first!');
		return redirect()->back();
		 }
    }
	
  function get_range_data($stockcode,$var2,$sonum,$var,$quantity1,$quantity2)
    {

      $name = auth()->user()->StaffID;
     
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = Carbon::now();

      $prints = DB::table('qrmaster')
      ->orderByRaw('LENGTH(seq)', 'ASC')
      ->orderBy('seq', 'ASC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag','dt_printseal','soTotalSeq'])
      ->take($var2)
      ->skip($var)
      ->get();
		
	
 	   $update = DB::table('qrmaster')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum) 
	  ->whereRaw('SUBSTRING_INDEX(seq,"/", 1) >= '.$quantity1)
	  ->whereRaw('SUBSTRING_INDEX(seq,"/", 1) <= '.$quantity2)
      ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag','dt_printseal'])
      ->update(['reprintseal_by'=>$name, 'dt_reprintseal'=>$date]);
		

		
		 
		
		
     foreach ($prints as $print){
	$increment = DB::table('reprint')->where('qrcode','=', $print->qrcode)->get();
			if ($increment->isEmpty()) { 
			$data = array("qrcode"=>$print->qrcode,'type'=>'Standard Sticker','seq'=>$print->seq,'reprintseal_by'=>$name, 'dt_reprintseal'=>$date,'ttlreprint'=>'1');
    DB::table('reprint')->insert($data);
			}else{
			foreach ($increment as $increment)
			$ttl = $increment->ttlreprint + 1;
			
			$data = array("qrcode"=>$print->qrcode,'type'=>'Standard Sticker','seq'=>$print->seq,'reprintseal_by'=>$name, 'dt_reprintseal'=>$date,'ttlreprint'=>$ttl);
    DB::table('reprint')->insert($data);
			}
	
		}
      $prints2 = DB::table('moresolist')->where('sonum','=', $sonum)->where('stockcode','=', $stockcode)->get();
      $prints3 = DB::table('qrmastersmb')
      ->orderByRaw('LENGTH(number)', 'ASC')
      ->orderBy('number', 'ASC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->get();
      return view('BS.printteststd',['prints'=>$prints, 'prints2'=>$prints2, 'prints3'=>$prints3]);
    }
	 function reprintrangesmb(Request $request)
    {
      $stockcode = $request->input('stockcode');
      $quantity1 = $request->input('quantity1');
      $quantity2 = $request->input('quantity2');
      $var = $quantity1 - 1;
      $var3 = $quantity2 - $quantity1;
      $var2 = $quantity2 - $var;
      $var4 = $var3 +1;
      $sonum = $request->input('sonum');
      $pdf = \App::make('dompdf.wrapper');
		 
		$check = DB::table('qrmastersmb')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
	  ->where('number', '>=' ,$quantity1)
      ->where('number', '<=' ,$quantity2)
	  ->whereNotNull('dt_printseal')
      ->count();
		 
	if($check == $var4){
      $pdf->loadHTML($this->get_range_data1($stockcode,$var2,$sonum,$var,$quantity1,$quantity2));
      return $pdf->stream();
      return ['prints'=>$prints, 'prints2'=>$prints2];
	}
	else{
		Session::flash('message','Please print sticker first!');
		return redirect()->back();
		 }
    }
    function get_range_data1($stockcode,$var2,$sonum,$var,$quantity1,$quantity2)
    {

      $name = auth()->user()->StaffID;
     
      date_default_timezone_set("Asia/Kuala_Lumpur");
      $date = Carbon::now();

      $prints = DB::table('qrmastersmb')
      ->orderByRaw('LENGTH(number)', 'ASC')
      ->orderBy('number', 'ASC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->select(['stockcode','number','sonum','asgnto','qrcode','psmb','dt_printseal'])
      ->take($var2)
      ->skip($var)
      ->get();
      
      $update = DB::table('qrmastersmb')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
	  ->where('number', '>=' ,$quantity1)
      ->where('number', '<=' ,$quantity2)  
      ->select(['stockcode','number','sonum','asgnto'])
      ->update(['reprintseal_by'=>$name, 'dt_reprintseal'=>$date]);
     
      $prints2 = DB::table('moresolist')
		  ->where('sonum','=', $sonum)
		  ->where('stockcode','=', $stockcode)
		  ->get();
		
      $prints3 = DB::table('qrmastersmb')
      ->orderByRaw('LENGTH(number)', 'ASC')
      ->orderBy('number', 'ASC')
      ->where('number', '>=' ,$quantity1)
      ->where('number', '<=' ,$quantity2)
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->get();
		
		foreach ($prints as $print){
	$increment = DB::table('reprint')->where('qrcode','=', $print->qrcode)->get();
			if ($increment->isEmpty()) { 
			$data = array("qrcode"=>$print->qrcode,'type'=>'Small Sticker','seq'=>$print->number,'reprintseal_by'=>$name, 'dt_reprintseal'=>$date,'ttlreprint'=>'1');
    DB::table('reprint')->insert($data);
			}else{
			foreach ($increment as $increment)
			$ttl = $increment->ttlreprint + 1;
			
			$data = array("qrcode"=>$print->qrcode,'type'=>'Small Sticker','seq'=>$print->number,'reprintseal_by'=>$name, 'dt_reprintseal'=>$date,'ttlreprint'=>$ttl);
    DB::table('reprint')->insert($data);
			}
	
		}
		$checkuom = DB::table('moresolist')
    ->where('stockcode','=', $stockcode)
    ->where('sonum','=', $sonum)
    ->first();
      
    if($checkuom->uom2 == 'PALLET'){
      return view('BS.customSmallSticker',['prints'=>$prints, 'prints2'=>$prints2, 'prints3'=>$prints3]);
    }else{
      return view('BS.printtestsmb',['prints'=>$prints, 'prints2'=>$prints2, 'prints3'=>$prints3]);
    }
    }
	
	
    function viewpallet($sonum)
    {
      $pallet = DB::table('solist')->distinct()->get(['sonum'])->where('sonum', '=', $sonum);
      return view('BS.palletreport',['pallet'=>$pallet]);
    
    }
   

   
    function printpallet($sonum, $pallet)
    {
    
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_customer_data2($sonum, $pallet));
     return $pdf->stream();
    
    }
    function get_customer_data2($sonum, $pallet)
    {
        if (Auth::check())
        {
         $layer = DB::table('qrmaster')
          ->distinct()
         ->select(['layer','sonum','pallet'])
        ->where('sonum','=', $sonum)
         ->where('pallet','=', $pallet)
        ->where('dt_opscancomplete','!=', NULL)
        ->get();
        }
        $pallet = DB::table('solist')->distinct()->get(['sonum','shipmark'])->where('sonum', '=', $sonum);
        foreach ($pallet as $pallets)
      $pallet2 = DB::table('qrmaster')
               ->distinct()
               ->select(['pallet','sonum'])
                ->where('sonum','=', $pallets->sonum)
                ->where('dt_opscancomplete','!=', NULL)
                ->get();
          return view('BS.pdfpallet',['layer'=>$layer,'pallet'=>$pallet,'pallet2'=>$pallet2]);
    }
	
}
