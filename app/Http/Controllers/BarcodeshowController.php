<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use Carbon\Carbon;
class BarcodeshowController extends Controller
{
    public function index() {
        return view('BS.sodetail');
     }
    public function show($sonum) {
        $lists = DB::select('select * from solist where sonum = ?',[$sonum]);
        $lists2 =DB::table('moresolist')->where('sonum', '=', $sonum)->paginate(5);
        $lists3 = DB::table('users')->where('location', '=', auth()->user()->location)->where('dept', '=',"4")->get();
        $lists4 = DB::select('select * from solist where sonum = ?',[$sonum]);
        return view('BS.sodetail',['lists'=>$lists, 'lists2'=>$lists2, 'lists3'=>$lists3, 'lists4'=>$lists4]);
     }
     public function show2($sonum, $stockcode) {
      $lists = DB::select('select * from solist where sonum = ?',[$sonum]);
      $lists2 =DB::table('moresolist')->where('sonum', '=', $sonum)->paginate(5);
      $lists3 = DB::table('users')->where('location', '=', auth()->user()->location)->where('dept', '=',"4")->get();
      $lists4 = DB::select('select * from solist where sonum = ?',[$sonum]);
      return view('BS.sodetail',['lists'=>$lists, 'lists2'=>$lists2, 'lists3'=>$lists3, 'lists4'=>$lists4]);
   }
    
     public function retrieve($name) {
      $sticker = DB::table('qrmaster')
      ->distinct()
      ->get(['sonum','asgnto','status','stockcode'])
      ->where('asgnto', '=', $name)
      ->where('status', '=', 'ao') ;

      $sticker2 = DB::table('qrmastersmb')
      ->distinct()
      ->where('asgnto', '=', $name)
      ->where('dt_printseal', '=', NULL)
      ->get(['sonum','asgnto','stockcode']);
      
	  //dd($sticker);	
      return view('BS.print',['sticker'=>$sticker,'sticker2'=>$sticker2]);

     }
     public function reprint(Request $request) {
      
      $sonum = $request->input('sonum');
      $stockcode = $request->input('stockcode');

      //return dd($sonum,$stockcode);

      
      if($request->input('reprint') == 'std'){
         $prints = DB::table('qrmaster')
         ->orderByRaw('LENGTH(seq)', 'ASC')
         ->orderBy('seq', 'ASC')
         ->select(['stockcode','seq','asgnto'])
         ->where('sonum','=', $sonum)
         ->where('stockcode','=', $stockcode)
         ->whereNotNull('dt_printseal')
         ->paginate(10);

         $prints2 = DB::table('moresolist')
         ->where('sonum','=', $sonum)
         ->where('stockcode','=', $stockcode)
         ->get();
         
         return view('BS.reprintstckr',['prints'=>$prints, 'prints2'=>$prints2]);
   
      }else{
      $prints = DB::table('qrmastersmb')
      ->orderByRaw('LENGTH(number)', 'ASC')
      ->orderBy('number', 'ASC')
      ->select(['stockcode','number','asgnto'])
      ->where('sonum','=', $sonum)
      ->where('stockcode','=', $stockcode)
		->whereNotNull('dt_printseal')
      ->paginate(10);

      $prints2 = DB::table('moresolist')
      ->where('sonum','=', $sonum)
      ->where('stockcode','=', $stockcode)
      ->get();

      return view('BS.reprintstckrsmb',['prints'=>$prints, 'prints2'=>$prints2]);
      }
		 
      
   }
	   public function printsmb($stockcode, $sonum) {
      

   }
     public function update(Request $request,$stockcode) {
      $status = $request->input('status');
      $status2 = $request->input('status2');
      $asgnto = $request->input('asgnto');
      $printseal_by = $request->input('printseal_by');
      $dt_printseal = $request->input('dt_printseal');
      DB::update('update qrmaster set printseal_by = ?, dt_printseal = ?, status =? where stockcode = ? AND asgnto = ?',[$printseal_by,$dt_printseal,$status2,$stockcode,$asgnto]);
      DB::update('update moresolist set status = ? where stockcode = ?',[$status,$stockcode]);
      echo 'Successfully printed.<a href = "/BShome"> Click Here</a> to go back.';
   }
   public function update2(Request $request,$stockcode) {
      $status = $request->input('status');
      $reprintseal_by = $request->input('reprintseal_by');
      $dt_reprintseal = $request->input('dt_reprintseal');
      DB::update('update qrmaster set reprintseal_by = ?, dt_reprintseal = ? where stockcode = ?',[$reprintseal_by,$dt_reprintseal,$stockcode]);
      DB::update('update moresolist set status = ? where stockcode = ?',[$status,$stockcode]);
      echo 'Successfully printed.<a href = "/BShome"> Click Here</a> to go back.';
   }
   function updaterange(Request $request)
    {
      $stockcode = $request->input('stockcode');
      $deviceId = $request->input('deviceId');
	   $quantity10 = $request->input('quantity1');
      $quantity1 = $request->input('quantity1');
      $quantity2 = $request->input('quantity2');
      $var = $quantity1 - 1;
      $var3 = $quantity2 - $quantity1;
      $var2 = $quantity2 - $var;
      $var4 = $var3 +1;
      $sonum = $request->input('sonum');
      $asgnto = $request->input('asgnto');
      
      $show = DB::table('qrmaster')
      ->orderByRaw('LENGTH(seq)', 'ASC')
      ->orderBy('seq', 'ASC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag','dt_printseal','deviceId'])
      ->take($var2)
      ->skip($var)
      ->get();
      ['show'=>$show];
	   
