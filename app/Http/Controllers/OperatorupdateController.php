<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Notifications\NewLessonNotification;
use App\Lesson;
use Carbon\Carbon;
use App\User;
class OperatorupdateController extends Controller {
    
public function show($id) {
$list2 = DB::select('select * from moresolist where id = ?',[$id]);
$lists3 = DB::select('select * from users');
$lists3 = DB::table('users')->where('location', '=', auth()->user()->location)->get();
return view('BS.editform',['list2'=>$list2, 'lists3'=>$lists3]);
}

public function edit(Request $request,$id) {
$name = $request->input('name');
DB::update('update moresolist set name = ? where id = ?',[$name,$id]);
return redirect()->back();
}

public function insert(Request $request){
	
	
	$start1 = $request->input('start');
    $start = strtok($start1, '.');
	$end1 = $request->input('end');
    $end = strtok($end1, '.');
	$sototal1 = $request->input('sototal');
    $sototal = strtok($sototal1, '.');
	
	$custom = $request->input('custom');
	
    if($request->input('asgnto') !="" && $request->input('deviceId') !=""){
    $asgnto = $request->input('asgnto');
    $sonum = $request->input('sonum');
    $opasgn_by = $request->input('opasgn_by');
    $stockcode = $request->input('stockcode');
    $total = $request->input('total');
    $lesson = new Lesson;
    $lesson->user_id = auth()->user()->id;
    $lesson->title = $opasgn_by;
    $lesson->body = 'New Task '.$sonum.', '.$stockcode;
    $lesson->save();
    $user = User::where('staffId','=', $asgnto)->get();
    if(\Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first())))
    {
        return back();
    }
    //$checkexist = DB::table('qrmaster')->where('sonum',$sonum)->where('stockcode',$stockcode)->where('asgnto',$asgnto)->count();
	$checkexist = 	DB::table('qrmaster')->where('sonum',$sonum)->where('stockcode',$stockcode)->count();
	if($checkexist <= 0){
		
    $quantity = $request->input('quantity');
    $pbag = $request->input('pbag');
    $var = ($quantity %  $pbag);
    if ($var == 0){
       
    $sonum = $request->input('sonum');
    $pbag = $request->input('pbag');
    $opasgn_by = $request->input('opasgn_by');
    $asgnto = $request->input('asgnto');
    $status = $request->input('status');
    $status2 = $request->input('status2');
    $status3 = $request->input('status3');
    $socreated_by = $request->input('socreated_by');
    $dt_socreated = Carbon::now();
    $dt_opasgn = Carbon::now();
    $stockcode = $request->input('stockcode');
    $ttlsmb = $request->input('ttlsmb');
    $psmb = $request->input('psmb');
    $deviceId = $request->input('deviceId');
    $dev=array('deviceId'=>$deviceId);
    DB::table('userqr')->where("staffId", "=", $asgnto)->update($dev);
     $data = [];
		
		if($custom == 'YES'){
        for ($i=1; $i<=$total; $i++){
		
			
        $qrcode = ('QR'.$i.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);
			
		$result = $total - $i;
			
		if($i == 1){
		$sono = $start;
		}
		else{
		$sono = $end - $result;
		}
			
        
        $seq =($i.'/'.$total);

		$soTotalSeq = ($sono.'/'.$sototal);
		 
        $loca = DB::table('device')->where('deviceId','=', $deviceId)->get();
        foreach ($loca as $loca){
        $location = $loca->location;
        $data =array('location'=>$location,'deviceId'=>$deviceId,'sonum'=>$sonum,"status"=>$status,"qrcode"=>$qrcode,"stockcode"=>$stockcode,"seq"=>$seq,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$pbag,"soTotalSeq"=>$soTotalSeq);
        $data3= array('status3'=>$status3);
		}
$collection = collect($data);   //turn data into collection
$chunks = $collection->chunk(100); //chunk into smaller pieces
$chunks->toArray(); //convert chunk to array
			foreach($chunks as $chunk)
{
		   DB::table('qrmaster')->insert($chunk->toArray());
 
}
        }
		}
		else{
		for ($i=1; $i<=$total; $i++){
			
        $qrcode = ('QR'.$i.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);
        
        $seq =($i.'/'.$total);
        $loca = DB::table('device')->where('deviceId','=', $deviceId)->get();
        foreach ($loca as $loca){
        $location = $loca->location;
        $data =array('location'=>$location,'deviceId'=>$deviceId,'sonum'=>$sonum,"status"=>$status,"qrcode"=>$qrcode,"stockcode"=>$stockcode,"seq"=>$seq,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$pbag);
        
        $data3= array('status3'=>$status3);
			
		}
$collection = collect($data);   //turn data into collection
$chunks = $collection->chunk(100); //chunk into smaller pieces
$chunks->toArray(); //convert chunk to array
			foreach($chunks as $chunk)
{
				 DB::table('qrmaster')->insert($chunk->toArray());
 
}
        }
		}
		$data2 = [];
		    for ($j=1; $j<=$ttlsmb; $j++){
            $qrcodesmb = ('QRSMB'.$j.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);
            $number = $j;
 $data2 =array('location'=>$location,'sonum'=>$sonum,'qrcode'=>$qrcodesmb,'stockcode'=>$stockcode,'asgnto'=>$asgnto,'number'=>$number,'psmb'=>$psmb, 'deviceId'=>$deviceId);
			
           $collection2 = collect($data2);   //turn data into collection
$chunks2 = $collection2->chunk(100); //chunk into smaller pieces
$chunks2->toArray(); //convert chunk to array

//loop through chunks:
foreach($chunks2 as $chunk2)
{
  DB::table('qrmastersmb')->insert($chunk2->toArray()); //insert chunked data
}
				
        }
		 
		if($deviceId == 'AZ2' || $deviceId == 'AZ1'){
		$scan_control = 'Y';
		}
		else{
		$scan_control = 'N';	
		}
		
$data4= array("asgnto"=>$asgnto,'stockcode'=>$stockcode,'status2'=>$status2,'status'=>$status,'scan_control'=> $scan_control);
		
		
		DB::table('moresolist')->where('stockcode', $stockcode)->where('sonum', $sonum)->where('quantity',$quantity)->update($data4);
		Session::flash('message','Update Sucessfully.');
}
    else{
        $sonum = $request->input('sonum');
        $pbag = $request->input('pbag');
        $opasgn_by = $request->input('opasgn_by');
        $asgnto = $request->input('asgnto');
        $status = $request->input('status');
        $status2 = $request->input('status2');
        $status3 = $request->input('status3');
        $socreated_by = $request->input('socreated_by');
        $dt_socreated = Carbon::now();
        $dt_opasgn = Carbon::now();
        $stockcode = $request->input('stockcode');
        $ttlsmb = $request->input('ttlsmb');
        $psmb = $request->input('psmb');
        $deviceId = $request->input('deviceId');
        $dev=array('deviceId'=>$deviceId);
		  $var2 = ($quantity %  $pbag);
        DB::table('userqr')->where("staffId", "=", $asgnto)->update($dev);
		 for ($i=1; $i<1; $i++){
            $qrcode2 = ('QR'.$total.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);
          
            $seq2 =($total.'/'.$total);
            $data=array('location'=>$location,'sonum'=>$sonum,"deviceId"=>$deviceId,"status"=>$status,"qrcode"=>$qrcode2,"stockcode"=>$stockcode,"seq"=>$seq2,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$var2);
        DB::table('qrmaster')->insert($data);
        }
    
       $data = [];
        for ($i=1; $i<=$total; $i++){
			
        $qrcode = ('QR'.$i.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);
        
        $seq =($i.'/'.$total);
        $loca = DB::table('device')->where('deviceId','=', $deviceId)->get();
        foreach ($loca as $loca){
        $location = $loca->location;
		$var_acc = $quantity - (($pbag * $i) - $pbag);
		
		if($var_acc >= $pbag){
		$var5 = $pbag;
		}
		else{
		$var5 = $var2;
		}
			
        $data =array('location'=>$location,'deviceId'=>$deviceId,'sonum'=>$sonum,"status"=>$status,"qrcode"=>$qrcode,"stockcode"=>$stockcode,"seq"=>$seq,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$var5);
        
        $data3= array('status3'=>$status3);
		
       
			
		}
$collection = collect($data);   //turn data into collection
$chunks = $collection->chunk(100); //chunk into smaller pieces
$chunks->toArray(); //convert chunk to array
			foreach($chunks as $chunk)
{
				 DB::table('qrmaster')->insert($chunk->toArray());
 
}
        }
		$data2 = [];
		    /*for ($j=1; $j<=$ttlsmb; $j++){
            $qrcodesmb = ('QRSMB'.$j.'|'.rand(1000,9999).'-'.$sonum.'-'.$stockcode);
            $number = $j;
 array_push($data2,['sonum'=>$sonum,'qrcode'=>$qrcodesmb,'stockcode'=>$stockcode,'asgnto'=>$asgnto,'number'=>$number,'psmb'=>$psmb, 'deviceId'=>$deviceId]);        
        }*/
		 for ($j = 1; $j <= $ttlsmb; $j++) {
                    $qrcodesmb = ('QRSMB' . $j . '|' . rand(1000, 9999) . '-' . $sonum . '-' . $stockcode);
                    $number = $j;
                    if($j == $ttlsmb){
                        $psmb2 = $psmb;
                        $psmb = fmod($quantity, $psmb2);
						 if($psmb == 0){
                                 $psmb = $psmb2;
                            }
                    }
                    array_push($data2, ['location'=>$location,'sonum' => $sonum, 'qrcode' => $qrcodesmb, 'stockcode' => $stockcode, 'asgnto' => $asgnto, 'number' => $number, 'psmb' => $psmb, 'deviceId' => $deviceId]);
                }
		 $collection2 = collect($data2);   //turn data into collection
$chunks2 = $collection2->chunk(100); //chunk into smaller pieces
$chunks2->toArray(); //convert chunk to array

//loop through chunks:
foreach($chunks2 as $chunk2)
{
  DB::table('qrmastersmb')->insert($chunk2->toArray()); //insert chunked data
}
		
		if($deviceId == 'AZ2' || $deviceId == 'AZ1'){
		$scan_control = 'Y';
		}
		else{
		$scan_control = 'N';	
		}
		

		
		
		$data2= array("asgnto"=>$asgnto,'stockcode'=>$stockcode,'status2'=>$status2,'status'=>$status,'scan_control'=> $scan_control);
		DB::table('moresolist')->where('stockcode', $stockcode)->where('sonum', $sonum)->update($data2);
		Session::flash('message','Update Sucessfully.');
}
		}else{
    return redirect()->back();
}
}else{
    Session::flash('message','Please choose the Operator/Device!');
}

    return redirect()->back();
    }
}