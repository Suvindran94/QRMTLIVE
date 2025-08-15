<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PRD_ACTIVE_OPERATORS;
use DB;
use App\PRD_TRX;
use App\PRD_LOGS;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;
use PDO;
use App\PRD_EXCEPTION_REQUEST;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class OperatorNewUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
    return view('QRMT-OPRUPD.index',compact('id'));
    }

    /*

    public function processWO(){

        $macAddresses = shell_exec('getmac');
        $pattern = '/([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})/';
        preg_match($pattern, $macAddresses, $matches);
        //$currentPhysicalAddress = $matches[0];
        $currentPhysicalAddress = '00:00:5e:00:53:af';

        $device = DB::table('device')
        ->where('macaddress',$currentPhysicalAddress)
        ->first();

        if($device == ''){
        abort(403,"INFO: No device found for the following Mac Address: $currentPhysicalAddress. Please contact BIS for further action!");
        }
        
        $ActiveWO = PRD_TRX::where('OPER_STAFF_ID',auth()->user()->StaffID)
        ->where('PRD_STATUS','A')
        ->orderBy('PRD_SEQ_BY_OPER')
        ->first();

        if($ActiveWO == ''){

        $getSonum = DB::table('qrmaster')
        ->select('sonum')
        ->where('asgnto',auth()->user()->StaffID)
        ->where('printseal_by',NULL)
        ->where('deviceId',$device->deviceId)->groupBy('sonum')->pluck('sonum');

        if($getSonum == ''){
        abort(403,"INFO: No SO found for the Staff ID: ".auth()->user()->StaffID.". Please contact BIS for further information!");
        }

        $getStkCode = DB::table('qrmaster')
        ->select('stockcode')
        ->where('asgnto',auth()->user()->StaffID)
        ->where('printseal_by',NULL)
        ->where('deviceId',$device->deviceId)->groupBy('stockcode')->pluck('stockcode');


        $getwo = DB::connection('mysqlPM')
        ->table('PRD_WO_HDR')
        ->whereIn('WO_STATUS',['A','I'])
        ->whereIn('WO_SOUCE_ID',$getSonum)
        ->whereIn('WO_STK_FG_NO',$getStkCode)
        //->whereRaw('DATE(WO_DATE) = ?', [Carbon::today()->toDateString()])
        ->get();

        if(count($getwo) <= 0){
        abort(403,"INFO: No WO found for the SO: ".$getSonum.". and Stockcode: ".$getStkCode." Please contact BIS for further information!");
        }

        foreach($getwo as $wo){

        $qrmaster = DB::table('qrmaster')
        ->where('asgnto',auth()->user()->StaffID)
        ->where('deviceId',$device->deviceId)
        ->where('sonum',$wo->WO_SOUCE_ID)
        ->where('stockcode',$wo->WO_STK_FG_NO)
        ->first();

        $totalstdbag = DB::table('qrmaster')
        ->where('asgnto',auth()->user()->StaffID)
        ->where('deviceId',$device->deviceId)
        ->where('sonum',$wo->WO_SOUCE_ID)
        ->where('stockcode',$wo->WO_STK_FG_NO)
        ->count();

        $getFirstSeq = DB::table('qrmaster')
        ->where('asgnto',auth()->user()->StaffID)
        ->where('deviceId',$device->deviceId)
        ->where('sonum',$wo->WO_SOUCE_ID)
        ->where('stockcode',$wo->WO_STK_FG_NO)
        ->orderBy('id')
        ->first();



   $getmaxseq = PRD_TRX::where('OPER_STAFF_ID',auth()->user()->StaffID)->max('PRD_SEQ_BY_OPER') + 1;

    $querys = PRD_TRX::whereNotNull('PRD_ID')->max('PRD_ID');


    $year = substr($querys,2,-6); 

    if($year == date('y')){
    $query = PRD_TRX::whereNotNull('PRD_ID')->max('PRD_ID'); 
    }
    else{
    $query = NULL;
    }

    if (empty($query)) {
        $number = '1';
        $nextNumber = 'PRD' . date('y') .'/' . sprintf("%05d", $number);
    } else {
        $explodeno = explode("/", $query);
        $number = $explodeno[1] + 1;
        $nextNumber = 'PRD' . date('y') .'/' . sprintf("%05d", $number);
    }

    $getNextSeq = DB::table('qrmastersmb')
    ->where('asgnto',auth()->user()->StaffID)
    ->where('deviceId', $device->deviceId)
    ->where('sonum',$wo->WO_SOUCE_ID)
    ->where('stockcode', $wo->WO_STK_FG_NO)
    ->where('dt_printseal', '=', NULL)
    ->orderBy('number')
    ->first();
           
            $trx = new PRD_TRX;
            $trx->PRD_SEQ_BY_OPER = $getmaxseq;
            $trx->PRD_ID = $nextNumber;
            $trx->WO_ID = $wo->WO_ID;
            $trx->SO_NO =  $wo->WO_SOUCE_ID;
            $trx->PACK_METH = $qrmaster->pbag;
            $trx->STK_CODE = $wo->WO_STK_FG_NO;
            $trx->PBAG =  $qrmaster->pbag;
            $trx->TOTAL_STD_BAG =  $totalstdbag;
            $trx->CURRENT_SMALL_BAG =  '1';
            $trx->NUMBER = $getNextSeq->number;
            $trx->CURRENT_STD_BAG =  $getFirstSeq->seq;
            $trx->ZONE = $device->zone;
            $trx->DEVICE = $device->deviceId;
            $trx->OPER_STAFF_ID = auth()->user()->StaffID;
            $trx->START_DATETIME = Carbon::now();
            $trx->END_DATETIME = NULL;
            $trx->EXCEPTION = 0;
            $trx->EXCEPTION_STATUS = 0;
            $trx->PRD_STATUS = 'A';
            $trx->STEP1 = 'step-active';
            $trx->STEP2 = 'step-todo';
            $trx->STEP3 = 'step-todo';
            $trx->STEP4 = 'step-todo';
            $trx->STEP5 = 'step-todo';
            $trx->STEP6 = 'step-todo';
            $trx->CURRENTSTEP = 1;
            $trx->save();

            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'START_WO';
            $logs->REF_ID = $wo->WO_ID;
            $logs->USER_ID = auth()->user()->id;
            $logs->PRD_ID = $nextNumber;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $getFirstSeq->seq;
            $logs->CURRENT_SMALL_BAG = '1';
            $logs->save();


        }
        return redirect("operatorDash/$nextNumber");
        
        }
        else{

            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'RESUME_WO';
            $logs->REF_ID = $ActiveWO->WO_ID;
            $logs->USER_ID = auth()->user()->id;
            $logs->PRD_ID = $ActiveWO->PRD_ID;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $ActiveWO->CURRENT_STD_BAG;
            $logs->CURRENT_SMALL_BAG = $ActiveWO->CURRENT_SMALL_BAG;
            $logs->save();

        return redirect("operatorDash/".$ActiveWO->PRD_ID);
        }
    }
    */


    public function switchUser(Request $request){

        $qrcode = $request->qrcode;

        $getStaff = DB::table('userqr')->where('qrcode',$qrcode)->first();

        if($getStaff == ''){
            return response()->json([
                'type' => 'ERROR',
                'message' => 'Invalid QR Code!',
                'url' => ""
             ]);
        }

        

        $user = DB::table('users')->where('StaffID',$getStaff->StaffID)->where('status','A')->first();

        if($user == ''){
            return response()->json([
                'type' => 'ERROR',
                'message' => 'User is Inactive for Staff ID:'.$getStaff->StaffID,
                'url' => ""
             ]);
        }

        $macAddresses = shell_exec('getmac');
        $pattern = '/([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})/';
        preg_match($pattern, $macAddresses, $matches);
        //$currentPhysicalAddress = $matches[0];
        $currentPhysicalAddress = '00:00:5e:00:53:af';
        
         $device = DB::table('device')
        ->where('macaddress',$currentPhysicalAddress)
        ->pluck('deviceId');

        $getmacid = DB::table('machinedetails')
        ->whereIn('ShortName',$device)
        ->pluck('machineNo');

        $zone = DB::connection('mysqlPM')
        ->table('PRD_MAC_ZONE')
        ->where(function ($query) use ($getmacid) {
            foreach ($getmacid as $mac) {
                $query->orWhereJsonContains('ZONE_MAC', [$mac]);
            }
        })
        ->first();

        if(count($device) <= 0){
            return response()->json([
                'type' => 'ERROR',
                'message' => "No device found for the following Mac Address: $currentPhysicalAddress. Please contact BIS for further action!",
                'url' => ""
             ]);
        }

        if($zone == ''){
            return response()->json([
                'type' => 'ERROR',
                'message' => "No Zone found for the following Devices: $device. Please contact BIS for further action!",
                'url' => ""
             ]);
        }
        
        $ActiveWO = PRD_TRX::where('OPER_STAFF_ID',$user->StaffID)
        //->whereIn('PRD_STATUS',['A','S'])
		->whereIn('PRD_STATUS',['A'])
        ->whereIn('DEVICE',$device)
        ->orderBy('PRD_SEQ_BY_OPER')
        ->first();

        if($ActiveWO == ''){

        $getSonum = DB::table('qrmaster')
        ->select('sonum')
        ->where('asgnto',$user->StaffID)
        ->where('printseal_by',NULL)
        ->whereIn('deviceId',$device)
		->where('trx_status','A')
        ->groupBy('sonum')
        ->pluck('sonum');

        if(count($getSonum) <= 0){
        
        return response()->json([
            'type' => 'ERROR',
            'message' => "No SO found for the Staff ID: ".$user->StaffID." for the Device ".$device.". Please contact Supervisor for further information!",
            'url' => ""
            ]);    
			
        }

        $getStkCode = DB::table('qrmaster')
        ->select('stockcode')
        ->where('asgnto',$user->StaffID)
        ->where('printseal_by',NULL)
        ->whereIn('deviceId',$device)
			->where('trx_status','A')
        ->groupBy('stockcode')
        ->pluck('stockcode');
			
			
		//getexistingwoassociatedwiththissonumandstkcode
			
		 $associatedWO = PRD_TRX::where('OPER_STAFF_ID',$user->StaffID)
        ->whereIn('DEVICE',$device)
		->whereIn('SO_NO',$getSonum)
		->whereIn('STK_CODE',$getStkCode)
        ->pluck('WO_ID');
			
		$filterassociatedwo = DB::connection('mysqlPM')
        ->table('PRD_WO_HDR')
        ->where('WO_STATUS','C')
		->whereIn('WO_ID',$associatedWO)
         ->pluck('WO_ID');


		//get WO (unique)
			
        $getwo = DB::connection('mysqlPM')
        ->table('PRD_WO_HDR')
        ->whereIn('WO_STATUS',['A','I'])
        ->whereIn('WO_SOUCE_ID',$getSonum)
        ->whereIn('WO_STK_FG_NO',$getStkCode)
		->whereNotIn('WO_ID',$filterassociatedwo)
		->where('WO_STK_NO', 'NOT LIKE', 'C%')
        ->get();
			
			
		
		

        if(count($getwo) <= 0){
            return response()->json([
                'type' => 'ERROR',
                'message' => "No <b>Work Order</b> found for the <br>SO: ".$getSonum.". and Stockcode: ".$getStkCode." Please contact Supervisor for further information!",
                'url' => ""
             ]);
        }

        foreach($getwo as $wo){

        $getFirstSeq = DB::table('qrmaster')
        ->where('asgnto',$user->StaffID)
        ->whereIn('deviceId',$device)
        ->where('sonum',$wo->WO_SOUCE_ID)
        ->where('stockcode',$wo->WO_STK_FG_NO)
		->where('trx_status','A')
		->where('printseal_by',NULL)
        ->orderBy('id')
        ->first();

        $qrmaster = DB::table('qrmaster')
        ->where('asgnto',$user->StaffID)
        ->where('deviceId',$getFirstSeq->deviceId)
        ->where('sonum',$wo->WO_SOUCE_ID)
        ->where('stockcode',$wo->WO_STK_FG_NO)
		->where('trx_status','A')
		->where('printseal_by',NULL)
        ->first();

        $totalstdbag = DB::table('qrmaster')
        ->where('asgnto',$user->StaffID)
        ->where('deviceId',$getFirstSeq->deviceId)
        ->where('sonum',$wo->WO_SOUCE_ID)
        ->where('stockcode',$wo->WO_STK_FG_NO)
		->where('printseal_by',NULL)
		->where('trx_status','A')
        ->count();





   $getmaxseq = PRD_TRX::where('OPER_STAFF_ID',$user->StaffID)->max('PRD_SEQ_BY_OPER') + 1;

    $querys = PRD_TRX::whereNotNull('PRD_ID')->max('PRD_ID');


    $year = substr($querys,3,-6); 



    if($year == date('y')){
    $query = PRD_TRX::whereNotNull('PRD_ID')->max('PRD_ID'); 
    }
    else{
    $query = NULL;
    }

    if (empty($query)) {
        $number = '1';
        $nextNumber = 'PRD' . date('y') .'/' . sprintf("%05d", $number);
    } else {
        $explodeno = explode("/", $query);
        $number = $explodeno[1] + 1;
        $nextNumber = 'PRD' . date('y') .'/' . sprintf("%05d", $number);
    }

    $moresolist = DB::table('moresolist')
    ->where('sonum',$wo->WO_SOUCE_ID)
    ->where('stockcode', $wo->WO_STK_FG_NO)
    ->first();

    $getNextSeq = DB::table('qrmastersmb')
    ->where('asgnto',$user->StaffID)
    ->where('deviceId', $getFirstSeq->deviceId)
    ->where('sonum',$wo->WO_SOUCE_ID)
    ->where('stockcode', $wo->WO_STK_FG_NO)
    ->where('dt_printseal', '=', NULL)
    ->orderBy('number')
    ->first();
           
            if($moresolist->smbAvailability == 'Y'){
            $trx = new PRD_TRX;
            $trx->PRD_SEQ_BY_OPER = $getmaxseq;
            $trx->PRD_ID = $nextNumber;
            $trx->WO_ID = $wo->WO_ID;
            $trx->WO_QTY = $wo->WO_QTY;
            $trx->SO_NO =  $wo->WO_SOUCE_ID;
            $trx->PACK_METH = $moresolist->uom2;
            $trx->STK_CODE = $wo->WO_STK_FG_NO;
            $trx->PBAG =  $qrmaster->pbag;
            $trx->TOTAL_STD_BAG =  $totalstdbag;
            $trx->CURRENT_SMALL_BAG =  '1';
            $trx->NUMBER = $getNextSeq->number;
            $trx->CURRENT_STD_BAG =  $getFirstSeq->seq;
            $trx->ZONE_ID = $zone->ZONE_ID;
            $trx->DEVICE = $getFirstSeq->deviceId;
            $trx->OPER_STAFF_ID = $user->StaffID;
            $trx->START_DATETIME = NULL;
            $trx->END_DATETIME = NULL;
            $trx->SMB = 'Y';
            $trx->EXCEPTION = 0;
            $trx->EXCEPTION_STATUS = 0;
            $trx->PRD_STATUS = 'A';
            $trx->STEP1 = 'step-active';
            $trx->STEP2 = 'step-todo';
            $trx->STEP3 = 'step-todo';
            $trx->STEP4 = 'step-todo';
            $trx->STEP5 = 'step-todo';
            $trx->STEP6 = 'step-todo';
            $trx->CURRENTSTEP = 1;
            $trx->save();

            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'START_WO';
            $logs->REF_ID = $wo->WO_ID;
            $logs->USER_ID = $user->id;
            $logs->PRD_ID = $nextNumber;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $getFirstSeq->seq;
            $logs->CURRENT_SMALL_BAG = '1';
            $logs->save();
            }
            else{
            $trx = new PRD_TRX;
            $trx->PRD_SEQ_BY_OPER = $getmaxseq;
            $trx->PRD_ID = $nextNumber;
            $trx->WO_ID = $wo->WO_ID;
            $trx->WO_QTY = $wo->WO_QTY;
            $trx->SO_NO =  $wo->WO_SOUCE_ID;
            $trx->PACK_METH = $moresolist->uom2;
            $trx->STK_CODE = $wo->WO_STK_FG_NO;
            $trx->PBAG =  $qrmaster->pbag;
            $trx->TOTAL_STD_BAG =  $totalstdbag;
            $trx->CURRENT_SMALL_BAG =  0;
            $trx->NUMBER = 0;
            $trx->CURRENT_STD_BAG =  $getFirstSeq->seq;
            $trx->ZONE_ID = $zone->ZONE_ID;
            $trx->DEVICE = $getFirstSeq->deviceId;
            $trx->OPER_STAFF_ID = $user->StaffID;
            $trx->START_DATETIME = NULL;
            $trx->END_DATETIME = NULL;
            $trx->SMB = 'N';
            $trx->EXCEPTION = 0;
            $trx->EXCEPTION_STATUS = 0;
            $trx->PRD_STATUS = 'A';
            $trx->STEP1 = 'step-active';
            $trx->STEP2 = 'step-grey';
            $trx->STEP3 = 'step-grey';
            $trx->STEP4 = 'step-grey';
            $trx->STEP5 = 'step-todo';
            $trx->STEP6 = 'step-todo';
            $trx->CURRENTSTEP = 1;
            $trx->save();

            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'START_WO';
            $logs->REF_ID = $wo->WO_ID;
            $logs->USER_ID = $user->id;
            $logs->PRD_ID = $nextNumber;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $getFirstSeq->seq;
            $logs->CURRENT_SMALL_BAG = 0;
            $logs->save();  
            }


        }

        
        Auth::loginUsingId($user->id, true);

        $latestWO = PRD_TRX::where('OPER_STAFF_ID',$user->StaffID)
        ->where('PRD_STATUS','A')
        ->whereIn('DEVICE',$device)
        ->orderBy('PRD_SEQ_BY_OPER')
        ->first();

        $PRDID = $latestWO->PRD_ID;

        $getActiveOperator = PRD_ACTIVE_OPERATORS::where('STAFF_ID',$user->StaffID)->first();

        if($getActiveOperator == ''){
            $active = new PRD_ACTIVE_OPERATORS;
            $active->STAFF_ID = $user->StaffID;
            $active->NAME = $user->name;
            $active->ZONE = $zone->ZONE_ID;
            $active->TRX_CREATE_DATE = Carbon::now();
            $active->TRX_UPD_DATE = Carbon::now();
            $active->save();

            return response()->json([
                'type' => 'SUCCESS',
                'message' => "Processing Work Order... Please wait!",
                'url' => "/operatorDash/$PRDID"
             ]);
        }
        else{
            $getActiveOperator->STAFF_ID = $user->StaffID;
            $getActiveOperator->NAME = $user->name;
            $getActiveOperator->ZONE = $zone->ZONE_ID;
            $getActiveOperator->TRX_UPD_DATE = Carbon::now();
            $getActiveOperator->save();

            return response()->json([
                'type' => 'SUCCESS',
                'message' => "Processing Work Order... Please wait!",
                'url' => "/operatorDash/$PRDID"
             ]);
        }

    

        
        }
        else{

            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'RESUME_WO';
            $logs->REF_ID = $ActiveWO->WO_ID;
            $logs->USER_ID = $user->id;
            $logs->PRD_ID = $ActiveWO->PRD_ID;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $ActiveWO->CURRENT_STD_BAG;
            $logs->CURRENT_SMALL_BAG = $ActiveWO->CURRENT_SMALL_BAG;
            $logs->save();

            Auth::loginUsingId($user->id, true);
            

            $getActiveOperator = PRD_ACTIVE_OPERATORS::where('STAFF_ID',auth()->user()->StaffID)->first();

            if($getActiveOperator == ''){
                $active = new PRD_ACTIVE_OPERATORS;
                $active->STAFF_ID = auth()->user()->StaffID;
                $active->NAME = auth()->user()->name;
                $active->ZONE = $zone->ZONE_ID;
                $active->TRX_CREATE_DATE = Carbon::now();
                $active->TRX_UPD_DATE = Carbon::now();
                $active->save();

                return response()->json([
                    'type' => 'SUCCESS',
                    'message' => "Processing Work Order... Please wait!",
                    'url' => "/operatorDash/".$ActiveWO->PRD_ID
                 ]);
            }
            else{
                $getActiveOperator->STAFF_ID = auth()->user()->StaffID;
                $getActiveOperator->NAME = auth()->user()->name;
                $getActiveOperator->ZONE = $zone->ZONE_ID;
                $getActiveOperator->TRX_UPD_DATE = Carbon::now();
                $getActiveOperator->save();

                return response()->json([
                    'type' => 'SUCCESS',
                    'message' => "Processing Work Order... Please wait!",
                    'url' => "/operatorDash/".$ActiveWO->PRD_ID
                 ]);
            }

  

         

        }
    }

    

    public function reloadWO(Request $request){

    $trx = PRD_TRX::where('PRD_ID',$request->id)->first();


    if($trx->PRD_STATUS == 'A'){

        if($request->type == 1){

                   // Execute the command
// Full path to RsKey.exe
$exePath = 'C:\\ProgramData\\ADWinCT\\RsKey.exe';

// Full path to script.exe (assuming it's an AutoIt script)
$scriptPath = 'C:\\ProgramData\\ADWinCT\\script.exe';

// Command to start RsKey.exe
$commandRsKey = "start /B \"\" \"$exePath\"";
popen($commandRsKey, 'r');


// Command to run script.exe using cmd.exe
$commandScript = "start /B cmd /c \"$scriptPath\"";
popen($commandScript, 'r');

                    PRD_TRX::where('PRD_ID',$request->id)->update([
                        'STEP2' =>'step-active',
                        'STEP3' => 'step-todo',
                        'STEP4' => 'step-todo',
                        'CURRENTSTEP' => 2,
                    ]);

                    return response()->json(['type' =>'success','message' => 'Successfully Bypassed','code' => '1']);
                

                
 
        }
        else if($request->type == 2){

            $moresolist = DB::table('moresolist')
            //->where('asgnto',auth()->user()->StaffID)
            ->where('sonum',$trx->SO_NO)
            ->where('stockcode',$trx->STK_CODE)
            ->first();

            //update next seq
            $getNextSeq = DB::table('qrmastersmb')
            ->where('asgnto',auth()->user()->StaffID)
            ->where('deviceId',$trx->DEVICE)
            ->where('sonum',$trx->SO_NO)
            ->where('stockcode',$trx->STK_CODE)
            ->where('dt_printseal', '=', NULL)
            ->orderBy('number')
            ->first();

            if ($moresolist) { //check if got row match 

                $currentScannedSmallBag = PRD_LOGS::where('PRD_ID',$request->id)
                ->where('LOG_TYPE','SCAN_SB')
                ->where('STATUS','0')
                ->count();
        
                $totalScannedSmallBagQty = $currentScannedSmallBag != 0 ? $moresolist->psmb * $currentScannedSmallBag: 0;

                if($totalScannedSmallBagQty >= $trx->WO_QTY){

                    $ActiveWO = PRD_TRX::where('OPER_STAFF_ID',auth()->user()->StaffID)
                    ->where('PRD_STATUS','A')
                    ->where('ZONE_ID',$trx->ZONE_ID)
                    ->orderBy('PRD_SEQ_BY_OPER')
                    ->first();
    
                    if($ActiveWO != ''){
                        $prdid = $ActiveWO->PRD_ID;
                        $url = "operatorDash/$prdid";
                    }
                    else{
                        PRD_ACTIVE_OPERATORS::where('STAFF_ID',auth()->user()->StaffID)->where('ZONE',$trx->ZONE_ID)->delete();
                        $url = "operatorDash/-";
                    }
    
                    PRD_TRX::where('PRD_ID',$request->id)->update([
                    'STEP1' =>'step-done',
                    'STEP2' => 'step-done',
                    'STEP3' =>'step-done',
                    'STEP4' => 'step-done',
                    'STEP5' =>'step-done',
                    'STEP6' => 'step-skip',
                    'CURRENTSTEP' => 0,
                    'PRD_STATUS' => 'C',
                    'END_DATETIME' => Carbon::now()
                    ]);
    
                    return response()->json([
                        'type'=>'info',
                        'message' => 'Operator Scan Complete for this Work Order!',
                        'url' => "/$url",
                        'code' => 1
                    ]);

                }
                else{

                if($trx->CURRENT_SMALL_BAG == $moresolist->psmb){
                    PRD_TRX::where('PRD_ID',$request->id)->update([
                        'CURRENT_SMALL_BAG' => 1,
                        'NUMBER' => $getNextSeq->number,
                        'STEP4' =>'step-done',
                        'STEP5' => 'step-active',
                        'CURRENTSTEP' => 5,
                    ]);
                }
                else{

                            // Execute the command
// Full path to RsKey.exe
$exePath = 'C:\\ProgramData\\ADWinCT\\RsKey.exe';

// Full path to script.exe (assuming it's an AutoIt script)
$scriptPath = 'C:\\ProgramData\\ADWinCT\\script.exe';

// Command to start RsKey.exe
$commandRsKey = "start /B \"\" \"$exePath\"";
popen($commandRsKey, 'r');


// Command to run script.exe using cmd.exe
$commandScript = "start /B cmd /c \"$scriptPath\"";
popen($commandScript, 'r');

                    PRD_TRX::where('PRD_ID',$request->id)->update([
                        'CURRENT_SMALL_BAG' => $trx->CURRENT_SMALL_BAG + 1,
                        'NUMBER' => $getNextSeq->number,
                        'STEP2' =>'step-active',
                        'STEP3' => 'step-todo',
                        'STEP4' => 'step-todo',
                        'CURRENTSTEP' => 2,
                    ]);

                    
                }

                return response()->json(['type' =>'success','message' => 'Successfully Bypassed','code' => '1']);
                }
            }
        }
        else if($request->type == 3){
   
            PRD_TRX::where('PRD_ID',$request->id)->update([
                'STEP1' =>'step-done',
                'STEP2' => 'step-done',
                'STEP3' =>'step-done',
                'STEP4' => 'step-done',
                'STEP5' =>'step-done',
                'STEP6' => 'step-active',
                'CURRENTSTEP' => 6,
            ]);

        

            return response()->json([
                'type'=>'info',
                'message' => 'Bypass Complete',
                'code' => '1',
                'url' => ""]);
      

        }
    }
    else{
        return response()->json([
            'code' => '2'
        ]);
    }
}
    

    public function checkWOstatus(Request $request){

    $trx = PRD_TRX::where('PRD_ID',$request->id)->first();


        return response()->json([
            'type' => 'OK',
            'message' => "OK",
            'status' => $trx->PRD_STATUS,
            'EXCEPTION' => $trx->EXCEPTION
        ]); 
 

        /*
    if($trx->PRD_STATUS == 'S' && $trx->EXCEPTION == '1' || $trx->PRD_STATUS == 'S' && $trx->EXCEPTION == '4'){
        return response()->json([
            'type' => 'ERROR',
            'message' => "This Work Order is pending for Supervisor Verification. Please wait!"
        ]);
    }
    else if($trx->PRD_STATUS == 'S' && $trx->EXCEPTION == '0'){
        return response()->json([
            'type' => 'ERROR',
            'message' => "This Work Order is on hold. Please wait!"
        ]);
    }
    else{
        return response()->json([
            'type' => 'OK',
            'message' => "OK"
        ]);
    }
    */
  




    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchdata(Request $request)
    {
        if($request->id != '-'){
        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();

        if($trx->OPER_STAFF_ID != auth()->user()->StaffID){
            return response()->json(['message' => "This WO does not match with Current Staff ID"],500);
        }
			
$yesterday = Carbon::today()->subDay();			
$currentTime = Carbon::now();

$start = Carbon::today()->setTime(0, 0, 0); // 12:00 AM
$end = Carbon::today()->setTime(6, 0, 0);   // 6:00 AM

if ($currentTime->between($start, $end)) {
			$checkTimesheet = DB::table('daily_timesheet')
				->whereDate('daily_date', $yesterday)
				->where('staffid', auth()->user()->StaffID)
				->count();
} else {
			$checkTimesheet = DB::table('daily_timesheet')
				->whereDate('daily_date', Carbon::today())
				->where('staffid', auth()->user()->StaffID)
				->count();
}
			

			if($checkTimesheet > 0){
				$timesheet = 'Y';
			}
			else{
				$timesheet = 'N';
			}



        $zoneid = $trx->ZONE_ID;

        $operator = [];

        $getoperator = PRD_ACTIVE_OPERATORS::where('ZONE',$zoneid)->get();

        foreach($getoperator as $opr){
        $operator[$opr->STAFF_ID] = $opr->NAME;
        }

        $currentstep = $trx->CURRENTSTEP;

        $zone = DB::connection('mysqlPM')
        ->table('PRD_MAC_ZONE')
        ->where('ZONE_ID',$trx->ZONE_ID)
        ->first();

        $moresolist = DB::table('moresolist')
        ->where('sonum',$trx->SO_NO)
        ->where('stockcode',$trx->STK_CODE)
        ->first();

        $currentScannedSmallBag = PRD_LOGS::where('PRD_ID',$request->id)
        ->where('LOG_TYPE','SCAN_SB')
        ->where('STATUS','0')
        ->count();

        $totalScannedSmallBagQty = $currentScannedSmallBag != 0 ? $moresolist->psmb * $currentScannedSmallBag: 0;

        $getmachine = DB::table('machinedetails')->where('ShortName',$trx->DEVICE)->first();

        $getwo = DB::connection('mysqlPM')
        ->table('PRD_WO_HDR')
        ->where('WO_ID',$trx->WO_ID)
        ->first();
			
		$source = $trx->SO_NO;
		$first_two_characters = substr($source, 0, 2);

		if($first_two_characters == 'SO'){
    	$getSalesOrder = DB::connection('mysqlSM')
        ->table('SO_DT')
        ->where('SO_ID',$trx->SO_NO)
        ->where('SO_STK_CODE',$trx->STK_CODE)
        ->first();
			
		$packmeth =$getSalesOrder->SO_PACK_METH;
		}
		else{
	    $getSalesOrder = DB::connection('mysqlSM')
        ->table('MO_DT')
        ->where('MO_ID',$trx->SO_NO)
        ->where('MO_STK_CODE',$trx->STK_CODE)
        ->first();		
			
		$packmeth =$getSalesOrder->MO_PACK_METH;
		}
			
		


        $getstockcode = DB::connection('mysqlSM')
        ->table('STK_MST')
        ->where('STK_CODE',$trx->STK_CODE)
        ->first();

        $getuom = DB::connection('mysqlSM')
        ->table('STK_MST_UOM')
        ->where('STK_UOM_STKCODE',$trx->STK_CODE)
        ->where('STK_UOM_UOM',$packmeth)
        ->first();

        if($getuom != ''){
            $packuom = $getuom->PACKING_UOM_STKCODE;
            $getuomdesc = DB::connection('mysqlSM')
            ->table('STK_MST')
            ->where('STK_CODE',$packuom)
            ->first();
            $stdbagdesc = $getuomdesc->STK_SHORT_NAME;
        }
        else{
            $stdbagdesc = '-';
        }

        $getuomsmallbag = DB::connection('mysqlSM')
        ->table('STK_MST_UOM')
        ->where('STK_UOM_STKCODE',$trx->STK_CODE)
        ->where('STK_UOM_UOM','SB')
        ->first();


        if($getuomsmallbag != ''){
            $packuom = $getuomsmallbag->PACKING_UOM_STKCODE;
            $getuomdesc = DB::connection('mysqlSM')
            ->table('STK_MST')
            ->where('STK_CODE',$packuom)
            ->first();
            $smallbagpack = $getuomdesc->STK_SHORT_NAME;
        }
        else{
            $smallbagpack = '-';
        }


        $data = [
            'DEVICE' => $trx->DEVICE.' - '.$getmachine->MacDesc,
            'ZONE' => $zone->ZONE_NAME,
            'WO' => $trx->WO_ID,
            'SO' => $trx->SO_NO,
            'STK' => $trx->STK_CODE,
            'PMETHOD' => $trx->PACK_METH,
            'CSTDB' => $trx->CURRENT_STD_BAG,
            'CSB' => $trx->CURRENT_SMALL_BAG,
            'NUMBER' => $trx->NUMBER,
            'ACTIVEOPR' => $trx->OPER_STAFF_ID,
            'STEP1' => $trx->STEP1,
            'STEP2' =>$trx->STEP2,
            'STEP3' => $trx->STEP3,
            'STEP4' => $trx->STEP4,
            'STEP5' =>$trx->STEP5,
            'STEP6' => $trx->STEP6,
            'CURRENTSTEP' => $currentstep,
            'WOQTY' =>  $trx->WO_QTY,
            'SCANNED_QTY' => $totalScannedSmallBagQty,
            'EXCEPTION' => $trx->EXCEPTION,
            'EXCEPTION_STATUS' => $trx->EXCEPTION_STATUS,
            'PRD_STATUS' => $trx->PRD_STATUS,
            'TOTAL_SMALL_BAG' => $moresolist->ttlsmb,
            'CYCLE_TIME' => $getwo->WO_MOULD_CT,
            'MOULD' => $getwo->WO_MOULD_ID,
            'CAVITY' => $getwo->WO_MOULD_CAV,
            'SHORT_NAME' => $getstockcode->STK_SHORT_NAME,
            'STD_PACK' => $stdbagdesc,
            'SMALL_PACK' => $smallbagpack,
			'NOS_PER_STD_BAG' => $moresolist->psmb
        ];
			
			
			 if($timesheet == 'N'){
                    $name = auth()->user()->name;
                    $staffid = auth()->user()->StaffID;

                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction" style="color:red;">Please update Daily Timesheet for the Operator <br><b style="color:black;">'.$name.'('.$staffid.')</b></h1>
                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/timesheet.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';

                    return response()->json([$data,$operator,$output]);
                } else if($trx->EXCEPTION == 0 && $trx->EXCEPTION_STATUS == 0 && $trx->PRD_STATUS == 'S'){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">This WORK ORDER is on HOLD</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/hold.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';

                    $apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/closeRSKEY';


                    $client = new Client([
                    'verify' => false,
                    ]);
            
            
                    $responses = $client->get($apiEndpoint);

                    return response()->json([$data,$operator,$output]);
                }
                else if($trx->EXCEPTION == 1 && $trx->EXCEPTION_STATUS == 0){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">Press the <b style="color:red;">Red</b> Button to Request Supervisor Bypass</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/redbtn.png" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                    return response()->json([$data,$operator,$output]);
                }
                if($trx->EXCEPTION == 1 && $trx->EXCEPTION_STATUS == 1){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">Awaiting Supervisor to Bypass</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/loading.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                    return response()->json([$data,$operator,$output]);
                }
                else if($trx->EXCEPTION == 2 && $trx->EXCEPTION_STATUS == 0){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">Press the <b style="color:red;">Red</b> Button to Request Supervisor Bypass</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/redbtn.png" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                    return response()->json([$data,$operator,$output]);
                }
                else if($trx->EXCEPTION == 3 && $trx->EXCEPTION_STATUS == 0){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">Press the <b style="color:red;">Red</b> Button to Request Supervisor Bypass</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/redbtn.png" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                    return response()->json([$data,$operator,$output]);
                }
                else if($trx->EXCEPTION == 2 && $trx->EXCEPTION_STATUS == 1){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">Awaiting Supervisor to Bypass</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/loading.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                    return response()->json([$data,$operator,$output]);
                }
                else if($trx->EXCEPTION == 3 && $trx->EXCEPTION_STATUS == 1){
                    $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                        <h1 class="instruction">Awaiting Supervisor to Bypass</h1>

                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/loading.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                    return response()->json([$data,$operator,$output]);
                }

        switch ($currentstep) {
                 
            case '1':
                $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                            <h1 class="instruction">Printing STD Bag Sticker </h1>
                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/printer.png" style="width:200px; height:200px; display: block;
                            margin: 20px auto;"/>
                        </div>
                    </div>';
                break;
                
            case '2':
				
				        $apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/closeRSKEY';


        $client = new Client([
        'verify' => false,
        ]);


        $responses = $client->get($apiEndpoint);
				
                $apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/runRSKEY';


                $client = new Client([
                'verify' => false,
                ]);
            
                $responses = $client->get($apiEndpoint);

                $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                            <h1 class="instruction">Please weight the Small Bag</h1>
                        </div>
                    </div>
                    </div>
                    <textarea type="text" name="weight-input1" id="weight-input1" style="opacity: 0;
                    position: absolute;"   autofocus autocomplete="off"></textarea>
        
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="outputweight">0 <sub class="tinytext">KG</sub></h1>
                        </div>
                    </div>';
                break;
        
            case '3':
                $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                            <h1 class="instruction">Press <b style="color:green;">Green</b> Button and Seal the Small Bag</h1>
                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/bpV2 GIF6.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                break;
        
            case '4':
                $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                            <h1 class="instruction">Please Scan Small Bag</h1>
                        </div>
                    </div>
                    </div>
                    <input type="text" name="qrcode" id="qrcode"  style="opacity: 0;
                    position: absolute;" autofocus autocomplete="off">
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/qr-code.png" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                break;
   
        
            case '5':
                $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                            <h1 class="instruction">Press <b style="color:green;">Green</b> Button and Seal the Standard Bag</h1>
                        </div>
                    </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/bpV2 GIF6.gif" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                break;
        
            case '6':
                $output = '<div class="row">
                    <div class="col-md-12">
                        <div>
                            <h1 class="instruction">Please Scan Std Bag</h1>
                        </div>
                    </div>
                    </div>
                    <input type="text" name="qrcode" id="qrcode"  style="opacity: 0;
                    position: absolute;" autofocus autocomplete="off">
        
                    <div class="row">
                        <div class="col-md-12">
                            <img src="../../OPRUPD/qr-code.png" style="width:300px; height:300px; display: block;
                            margin: 0 auto;"/>
                        </div>
                    </div>';
                break;
        
            default:
            $output = '<div class="row">
            <div class="col-md-12">
                <div>
                    <h1 class="instruction">ERROR! Contact BIS for further information</h1>
                </div>
            </div>
            </div>';
                break;
        }

        return response()->json([$data,$operator,$output]);
    }
    else{
        $macAddresses = shell_exec('getmac');
        $pattern = '/([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})/';
        preg_match($pattern, $macAddresses, $matches);
        //$currentPhysicalAddress = $matches[0];
        $currentPhysicalAddress = '00:00:5e:00:53:af';

        $device = DB::table('device')
        ->where('macaddress',$currentPhysicalAddress)
        ->first();

        if($device == ''){
            return response()->json([
                'type' => 'ERROR',
                'message' => "No device found for the following Mac Address: $currentPhysicalAddress. Please contact BIS for further action!"
             ]);
        }
        else{
            $output = '<div class="row">
            <div class="col-md-12">
                <div>
                    <h1 class="instruction">Press <b style="color:blue;">Blue</b> Button to Scan Operator QRCODE</h1>
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <img src="../../OPRUPD/bluebtn.png" style="width:300px; height:300px; display: block;
                    margin: 0 auto;"/>
                </div>
            </div>';

            return response()->json([
                'type' => 'SUCCESS',
                'ZONE' =>  $device->zone,
                'output' => $output,
             ]);
        }
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    function get_std($stockcode, $sonum, $seq)
    {
			 $qrmaster = DB::table('qrmaster')
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
             ->where('asgnto','=', auth()->user()->StaffID)
             ->where('seq','=', $seq)
				 ->where('trx_status','A')
             ->first();
			
             $moresolist = DB::table('moresolist')
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
             ->first();

             $solist = DB::table('solist')
             ->where('trxstatus','A')
             ->where('sonum','=', $sonum)
             ->first();

             $template =  DB::table('template')
             ->where('shipmark','=', $solist->shipmark)
             ->first();

          return view('QRMT-OPRUPD.printteststd',compact('qrmaster','moresolist','template','solist'));
    }

    function get_smb($stockcode, $sonum, $number)
    {
			 $qrmastersmb = DB::table('qrmastersmb')
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
             ->where('asgnto','=', auth()->user()->StaffID)
             ->where('number','=', $number)
             ->first();
			
             $moresolist = DB::table('moresolist')
             ->where('stockcode','=', $stockcode)
             ->where('sonum','=', $sonum)
             ->first();

             $solist = DB::table('solist')
             ->where('trxstatus','A')
             ->where('sonum','=', $sonum)
             ->first();

             $template =  DB::table('template')
             ->where('shipmark','=', $solist->shipmark)
             ->first();

          return view('QRMT-OPRUPD.printtestsmb',compact('qrmastersmb','moresolist','template','solist'));
    }

    public function printStdBagSticker(Request $request)
    {
        $filePath = public_path('Temp/std.pdf');
        File::delete($filePath);

        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();

		$apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/closeRSKEY';

        $client = new Client([
        'verify' => false,
        ]);

        $responses = $client->get($apiEndpoint);

        $apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/runRSKEY';


        $client = new Client([
        'verify' => false,
        ]);
	
        $responses = $client->get($apiEndpoint);
        

        $logs = new PRD_LOGS;
        $logs->LOG_TYPE = 'PRINT_STD';
        $logs->REF_ID = $trx->WO_ID;
        $logs->USER_ID = auth()->user()->id;
        $logs->PRD_ID = $trx->PRD_ID;
        $logs->STATUS = 1;
        $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
        $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
        $logs->save();



        $stockcode = $trx->STK_CODE;
        $sonum = $trx->SO_NO;
        $asgnto = auth()->user()->StaffID;
        $printseal_by = auth()->user()->name;
        $dt_printseal = Carbon::now();
        $seq = $trx->CURRENT_STD_BAG;
           
     
         DB::table('qrmaster')
         ->where('stockcode', '=', $stockcode)
         ->where('sonum', '=', $sonum)
         ->where('asgnto', '=', $asgnto)
         ->where('dt_printseal', '=', NULL)
         ->where('seq', $seq)
         ->update([
            'printseal_by'=>$printseal_by,
            'dt_printseal'=>$dt_printseal,
            'status'=>'ps'
        ]);

        $pdf = \App::make('dompdf.wrapper');
  
        $html = $this->get_std($stockcode, $sonum, $seq);

        $html = preg_replace('/>\s+</', "><", $html);

        $pdf->loadHTML($html);
        
        
        $pdf->save($filePath);

      
            $client = new Client();

 $apiEndpoint2 = 'http://plantm.tplinkdns.com:9001/api/v1/uploadSticker'; 
		
        $response = $client->post($apiEndpoint2, [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => 'std.pdf'
                ]
            ],
        ]);

        usleep(5000000); // 5,000,000 microseconds = 5 seconds

        $apiEndpoint3 = 'http://plantm.tplinkdns.com:9001/api/v1/closeAdobe';


        $client = new Client([
        'verify' => false,
        ]);


        $responses = $client->get($apiEndpoint3);
		


        //$command = "start /B AcroRd32.exe /N /T \"{$filePath}\"";
        //system($command);
		
		

        if($trx->SMB == 'Y'){
        PRD_TRX::where('PRD_ID',$request->id)->update([
        'STEP1' =>'step-done',
        'STEP2' => 'step-active',
        'CURRENTSTEP' => 2,
        'START_DATETIME' => Carbon::now()
        ]);
        }
        else{
        PRD_TRX::where('PRD_ID',$request->id)->update([
        'STEP1' =>'step-done',
        'STEP2' => 'step-skip',
        'STEP3' => 'step-skip',
        'STEP4' => 'step-skip',
        'STEP5' => 'step-active',
        'CURRENTSTEP' => 5,
        'START_DATETIME' => Carbon::now()
        ]);   
        }
		
        return response()->json(['code' => 1,'message' => 'PDF printed successfully']);
    


        }
   

      
            
    

    public function printSmallBagSticker(Request $request)
    {
        $filePath = public_path('Temp/small.pdf');
        File::delete($filePath);

        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();

        $logs = new PRD_LOGS;
        $logs->LOG_TYPE = 'PRINT_SEAL_SB';
        $logs->REF_ID = $trx->WO_ID;
        $logs->USER_ID = auth()->user()->id;
        $logs->PRD_ID = $trx->PRD_ID;
        $logs->STATUS = 0;
        $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
        $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
        $logs->WEIGHT = $request->weight;
        $logs->UNIT = $request->unit;
        $logs->save();

        $stockcode = $trx->STK_CODE;
        $sonum = $trx->SO_NO;
        $asgnto = auth()->user()->StaffID;
        $printseal_by = auth()->user()->name;
        $dt_printseal = Carbon::now();
        $seq = $trx->CURRENT_STD_BAG;
           
     
        DB::table('qrmastersmb')
        ->orderBy('number', 'ASC')
        ->where('stockcode', '=', $stockcode)
        ->where('sonum', '=', $sonum)
        ->where('asgnto', '=', $asgnto)
        ->where('dt_printseal', '=', NULL)
        ->where('number',$trx->NUMBER)
        ->update([
            'printseal_by'=>$printseal_by,
            'dt_printseal'=>$dt_printseal]);

        $pdf = \App::make('dompdf.wrapper');
  
        $html = $this->get_smb($stockcode, $sonum, $trx->NUMBER);

        $html = preg_replace('/>\s+</', "><", $html);

        $pdf->loadHTML($html);
        
        
        $pdf->save($filePath);

        $client = new Client();

        $apiEndpoint2 = 'http://plantm.tplinkdns.com:9001/api/v1/uploadSticker'; 
               
        $response = $client->post($apiEndpoint2, [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($filePath, 'r'),
                    'filename' => 'small.pdf'
                ]
            ],
        ]);

        $apiEndpoint3 = 'http://plantm.tplinkdns.com:9001/api/v1/closeAdobe';


        $client = new Client([
        'verify' => false,
        ]);


        $responses = $client->get($apiEndpoint3);

         PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP3' =>'step-done',
            'STEP4' => 'step-active',
            'CURRENTSTEP' => 4,
         ]);



         
    
         
        return response()->json(['message' => 'PDF printed successfully']);
    }

    public function weightsmallbag(Request $request){

        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();




        if (empty($request->weight) || !is_numeric($request->weight)) {

        return response()->json(['type' => 'error','message' => 'Error! Please try again!']);

        }else{
		
		
        //getstdweight
        $moresolist = DB::table('moresolist')
        ->where('sonum',$trx->SO_NO)
        ->where('stockcode',$trx->STK_CODE)
        ->first();

        $getkgnos = DB::connection('mysqlSM')
        ->table('STK_MST')
        ->where('STK_CODE',$trx->STK_CODE)
        ->first();

       $standardweight = ($moresolist->psmb * $getkgnos->STK_WEIGHT) * 1000;
        
        
        $gettolerance = DB::connection('mysqlPM')
		->table('TD_SETTING')
        ->where('TD_TYPE','WEIGHT')
        ->where('TD_RANGE_FROM','>=',$standardweight)
        ->first();
			
			
if($gettolerance == ''){
	    $tolerance = DB::connection('mysqlPM')
		->table('TD_SETTING')
        ->where('TD_TYPE','WEIGHT')
        ->where('TD_RANGE_TO','>=',$standardweight)
        ->first();
}
			else{
				 $tolerance = $gettolerance;
			}
			
			
		if($tolerance == ''){
		return response()->json(['type' => 'error','message' => "Unable to get Tolerance!"]);
		exit();
		}

        $outputweight = $request->weight * 1000;

        $weighttolerance = $outputweight - $standardweight;
        //getStandardWeightChecking

	
        if ($weighttolerance < $tolerance->TD_DIFF_MINUS || $weighttolerance > $tolerance->TD_DIFF_PLUS) {
            $exception = 1;
        } else {
            $exception = 0;
        }
		
			
			//$exception = 0;

        Log::info('Weight tolerance check', [
            'moresolist' => $moresolist,
            'standardweight' => $standardweight,
           'tolerance' => $tolerance,
           'outputweight' => $outputweight,
           'weighttolerance' => $weighttolerance,
           'exception' => $exception,
           'trx' => $trx
        ]);

        //STK_WEIGHT
        //STANDARD WEIGHT
        //TOLERANCEWEIGHT
        //TD_DIFF_MINUS
        //TD_DIFF_PLUS

    

        $logs = new PRD_LOGS;
        $logs->LOG_TYPE = 'WEIGHT_SB';
        $logs->REF_ID = $trx->WO_ID;
        $logs->USER_ID = auth()->user()->id;
        $logs->PRD_ID = $trx->PRD_ID;
        $logs->STATUS = 0;
        $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
        $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
        $logs->WEIGHT = $request->weight;
        $logs->UNIT = $request->unit;
        $logs->STK_WEIGHT = $getkgnos->STK_WEIGHT;
        $logs->STD_WEIGHT = $standardweight;
        $logs->TOLERANCE_WEIGHT = $weighttolerance;
        $logs->TD_DIFF_MINUS = $tolerance->TD_DIFF_MINUS;
        $logs->TD_DIFF_PLUS = $tolerance->TD_DIFF_PLUS;
        $logs->save();

        if($exception == 0){

        PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP2' =>'step-done',
            'STEP3' => 'step-active',
            'CURRENTSTEP' => 3,
         ]);
        }
        else{
        PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP2' =>'step-pending',
            'STEP3' => 'step-todo',
            'CURRENTSTEP' => 7,
            'EXCEPTION' => 1,
            'EXCEPTION_STATUS' => 0
            ]);
        }

        $apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/closeRSKEY';


        $client = new Client([
        'verify' => false,
        ]);


        $responses = $client->get($apiEndpoint);


		
         return response()->json(['type' => 'success',
         'message' => 'Weight Success']);
        }

    }


    public function requestSupervisor(Request $request){

        $type = $request->type;

        if($type == 1){
        $trx = PRD_LOGS::where('PRD_ID',$request->id)
        ->where('LOG_TYPE','WEIGHT_SB')
        ->latest()
        ->first();

        $exp = new PRD_EXCEPTION_REQUEST;
        $exp->PRD_ID = $request->id;
        $exp->EXCEPTION_TYPE = 'WEIGHT TOLERANCE';
        $exp->OPER_ID = auth()->user()->id;
        $exp->WEIGHT = $trx->WEIGHT;
        $exp->UNIT = $trx->UNIT;
        $exp->STATUS = 'P';
        $exp->STK_WEIGHT = $trx->STK_WEIGHT;
        $exp->STD_WEIGHT = $trx->STD_WEIGHT;
        $exp->TOLERANCE_WEIGHT = $trx->TOLERANCE_WEIGHT;
        $exp->TD_DIFF_MINUS =$trx->TD_DIFF_MINUS;
        $exp->TD_DIFF_PLUS =$trx->TD_DIFF_PLUS;
        $exp->CREATED_AT = Carbon::now();
        $exp->CREATED_BY = auth()->user()->id;
        $exp->UPDATED_AT = Carbon::now();
        $exp->UPDATED_BY = auth()->user()->id;
        $exp->save();

        
        PRD_TRX::where('PRD_ID',$request->id)->update([
        'STEP2' =>'step-pending',
        'STEP3' => 'step-todo',
        'CURRENTSTEP' => 7,
        'EXCEPTION' => 1,
        'EXCEPTION_STATUS' => 1,
        'PRD_STATUS' => 'S'
        ]);
        

        return response()->json(['message' => 'Request has been sent to supervisor!']);
        }
        else if($type == 2){
            $trx = PRD_LOGS::where('PRD_ID',$request->id)
            ->where('LOG_TYPE','SCAN_SB')
            ->latest()
            ->first();
            
            $exp = new PRD_EXCEPTION_REQUEST;
            $exp->PRD_ID = $request->id;
            $exp->EXCEPTION_TYPE = 'SCAN SB TOLERANCE';
            $exp->OPER_ID = auth()->user()->id;
            $exp->STATUS = 'P';
            $exp->SCANNED_QRCODE = $trx->SCANNED_QRCODE;
            $exp->CREATED_AT = Carbon::now();
            $exp->CREATED_BY = auth()->user()->id;
            $exp->UPDATED_AT = Carbon::now();
            $exp->UPDATED_BY = auth()->user()->id;
            $exp->save();
    
            PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP3' =>'step-done',
            'STEP4' => 'step-pending',
            'CURRENTSTEP' => 8,
            'EXCEPTION' => 2,
            'EXCEPTION_STATUS' => 1,
            'PRD_STATUS' => 'S'
            ]);
    
            return response()->json(['message' => 'Request has been sent to supervisor!']); 
        }
        else if($type == 3){
            $trx = PRD_LOGS::where('PRD_ID',$request->id)
            ->where('LOG_TYPE','SCAN_STD')
            ->latest()
            ->first();
            
            $exp = new PRD_EXCEPTION_REQUEST;
            $exp->PRD_ID = $request->id;
            $exp->EXCEPTION_TYPE = 'SCAN STD TOLERANCE';
            $exp->OPER_ID = auth()->user()->id;
            $exp->STATUS = 'P';
            $exp->SCANNED_QRCODE = $trx->SCANNED_QRCODE;
            $exp->CREATED_AT = Carbon::now();
            $exp->CREATED_BY = auth()->user()->id;
            $exp->UPDATED_AT = Carbon::now();
            $exp->UPDATED_BY = auth()->user()->id;
            $exp->save();
    
            PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP6' => 'step-pending',
            'CURRENTSTEP' => 9,
            'EXCEPTION' => 3,
            'EXCEPTION_STATUS' => 1,
            'PRD_STATUS' => 'S'
            ]);
    
            return response()->json(['message' => 'Request has been sent to supervisor!']); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sealSmallBag(Request $request)
    {

        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();

        $logs = new PRD_LOGS;
        $logs->LOG_TYPE = 'SEAL_SB';
        $logs->REF_ID = $trx->WO_ID;
        $logs->USER_ID = auth()->user()->id;
        $logs->PRD_ID = $trx->PRD_ID;
        $logs->STATUS = 0;
        $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
        $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
        $logs->save();

        PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP3' =>'step-done',
            'STEP4' => 'step-active',
            'CURRENTSTEP' => 4,
         ]);

         return response()->json(['message' => 'Sealed small bag']);
        
    }


    public function scanSmallBag(Request $request)
    {
        $qrsmb_chk = DB::table('qrmastersmb')->where('qrcode','=', $request->qrcode)->count();//chk exist or not

        if ($qrsmb_chk == 0) {
            return response()->json(['type' =>'error','message' => 'Invalid qrcode','qrcode'=>$request->qrcode]);
        }

        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();

        $qrsmb_chk2 = DB::table('qrmastersmb')->where('qrcode','=', $request->qrcode)
        ->where('sonum',$trx->SO_NO)
        ->where('stockcode',$trx->STK_CODE)
        ->where('number',$trx->NUMBER)
        ->where('asgnto',auth()->user()->StaffID)
        ->count();
 
        if ($qrsmb_chk2 == 0) {
        return response()->json(['type' =>'error','message' => 'QR code not valid']);
        }

        $checkIfAlreadyScanned =
        DB::table('qrmastersmb')
        ->where('dt_opscancomplete', '=', NULL)
        ->where('qrcode', $request->qrcode)
        ->whereNotNull('dt_opscancomplete')
        ->count();
        
        if($checkIfAlreadyScanned > 0){
        return response()->json(['type' =>'error','message' => 'This Small Bag Already Scanned!']);
        }
        else{
        $exception = 0;



        ## CHECK ALREADY SCANNED ##
        DB::table('qrmastersmb')
        ->where('dt_opscancomplete', '=', NULL)
        ->where('qrcode', $request->qrcode)
        ->update([
            'dt_opscancomplete' => now()
        ]);

     
			
            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'SCAN_SB';
            $logs->REF_ID = $trx->WO_ID;
            $logs->USER_ID = auth()->user()->id;
            $logs->PRD_ID = $trx->PRD_ID;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
            $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
            $logs->SCANNED_QRCODE =  $request->qrcode;
            $logs->save();

            if($exception == 0){
			

            $moresolist = DB::table('moresolist')
            //->where('asgnto',auth()->user()->StaffID)
            ->where('sonum',$trx->SO_NO)
            ->where('stockcode',$trx->STK_CODE)
            ->first();

            //update next seq
            $getNextSeq = DB::table('qrmastersmb')
            ->where('asgnto',auth()->user()->StaffID)
            ->where('deviceId',$trx->DEVICE)
            ->where('sonum',$trx->SO_NO)
            ->where('stockcode',$trx->STK_CODE)
            ->where('dt_printseal', '=', NULL)
            ->orderBy('number')
            ->first();

            if($getNextSeq != ''){
                $nextseq = $getNextSeq->number;
            }
            else{
                $nextseq = $trx->NUMBER;
            }

            if ($moresolist) { //check if got row match 

                $loose = $moresolist->total;

                if ($loose != floor($loose)) {
                    $loose = ceil($loose);
                }

                //checktotalscanned
                $remainingsmallbag = DB::table('qrmastersmb')
                ->where('asgnto',auth()->user()->StaffID)
                ->where('deviceId',$trx->DEVICE)
                ->where('sonum',$trx->SO_NO)
                ->where('stockcode',$trx->STK_CODE)
                ->whereNull('dt_opscancomplete')
                ->count();

                if($trx->CURRENT_SMALL_BAG == $moresolist->ttlpsmb){

        
                    PRD_TRX::where('PRD_ID',$request->id)->update([
                        'CURRENT_SMALL_BAG' => 1,
                        'NUMBER' => $nextseq,
                        'STEP4' =>'step-done',
                        'STEP5' => 'step-active',
                        'CURRENTSTEP' => 5,
                    ]);
             
						
                }
                else if($remainingsmallbag == 0){
                   

                           
                    PRD_TRX::where('PRD_ID',$request->id)->update([
                        'STEP4' =>'step-done',
                        'STEP5' => 'step-active',
                        'CURRENTSTEP' => 5,
                    ]);
                  
                }
                else{
					
					
                  
                    PRD_TRX::where('PRD_ID',$request->id)->update([
                        'CURRENT_SMALL_BAG' => $trx->CURRENT_SMALL_BAG + 1,
                        'NUMBER' => $nextseq,
                        'STEP2' =>'step-active',
                        'STEP3' => 'step-todo',
                        'STEP4' => 'step-todo',
                        'CURRENTSTEP' => 2,
                    ]);
           
					
					/*

                    $apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/runRSKEY';


                    $client = new Client([
                    'verify' => false,
                    ]);
                
                    $responses = $client->get($apiEndpoint);
					*/
                }

                return response()->json(['type' =>'success','message' => 'Successfully Scanned small bag']);
                }
                
            
        

            else{
                return response()->json(['type' =>'error','message' => 'Data not found in Moresolist ! Please Contact BIS ']);
            }
        }
            else{
                //special steps for supervisor
                    
                
                PRD_TRX::where('PRD_ID',$request->id)->update([
                    'STEP3' =>'step-done',
                    'STEP4' => 'step-pending',
                    'CURRENTSTEP' => 9,
                    'EXCEPTION' => 2,
                    'EXCEPTION_STATUS' => 0,
                    'PRD_STATUS' => 'S'
                    ]);
                
    
                    return response()->json(['type' =>'info2','message' => 'Pending Supervisor Bypass!']);
                }
            
        }    
            

            return response()->json([
                'type' => 'success',
                'message' => 'Successfully Scanned!'
            ]);

        }

        
         //return response()->json(['message' => 'Scanned small bag']);
    

    public function sealStdBag(Request $request)
    {
        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();
        $logs = new PRD_LOGS;
        $logs->LOG_TYPE = 'SEAL_STD';
        $logs->REF_ID = $trx->WO_ID;
        $logs->USER_ID = auth()->user()->id;
        $logs->PRD_ID = $trx->PRD_ID;
        $logs->STATUS = 0;
        $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
        $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
        $logs->save();

        PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP5' =>'step-done',
            'STEP6' => 'step-active',
            'CURRENTSTEP' => 6,
         ]);

         return response()->json(['message' => 'Sealed std bag']);
        
    }

    public function scanStdBag(Request $request)
    {

        $trx = PRD_TRX::where('PRD_ID',$request->id)->first();

        $chkStdBag = DB::table('qrmaster')->where('qrcode',$request->qrcode)->count();
        
        if ($chkStdBag === 0) { //not exist

            return response()->json(['type' =>'error','message' => 'Invalid QRCODE']);
            // You can customize the error message and status code as needed
        }



        /** //chk sono,stockcode,sequence of std bag and asgnto = current staff id ,all value match with current expected process */
        $chkStdBag2 = DB::table('qrmaster')->where('qrcode','=', $request->qrcode)
        ->where('sonum',$trx->SO_NO)
        ->where('stockcode',$trx->STK_CODE)
        ->where('seq',$trx->CURRENT_STD_BAG)
        ->where('asgnto',auth()->user()->StaffID)
        ->where('deviceId',$trx->DEVICE)
        ->first();

        //return dd($qrsmb_chk2);
        if (!$chkStdBag2) { //not match with current flow
            return response()->json(['type' =>'error','message' => 'QR code not valid']);
            // You can customize the error message and status code as needed
        }

        DB::table('temp_check_comp')->where('QRCODE', $request->qrcode)->delete();
        
        $qrcode = $request->qrcode;
        $getdevice = DB::table("device")->where('deviceId',$trx->DEVICE)->first();
        $stockcode = $trx->STK_CODE;
        $division = $getdevice->division;
        $getsonum = $trx->SO_NO;
        $getwarehouse = $getdevice->warehouse_id;

        DB::select('CALL SP_CHECK_COMPONENT(?,?,?,?,?)',array($qrcode, $stockcode,$division,$getsonum,$getwarehouse));//check balance,if value >0 cannot proceed

        //$getdata = DB::table('temp_check_comp')->where('QRCODE',$request->qrcode)->count();
        $getdata = DB::table('temp_check_comp')->where('QRCODE',$request->qrcode)->get();

       
       if(count($getdata) > 0){
        return response()->json([
            'type' => 'BALANCE',
            'message' => $getdata
            ]);
        }

        DB::table('temp_check_control_scanning')
        ->where('PRDID',$trx->PRD_ID)
        ->where('SEQNUMBER',$trx->CURRENT_STD_BAG)
        ->delete();
		
	$currentDateTime = date("Y-m-d H:i:s");
		
     $parameters = [
    $trx->SO_NO,
    $trx->STK_CODE,
    $trx->WO_ID,
    $trx->PRD_ID,
    auth()->user()->StaffID,
    $trx->CURRENT_STD_BAG,
    $trx->NUMBER,
    $currentDateTime
];

DB::select('CALL SP_CHECK_CYCLETIME_CONTROL(?, ?, ?, ?, ?, ?, ?, ?)', $parameters);


        $checkCC = DB::table('temp_check_control_scanning')->where('PRDID',$trx->PRD_ID)->where('SEQNUMBER',$trx->CURRENT_STD_BAG)->count();
	
		//$checkCC = 0;

       if($checkCC > 0){
        $exception = 1;
       }
        else{
        $exception = 0;
       }
		

       if($exception == 0) {

        $data= array('sequence'=>$chkStdBag2->seq,'qrcodesb'=>$chkStdBag2->qrcode);

        $updateSmallBg = DB::table('qrmastersmb')
        ->whereNotNull('dt_opscancomplete')
        ->where('stockcode',$chkStdBag2->stockcode)
        ->where('sonum',$chkStdBag2->sonum)
        ->where('asgnto',$chkStdBag2->asgnto)
        ->whereNull('sequence')
        ->update($data);

        //$queries = DB::getQueryLog();
       ## update scan for std bag ##
       if($updateSmallBg >0 ||  $trx->SMB == 'N'){
        
        $data2 = array('status'=>'oc','dt_opscancomplete'=>now());

        $affectedRows = DB::table('qrmaster')
        ->whereNull('dt_opscancomplete')
        ->where('qrcode', $request->qrcode)
        ->where('sonum',$trx->SO_NO)
        ->where('stockcode',$trx->STK_CODE)
        ->where('seq',$trx->CURRENT_STD_BAG)
        ->update($data2);

        if($affectedRows >0){
            DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));//only all success then insert here
            //return response()->json(['type'=>'error','message' => 'Failed 6,Please contact BIS !','log'=>$affectedRows ]);

            $logs = new PRD_LOGS;
            $logs->LOG_TYPE = 'SCAN_STD';
            $logs->REF_ID = $trx->WO_ID;
            $logs->USER_ID = auth()->user()->id;
            $logs->PRD_ID = $trx->PRD_ID;
            $logs->STATUS = 0;
            $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
            $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
            $logs->SCANNED_QRCODE =  $qrcode;
            $logs->save();



            //update next seq
            $getNextSeq = DB::table('qrmaster')
            ->where('asgnto',auth()->user()->StaffID)
            ->where('deviceId',$trx->DEVICE)
            ->where('sonum',$trx->SO_NO)
            ->where('stockcode',$trx->STK_CODE)
            ->where('dt_printseal', '=', NULL)
            ->where('dt_opscancomplete', '=', NULL)
			->where('trx_status','A')
            ->orderBy('id')
            ->first();
			
			//totalscannedqty
			$moresolist = DB::table('moresolist')
				->where('sonum',$trx->SO_NO)
				->where('stockcode',$trx->STK_CODE)
				->first();

			$currentScannedSmallBag = PRD_LOGS::where('PRD_ID',$request->id)
				->where('LOG_TYPE','SCAN_SB')
				->where('STATUS','0')
				->count();

			$totalScannedSmallBagQty = $currentScannedSmallBag != 0 ? $moresolist->psmb * $currentScannedSmallBag: 0;
			

            if($getNextSeq != '' && $totalScannedSmallBagQty < $trx->WO_QTY){
                PRD_TRX::where('PRD_ID',$request->id)->update([
                    'CURRENT_STD_BAG' => $getNextSeq->seq,
                    'STEP1' =>'step-active',
                    'STEP2' => 'step-todo',
                    'STEP3' =>'step-todo',
                    'STEP4' => 'step-todo',
                    'STEP5' =>'step-todo',
                    'STEP6' => 'step-todo',
                    'CURRENTSTEP' => 1,
                ]);

                return response()->json([
                    'type'=>'success',
                    'message' => 'Scanned Std bag']);
            }
            else{

            PRD_TRX::where('PRD_ID',$request->id)->update([
                'STEP1' =>'step-done',
                'STEP2' => 'step-done',
                'STEP3' =>'step-done',
                'STEP4' => 'step-done',
                'STEP5' =>'step-done',
                'STEP6' => 'step-done',
                'CURRENTSTEP' => 0,
                'PRD_STATUS' => 'C',
                'END_DATETIME' => Carbon::now()
                ]);

                $ActiveWO = PRD_TRX::where('OPER_STAFF_ID',auth()->user()->StaffID)
                ->where('PRD_STATUS','A')
                ->where('ZONE_ID',$trx->ZONE_ID)
                ->orderBy('PRD_SEQ_BY_OPER')
                ->first();

                if($ActiveWO != ''){
                    $prdid = $ActiveWO->PRD_ID;
                    $url = "operatorDash/$prdid";
                }
                else{
                    PRD_ACTIVE_OPERATORS::where('STAFF_ID',auth()->user()->StaffID)->where('ZONE',$trx->ZONE_ID)->delete();
                    $url = "operatorDash/-";
                }



                return response()->json([
                    'type'=>'info',
                    'message' => 'Operator Scan Complete for this Work Order!',
                    'url' => "/$url"
                ]);
				
            }
           



            }else{
            return response()->json(['type'=>'error','message' => 'Already Scanned Std bag']);
            }
            
       }else{

        return response()->json(['type'=>'error','message' => 'Failed,Please contact BIS ! QRMASTER SMB check updating sequence and qrcodesb']);
       }

    }else{

        $logs = new PRD_LOGS;
        $logs->LOG_TYPE = 'SCAN_STD';
        $logs->REF_ID = $trx->WO_ID;
        $logs->USER_ID = auth()->user()->id;
        $logs->PRD_ID = $trx->PRD_ID;
        $logs->STATUS = 0;
        $logs->CURRENT_STD_BAG = $trx->CURRENT_STD_BAG;
        $logs->CURRENT_SMALL_BAG = $trx->CURRENT_SMALL_BAG;
        $logs->SCANNED_QRCODE =  $qrcode;
        $logs->save();

        PRD_TRX::where('PRD_ID',$request->id)->update([
            'STEP1' =>'step-done',
            'STEP2' => 'step-done',
            'STEP3' =>'step-done',
            'STEP4' => 'step-done',
            'STEP5' =>'step-done',
            'STEP6' => 'step-pending',
            'CURRENTSTEP' => 9,
            'EXCEPTION' => 3,
            'EXCEPTION_STATUS' => 0,
            'PRD_STATUS' => 'S'
        ]);

    return response()->json(['type' =>'info2','message' => 'Pending Supervisor Bypass!']);
    }

	 
    }
   
        

    
    

    public function listbypass(Request $request){
       
        $status = $request->status ?? 'ANY';
      
        $list_bypass = PRD_EXCEPTION_REQUEST ::LEFTJOIN('PRD_TRX as C', 'PRD_EXCEPTION_REQUEST.PRD_ID', '=', 'C.PRD_ID')
        ->leftJoin('ierpPM.PRD_MAC_ZONE as PM', 'C.ZONE_ID', '=', 'PM.ZONE_ID')
        ->leftJoin('ierpPM.PRD_WO_HDR as WHDR', 'C.WO_ID', '=', 'WHDR.WO_ID')
        ->leftJoin('ierpadmin.machinedetails as m', 'WHDR.WO_MAC_ID', '=', 'm.machineNo')
        ->select('PRD_EXCEPTION_REQUEST.*', 'C.*', 'PRD_EXCEPTION_REQUEST.ID as EXCEPTION_ID','PM.ZONE_NAME', 'WHDR.WO_MAC_ID as machineID', 'm.name as machineName','PRD_EXCEPTION_REQUEST.CREATED_AT as Createdate')
        ->when($status != 'ANY', function ($query) use ($status) {
            return $query->where('PRD_EXCEPTION_REQUEST.STATUS', $status);
            })
        ->orderBy('PRD_EXCEPTION_REQUEST.UPDATED_AT','DESC')
        ->get();
        //return dd($list_bypass);     

        
        return view('BS.bypassWO',compact('list_bypass','status'));
    }

    public function bypassApproval(Request $request){   

        //return dd($request->all());
        if($request->BYPASS_TRANSFER == 'A') {$display="approved";}else{$display="reject";}
        
        /** ALL CASE DEFAULT APPROVED */
        $UPDATE = PRD_EXCEPTION_REQUEST::where('ID',$request->BYPASS_ID)->update([
            'STATUS' => $request->BYPASS_TRANSFER,
            'REMARKS' =>  $request->BYPASS_REMARKS,
			'STK_WEIGHT_NEW' =>  $request->STK_WEIGHT,
            'BYPASSED_AT' => now(), 
            'BYPASSED_BY' => auth()->user()->id,
        ]);

        $UPDATE2 = PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
            'EXCEPTION' => '0',
            'EXCEPTION_STATUS' => '0',
        ]);

        $trx =  PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->first();

        if($UPDATE2){

            if($request->BYPASS_TYPE == 'WEIGHT TOLERANCE'){

                DB::connection('mysqlSM')
                ->table('STK_MST')
                ->where('STK_CODE',$trx->STK_CODE)
                ->update([
                    'STK_WEIGHT' => $request->STK_WEIGHT
                ]);

            }

            PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->where('CURRENTSTEP','!=','0')->update([
                'PRD_STATUS' => 'A',
                'UPDATED_AT' => now(), // assuming you want to update with the current timestamp
            ]);
        }

        /**switch ($request->BYPASS_TYPE) {

            case 'WEIGHT TOLERANCE': //weight case

            $UPDATE = PRD_EXCEPTION_REQUEST::where('ID',$request->BYPASS_ID)->update([
                    'STATUS' => $request->BYPASS_TRANSFER,
                    'REMARKS' =>  $request->BYPASS_REMARKS,
                    'BYPASSED_AT' => now(), // assuming you want to update with the current timestamp
                    'BYPASSED_BY' => auth()->user()->id,
            ]);

            $UPDATE2 = PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
                'EXCEPTION' => '0',
                'EXCEPTION_STATUS' => '0',
            ]);

            if($UPDATE2){

                PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
                    'PRD_STATUS' => 'A',
                    'UPDATED_AT' => now(), // assuming you want to update with the current timestamp
                ]);
            }

            break;
    
            
            case 'SCAN SB TOLERANCE': //small bag case
            
            $UPDATE = PRD_EXCEPTION_REQUEST::where('ID',$request->BYPASS_ID)->update([
                    'STATUS' => $request->BYPASS_TRANSFER,
                    'REMARKS' =>  $request->BYPASS_REMARKS,
                    'BYPASSED_AT' => now(), // assuming you want to update with the current timestamp
                    'BYPASSED_BY' => auth()->user()->id,
            ]);

            $UPDATE2 = PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
                'EXCEPTION' => '0',
                'EXCEPTION_STATUS' => '0',
            ]);

            if($UPDATE2){

                PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
                    'PRD_STATUS' => 'A',
                    'UPDATED_AT' => now(), // assuming you want to update with the current timestamp
                ]);
            }
            break;

            case 'SCAN STD TOLERANCE': // standard bag

                
                $UPDATE = PRD_EXCEPTION_REQUEST::where('ID',$request->BYPASS_ID)->update([
                    'STATUS' => 'A',
                    'REMARKS' =>  $request->BYPASS_REMARKS,
                    'BYPASSED_AT' => now(), // assuming you want to update with the current timestamp
                    'BYPASSED_BY' => auth()->user()->id,
                ]);

                $UPDATE2 = PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
                    'EXCEPTION' => '0',
                    'EXCEPTION_STATUS' => '0',
                ]);

                if($UPDATE2){

                    PRD_TRX::where('PRD_ID',$request->BYPASS_PRD_ID)->update([
                        'PRD_STATUS' => 'A',
                        'UPDATED_AT' => now(), // assuming you want to update with the current timestamp
                    ]);
                }

            break;

            default:

            return redirect("/listbypass")->with('error', "Something Missing,Please contact BIS !")->with('status', 'error');

            break;
             
        }**/

        if($UPDATE2){
            return redirect("/listbypass")->with('success', "Success ".$display." tolerance !")->with('status', 'success');

        }else{
            return redirect("/listbypass")->with('error', "Approval process failed !")->with('status', 'error');
        }
    

    }

    public function switch_wo(Request $request){   

        //$list_op = DB::table('users')->where('dept','4')->whereIn('role',['16','27','30','25'])->where('location',auth()->user()->location)->where('status','A')->orderBy("fname")->get();
        /** LIST OF OPERATOR IN PRD_TRX */
        $operator = $request->operator ?? '';

        $list_op = PRD_TRX::leftJoin('users', 'PRD_TRX.OPER_STAFF_ID', '=',DB::raw('users.StaffID COLLATE utf8_unicode_ci'))
        ->where('PRD_STATUS', '!=', 'C')
        ->groupBy('PRD_TRX.OPER_STAFF_ID', 'users.fname')
        ->select('PRD_TRX.OPER_STAFF_ID', DB::raw('UPPER(users.fname) AS OPER_NAME'))
        ->get();

        if($operator !=''){
        $list_bypass = PRD_TRX :: leftJoin('ierpPM.PRD_MAC_ZONE as PM', 'PRD_TRX.ZONE_ID', '=', 'PM.ZONE_ID')
        ->leftJoin('ierpPM.PRD_WO_HDR as WHDR', 'PRD_TRX.WO_ID', '=', 'WHDR.WO_ID')
        ->leftJoin('ierpadmin.machinedetails as m', 'WHDR.WO_MAC_ID', '=', 'm.machineNo')
        ->select('PRD_TRX.*','PM.ZONE_NAME', 'WHDR.WO_MAC_ID as machineID', 'm.name as machineName')
        ->when($operator != '', function ($query) use ($operator) {
            return $query->where('PRD_TRX.OPER_STAFF_ID', $operator);
            })
        ->whereIn('PRD_TRX.PRD_STATUS',['A','S']) //DISPLAY ALL BUT HIDE COMPLETE TO CLCULATE SEQ
        ->orderBy('PRD_TRX.PRD_SEQ_BY_OPER')//ORDER BY ASCENDING
        ->get();
        //dd($operator);
        return view('BS.switch_wo',compact('list_op','list_bypass','operator'));
        }else{
            //return back()->with('error', 'Please select Operator!')->with('status', 'error');

            $list_bypass ="";
            return view('BS.switch_wo',compact('list_op','list_bypass','operator'));

        }

       
        //return dd($list_op);
        
    }

    public function switch_wo_seq(Request $request){

        $seqs = $request->seq;
        $reorderData = $request->input('reorderData');
        $successCount = 0;

        foreach ($reorderData as $data) {

            $seq = $data['seq'];
            $id = $data['id'];
            $wo_id = $data['wo_id'];

            $update= PRD_TRX::where('ID', $id)->update([
                'PRD_SEQ_BY_OPER' => $seq,'UPDATED_AT' => NOW(),]);
                 $successCount++;
        }

       
         if ($successCount == count($reorderData)) {
            //return response()->json(['statusCode'=>'success','message' => 'Success change sequence W0 !'])->with('status', 'error');
            return response()->json(['type'=>'success','message' => 'Success change sequence Work Order !']);
        }else{
            return response()->json(['type'=>'error','message' => 'Failed,Please contact BIS !']);
            //return response()->json(['statusCode'=>'error','message' => 'Failed switch WO,please contact BIS!'])->with('status', 'error');
        }
    }

    public function activate_wo(Request $request){

        $id = $request->input('id');
        $status = $request->input('status');

        $update= PRD_TRX::where('ID', $request->id)
			->where('CURRENTSTEP','!=','0')
			->update(['PRD_STATUS' =>  $status,'UPDATED_AT' => NOW(),]);

        if($update){
        return response()->json(['type'=>'success','message' => 'Success update status !']);
        }else{
            return response()->json(['type'=>'error','message' => 'Failed update status !',]); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function checkComponent(Request $request)
    {
        $getdevice = DB::table("device")->where('deviceId',$request->device)->first();

        $stockcode = $request->stockcode;
        $division = $getdevice->division;
        $getsonum = $request->sonum;
        $getwarehouse = $getdevice->warehouse_id;

        DB::table('temp_check_comp_assign')
        ->where('SONUM',$getsonum)
        ->where('STKCODE',$stockcode)
        ->delete();

        DB::select('CALL SP_CHECK_COMPONENT_ASSIGN(?,?,?,?)',array($stockcode,$division,$getsonum,$getwarehouse));

        $getdata = DB::table('temp_check_comp_assign')
        ->where('SONUM',$getsonum)
        ->where('STKCODE',$stockcode)
        ->get();

        $getwo = DB::connection('mysqlPM')
        ->table('PRD_WO_HDR')
        ->whereIn('WO_STATUS',['A','I'])
        ->where('WO_SOUCE_ID',$getsonum)
        ->where('WO_STK_FG_NO',$stockcode)
        ->get();

        if(count($getwo) <= 0){
            return response()->json([
                'type' => 'WO',
                'message' => ''
                ]);
        }
       else if(count($getdata) > 0){
        return response()->json([
            'type' => 'BALANCE',
            'message' => $getdata
            ]);
        }
        else{
        return response()->json([
            'type' => 'success',
            'message' => $division
            ]);
        }
        }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}