	  $who4 = DB::table('qrmaster')
     ->where('stockcode','=', $stockcode)
     ->where('sonum','=', $sonum)
     ->where('asgnto','=',$asgnto)
     ->count();

      $show2 = DB::table('moresolist')
      ->where('stockcode', '=', $stockcode)
      ->where('sonum','=', $sonum)
      ->get();

      $pallet = DB::table('moresolist')
      ->where('stockcode', '=', $stockcode)
      ->where('sonum','=', $sonum)
      ->first();

      foreach ($show2 as $shows2){
      if($shows2->psmb == 0){
         $var5 = 0;
         $var6 = 0;
      }else{
         $var5 = ($shows2->pbag) / ($shows2->psmb);
         $var6 = $var4 * $var5;
      }
	  }
	   
	   if($quantity10 === '1'){
		 $valid = true;
	   }
	   else{
		  $valid = false;
	   }
	   
	   
        if($valid == true){
		 $seq1 = 1;
		 $seq2 = $quantity2 * $var5;
		}
	    else{
		 $seq1 = ($quantity1 - 1) * $var5 + 1;
		 $seq22 = $quantity2 * $var5;
		 $seq2 = $seq22;
		}

      if($pallet->uom2 != 'PALLET' && $pallet->smbAvailability != 'N'){
      
      /** ORIGINAL */
      /*DB::table('qrmastersmb')
      ->orderBy('number', 'DESC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->where('qrcodesb','=', NULL)
      ->where('sequence','=', NULL)
      ->where('printseal_by','=', NULL)
      ->where('dt_printseal','=', NULL)
      ->where('dt_opscancomplete','=', NULL)
	   ->where('number', '>=' ,$seq1)
      ->where('number', '<=' ,$seq2)
      ->update(['asgnto'=>$asgnto, 'reasgnto'=>"1"]);*/

      $sequece = ($seq2 - $seq1 +1)/$var5;
      
      $number ="";
        
      $sequece = $sequece *1;
      $block ="";
      $success =0;
      $successUp ="";
      for($i =1; $i <=$sequece;$i++){ //loop each sequence per standard bag
        
          /** check small bag of same standard bag already scan by other person,if not scanned yet allow reassign to other person */
         if($i ==1){
            $seq1 = $seq1;
            $seq2 = $seq1 +$var5 -1;
         }else{
            $seq1 =  $seq2+1;
            $seq2 = $seq1 +$var5 -1;
           
         }
         $chkSeq = DB::table('qrmastersmb')
         ->where('stockcode','=', $stockcode)
         ->where('sonum','=', $sonum)
         ->where('qrcodesb','=', NULL)
         ->where('sequence','=', NULL)
         ->whereNotNull('dt_opscancomplete')
         ->where('number', '>=' ,$seq1)
         ->where('number', '<=' ,$seq2)
         ->where('asgnto', '!=' ,$asgnto)->count();

         if($chkSeq === 0){
            
            $chkPrint = DB::table('qrmastersmb')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->where('qrcodesb','=', NULL)
            ->where('sequence','=', NULL)
            ->whereNotNull('dt_printseal')
            ->where('dt_opscancomplete','=', NULL)
            ->where('number', '>=' ,$seq1)
            ->where('number', '<=' ,$seq2)
            ->where('asgnto', '!=' ,$asgnto)->count();

            $addmessages= "";

            if($chkPrint >0){

                $addmessages =" <br> Kindly reprint the sticker as the assigned operator has changed.";
            }

            $update = DB::table('qrmastersmb')
            ->orderBy('number', 'DESC')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->where('qrcodesb','=', NULL)
            ->where('sequence','=', NULL)
            ->where('dt_opscancomplete','=', NULL)
            ->where('number', '>=' ,$seq1)
            ->where('number', '<=' ,$seq2)
            ->update(['asgnto'=>$asgnto, 'reasgnto'=>"1"]);
           
            $skip = ($seq2/$var5)-1;
           
            //if($update){ //comment coz if no rows affected,qrmaster not update same like above

               $show = DB::table('qrmaster')
               ->orderByRaw('LENGTH(seq)', 'ASC')
               ->orderBy('seq', 'ASC')
               ->where('stockcode','=', $stockcode)
               ->where('sonum','=', $sonum)
               ->select(['stockcode','seq','sonum','asgnto','qrcode','pbag','dt_printseal','deviceId'])
               ->take(1)
               ->skip($skip)
               ->get();
             
              
               foreach ($show as $shows)
               DB::table('qrmaster')
               ->where('qrcode','=', $shows->qrcode)
               ->take(1)
               ->update(['asgnto'=>$asgnto, 'deviceId'=>$deviceId,'opasgn_by' => auth()->user()->name, 'dt_opasgn' => Carbon::now()]);

               $numSq = $seq2/$var5;
              
               $successUp .= $numSq ."/".$var5.",";
               $success = 1;
            //}
           

         }else{
              
              $numSq = $seq2/$var5;
              $block .= $numSq ."/".$var5.",";

              
         }

      }
     
      
      if($success){
         $errorUp ="";
         if($block !=""){

            $errorUp = "<br> Failed Update: Reassign is not allowed for sequence ".$block."<br>Small bags already scanned by the assigned person.<br><br>Small bags in the same standard bag need to be scanned by the same person ! ";
            
         }
        
         Session::flash('INFO','Success update sequence '.$successUp.$errorUp.$addmessages);
        
      }else{

         Session::flash('Error','Reassign is not allowed for sequence '.$block."<br>Small bags already scanned by the assigned person.<br><br>Small bags in the same standard bag need to be scanned by the same person !");
        
      }

      return redirect()->back();

      }else{

         foreach ($show as $shows)
         DB::table('qrmaster')
         ->where('qrcode','=', $shows->qrcode)
         ->take($var2)
         ->update(['asgnto'=>$asgnto, 'deviceId'=>$deviceId,'opasgn_by' => auth()->user()->name, 'dt_opasgn' => Carbon::now()]);

         Session::flash('message','Update successfully.');
         return redirect()->back();
      }

