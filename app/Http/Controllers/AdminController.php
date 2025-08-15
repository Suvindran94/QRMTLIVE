<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function edit(Request $request) {
        $StaffID = $request->input('StaffID');
        $edit = DB::table('users')->where('StaffID', '=', $StaffID)->get();
        return view('BS.editstaff',['edit'=>$edit]);
    }

    public function update(Request $request) {
        $role = $request->input('role');
        $StaffID = $request->input('StaffID');
        $data= array("role"=>$role);
        $edit = DB::table('users')->where('StaffID', $StaffID)->update($data);
        Session::flash('message', 'Sucessfully Updated!!!'); 
        return redirect()->back();
    }
	//new
	public function getShipmark(Request $request)
	{
		$data = DB::table('template')->where('shipmark', $request->id)->first();

		return response()->json($data);
	}
	
	public function editdesign(Request $request) {
		$penguinlogo = $request->input('penguinlogo') ?: 0;
		$qrwebsite = $request->input('qrwebsite') ?: 0;
		$bmlogo = $request->input('bmlogo') ?: 0;
		$isologo = $request->input('isologo') ?: 0;
		$shipmark = $request->input('shipmark');
		$design = $request->input('design');
		$custStkID = $request->input('custStkID') ?: 0;
		$soTotalSeq = $request->input('soTotalSeq') ?: 0;
		
		
		
		$exist = DB::table('template')->where('shipmark',$shipmark)->count();
		$rand = rand();
		if($exist >= 1){
		
		$template =  DB::table('template')->where('shipmark',$shipmark)->first();
		
		if($design == 'custom'){
		if($request->hasFile('image'))
		{
		$file = $request->file('image');
		$extension = $file->getClientOriginalExtension();
		$filename = $rand.'.'.$extension;
		$upload = $file->move(public_path("img/barcodetemplate/logo/custom"), $filename);
		}
		else{
		if($template->logo != ''){
		$filename = $template->logo;
		}
		else{
		$filename = NULL;
		}
		}
		}
		else{
		$filename = NULL;
		}
		
		DB::table('template')->where('id',$template->id)->update([
		'shipmark' => $shipmark,
		'design' => $design,
		'penguinlogo' => $penguinlogo,
		'qrwebsite' => $qrwebsite,
		'bmlogo' => $bmlogo,
		'isologo' => $isologo,
		'custStkID' => $custStkID,
		'soTotalSeq' => $soTotalSeq,
		'logo' => $filename,
		]);
		}
		
		else{
			
		if($design == 'custom'){
		if($request->hasFile('image'))
		{
		$file = $request->file('image');
		$extension = $file->getClientOriginalExtension();
		$filename = $rand.'.'.$extension;
		$upload = $file->move(public_path("img/barcodetemplate/logo/custom"), $filename);
		}
		else{
		$filename = NULL;
		}
		}
		else{
		$filename = NULL;
		}
		
		DB::table('template')->insert([
		'shipmark' => $shipmark,
		'design' => $design,
		'penguinlogo' => $penguinlogo,
		'qrwebsite' => $qrwebsite,
		'bmlogo' => $bmlogo,
		'isologo' => $isologo,
		'custStkID' => $custStkID,
		'soTotalSeq' => $soTotalSeq,
		'logo' => $filename,
		]);
			
		}
			
	
		Session::flash('message', 'Successfully Updated!!!'); 
		return redirect()->back();
	}

    public function addevice(Request $request) {
        $deviceId = $request->input('deviceId');
        $name = $request->input('name');
        $status = $request->input('status');
        $date = $request->input('date');
        $location = $request->input('location');
        $data= array("deviceId"=>$deviceId, "name"=>$name, "status"=>$status, "date"=>$date, "location"=>$location);
        $edit = DB::table('device')->insert($data);
        Session::flash('message', 'Sucessfully Updated!!!'); 
        return redirect()->back();
    }
    public function updatedevice(Request $request) {
        $deviceId = $request->input('deviceId');
        $detail = DB::table('device')->where('deviceId', '=', $deviceId)->get();
        return view('BS.updatedevice',['detail'=>$detail]);
      
    }
    public function updatedevice2(Request $request) {
        $deviceId = $request->input('deviceId');
        $name = $request->input('name');
        $status = $request->input('status');
        $location = $request->input('location');
        $data= array("deviceId"=>$deviceId, "name"=>$name, "status"=>$status, "location"=>$location);
        $detailupdate = DB::table('device')->where('deviceId', '=', $deviceId)->update($data);
        Session::flash('message', 'Sucessfully Updated!!!'); 
        return redirect()->back();
      
    }
    public function generateqr(Request $request) {
        $StaffID = $request->input('StaffID');
        $location = $request->input('location');
        $qrcode = ('emp'.$StaffID.rand(100000000,999999999).'');

        $available = DB::table('userqr')->where('StaffID', '=', $StaffID)->first();
if ($available == NULL){
    $data= array("StaffID"=>$StaffID, "qrcode"=>$qrcode, "location"=>$location);
    DB::table('userqr')->insert($data);
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($this->get_customer_data($StaffID));
    return $pdf->stream();
}else{
    Session::flash('message', 'Already Generate QR!!!'); 
    return redirect()->back();
}
       
      
    }
    function get_customer_data($StaffID)
    {
             $prints = DB::table('userqr')
             ->where('StaffID','=', $StaffID)->get();
          return view('BS.userQR',['prints'=>$prints]);
    }
    public function plantZ()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur"); 
        $date = date('Y-m-d'); 
        $job = DB::table('qrmaster')
        ->orderBy('asgnto')
        ->orderBy('stockcode')
        ->orderByRaw('LENGTH(seq)', 'ASC')
        ->orderBy('seq', 'ASC')
        ->where('location', '=', 'Plant Z')
		->where('trx_status','A')
		
        ->paginate(6);
		
		
		
		
        return view('plantZ',['job'=>$job]);
    }
    public function plantP()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur"); 
        $date = date('Y-m-d'); 
        $job = DB::table('qrmaster')
        ->orderBy('asgnto')
        ->orderBy('stockcode')
        ->orderByRaw('LENGTH(seq)', 'ASC')
        ->orderBy('seq', 'ASC')
        ->where('location', '=', 'Plant P')
         ->where('dt_whackwrev', '=',  NULL)
		->where('trx_status','A')
		
        ->paginate(6);
        return view('plantP',['job'=>$job]);
    }
     public function plantPstat()
    {
         $stat = DB::table('qrmaster')
                 ->select('sonum', 'stockcode', 'pbag', 'deviceId')
                 ->groupBy('sonum', 'stockcode', 'pbag','deviceId')
			 ->where('location', '=', 'Plant P')
                 ->where('asgnto', '!=', NULL)
                 ->orderBy('deviceId', 'asc')->orderBy('sonum', 'asc')->orderBy('stockcode', 'asc')
			 ->where('trx_status','A')
                 ->paginate(13);
        return view('plantPstat',['stat'=>$stat]);
    }
	  public function plantZstat()
    {
         $stat = DB::table('qrmaster')
                 ->select('sonum', 'stockcode', 'pbag', 'deviceId')
                 ->groupBy('sonum', 'stockcode', 'pbag','deviceId')
			 ->where('location', '=', 'Plant Z')
                 ->where('asgnto', '!=', NULL)
                 ->orderBy('deviceId', 'asc')->orderBy('sonum', 'asc')->orderBy('stockcode', 'asc')
			 ->where('trx_status','A')
                 ->paginate(13);
        return view('plantZstat',['stat'=>$stat]);
    }
	
		  public function plantMstat()
    {
         $stat = DB::table('qrmaster')
                 ->select('sonum', 'stockcode', 'pbag', 'deviceId')
                 ->groupBy('sonum', 'stockcode', 'pbag','deviceId')
			 ->where('location', '=', 'Plant M')
                 ->where('asgnto', '!=', NULL)
                 ->orderBy('deviceId', 'asc')->orderBy('sonum', 'asc')->orderBy('stockcode', 'asc')
			 ->where('trx_status','A')
                 ->paginate(13);
        return view('plantMstat',['stat'=>$stat]);
    }
	
    public function plantM()
    {
        date_default_timezone_set("Asia/Kuala_Lumpur"); 
        $date = date('Y-m-d'); 
        $job = DB::table('qrmaster')
        ->orderBy('asgnto')
        ->orderBy('stockcode')
        ->orderByRaw('LENGTH(seq)', 'ASC')
        ->orderBy('seq', 'ASC')
        ->where('location', '=', 'Plant M')
			->where('trx_status','A')
        ->paginate(6);
        return view('plantM',['job'=>$job]);
    }
    function get_customer_data3($StaffID)
    {
    
             $prints = DB::table('userqr')
             ->where('StaffID','=', $StaffID)->get();
           
    
             return view('BS.userQR',['prints'=>$prints]);
    }

  
    function viewQR($StaffID)
    {
    
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_customer_data3($StaffID));
     return $pdf->stream();
   
    }
     function repdetail($sonum)
    {
      $report = DB::table('solist')->where('sonum','=', $sonum)->get();
      return view('BS.reportdetail',['report'=>$report]);
   
    }
   