        /** ORIGINAL */
      /*foreach ($show as $shows)
      DB::table('qrmaster')
      ->where('qrcode','=', $shows->qrcode)
      ->take($var2)
      ->update(['asgnto'=>$asgnto, 'deviceId'=>$deviceId,'opasgn_by' => auth()->user()->name, 'dt_opasgn' => Carbon::now()]);
      Session::flash('message','Update successfully.');

      return redirect()->back();*/
		 
    
}
    
    public function device(Request $request) {
		
	  $did = $request['deviceId'];
      $deviceId = $request->input('deviceId');
      $id = DB::table('device')->where('deviceId','=', $did )->get();
		
		$id2 = DB::table('device')->where('deviceId','=', $deviceId)->first();
      $devices = DB::table('userdevice')->where('deviceId','=', $deviceId)->get();
		
		$staffid = DB::table('userdevice')->where('deviceId','=', $deviceId)->pluck('StaffID');
		
		

   return view('BS.scan', compact('devices','id','id2','did','staffid','deviceId'));
   }
	
   public function device2(Request $request) {
      $deviceId = $request->input('deviceId');
      $StaffID = $request->input('name');
      $color = $request->input('color');
      $data= array('deviceId'=>$deviceId,'StaffID'=>$StaffID,'color'=>$color);
      DB::table('userdevice')->insert($data);
      return redirect()->back();    
   }
   public function device3(Request $request) {
    
      $StaffID = $request->input('StaffID');
      DB::delete('delete from userdevice where StaffID = ?',[$StaffID]);
      return redirect()->back();
   }
	
	function updaterangesmb(Request $request)
    {
      $stockcode = $request->input('stockcode');
      $deviceId = $request->input('deviceId');
	   $quantity10 = $request->input('quantity1');
      $quantity1 = $request->input('quantity1');
      $quantity2 = $request->input('quantity2');

      if($quantity1 == 1){
         $var = $quantity1;
      }else{
         $var = $quantity1 - 1;
      }
     
      $var3 = $quantity2 - $quantity1;
      $var2 = $quantity2 - $var;
      $var4 = $var3 +1;
      $sonum = $request->input('sonum');
      $asgnto = $request->input('asgnto');
      
      $show = DB::table('qrmastersmb')
      ->orderByRaw('LENGTH(number)', 'ASC')
      ->orderBy('number', 'ASC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->select(['stockcode','number','sonum','asgnto','qrcode','dt_printseal','deviceId'])
      ->take($var2)
      ->skip($var)
      ->get();
      ['show'=>$show];
	   
	  $who4 = DB::table('qrmastersmb')
     ->where('stockcode','=', $stockcode)
     ->where('sonum','=', $sonum)
     ->where('asgnto','=',$asgnto)
     ->count();

      $show2 = DB::table('moresolist')
      ->where('stockcode', '=', $stockcode)
      ->where('sonum','=', $sonum)
      ->get();

      foreach ($show2 as $shows2){
      if($shows2->psmb == 0){
         $var5 = 0;
         $var6 = 0;
      }else{
         $var5 = ($shows2->pbag) / ($shows2->psmb);
         $var6 = $var4 * $var5;
      }
	  }
	   
	   if($quantity10 === '1'){
		 $valid = true;
	   }
	   else{
		  $valid = false;
	   }
	   
	   
        if($valid == true){
		 $seq1 = 1;
		 $seq2 = $quantity2 * $var5;
		}
	    else{
		 $seq1 = ($quantity1 - 1) * $var5 + 1;
		 $seq22 = $quantity2 * $var5;
		 $seq2 = $seq22;
		}
		 

     DB::table('qrmastersmb')
      ->orderBy('number', 'DESC')
      ->where('stockcode','=', $stockcode)
      ->where('sonum','=', $sonum)
      ->where('qrcodesb','=', NULL)
      ->where('sequence','=', NULL)
      ->where('printseal_by','=', NULL)
      ->where('dt_printseal','=', NULL)
      ->where('dt_opscancomplete','=', NULL)
	   ->where('number', '>=' ,$quantity1)
      ->where('number', '<=' ,$quantity2)
      ->update(['asgnto'=>$asgnto]);
	

      foreach ($show as $shows)
      DB::table('qrmastersmb')
      ->where('qrcode','=', $shows->qrcode)
      ->take($var2)
      ->update(['asgnto'=>$asgnto]);
      Session::flash('message','Update successfully.');
      return redirect()->back();
}
   
}