public function calendarttl(Request $request){
		
		  $start = $request->input('start');
        $end = $request->input('end');
		$newStart = date("Y-m-d", strtotime($start)); 
		$newEnd = date("Y-m-d", strtotime($end)); 
     	 $name = auth()->user()->id;
	     $reservations = DB::table('qrmastersmb')->whereBetween('dt_opscancomplete', array($newStart.' 00:00:00', $newEnd.' 23:59:59'))->get();
		foreach($reservations as $reservation){
			$location = DB::table('moresolist')->where('sonum', '=', $reservation->sonum)->where('stockcode', '=', $reservation->stockcode)->get();
			foreach($location as $location){
		$data= array('sonum'=>$reservation->sonum,'stockcode'=>$reservation->stockcode,'dt_opscancomplete'=>$reservation->dt_opscancomplete,'quantity'=>$reservation->psmb,'asgnto'=>$reservation->asgnto,'searchby'=>$name,'location'=>$location->location,'dt_from'=>$start,'dt_to'=>$end);
		 DB::table('tempsearch')->insert($data);
			}
		}
		 return redirect()->back();
	}
	public function deletetemp() {
		$name = auth()->user()->id;
        DB::delete('delete from tempsearch where searchBy = ?',[$name]);
        return redirect()->back();
     }
	
	public function report(){
		$product = DB::table('qrmastersmb')
		->select(DB::raw('DATE(dt_opscancomplete) as date, location'))
			->groupBy('date','location')
          ->get();
          
		return view('BS.report',['product'=>$product]);
	}
	
	//New Code Portion begin
	
	
	function get_customer_dataP($StaffID)
    {
		$prints = DB::table('userqr')->where('StaffID','=', $StaffID)->get();
		return view('BS.userQRP',['prints'=>$prints]);
		}

	function viewQRP($StaffID)
    {
    	$available = DB::table('userqr')->where('StaffID', '=', $StaffID)->first();
		if (is_null($available) ) {
			Session::flash('message', 'Data is not found. Please contact BIS team for assistance'); 
			return redirect()->back();
		}
		else{
			$prints = DB::table('userqr')->where('StaffID','=', $StaffID)->get();
			if($prints[0]->password == NULL){
				Session::flash('message', 'Password is not found. Please contact BIS team for assistance'); 
				return redirect()->back();
				}
			else{
				$pdf = \App::make('dompdf.wrapper');
				$pdf->loadHTML($this->get_customer_dataP($StaffID));
				return $pdf->stream();
			}
		}
	}		

//New Code Portion end
	
	function reportnos()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->get_report_nos());
     return $pdf->stream();
    }
	function get_report_nos()
    {
           $reservations = DB::table('tempsearch')->select('sonum','stockcode','asgnto','searchby','dt_opscancomplete')->where('searchby','=', auth()->user()->id)->groupBy('sonum','stockcode','asgnto','searchby','dt_opscancomplete')->orderBy('dt_opscancomplete', 'asc')->get();
		  $date = DB::table('tempsearch')->select('searchby','dt_from','dt_to')->where('searchby','=', auth()->user()->id)->groupBy('searchby','dt_from','dt_to')->get();
          return view('BS.reportnos',['reservations'=>$reservations,'date'=>$date]);
    }
}
