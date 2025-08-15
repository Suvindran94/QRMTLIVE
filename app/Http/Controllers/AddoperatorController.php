<?php

namespace App\Http\Controllers;
use DB;
use Session;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AddoperatorController extends Controller
{
    public function index($stockcode, $sonum) {     
        $lists = DB::table('qrmaster')
		->orderBy('dt_opscancomplete', 'ASC')
        ->orderByRaw('LENGTH(seq)', 'ASC')
        ->orderBy('seq', 'ASC')
        ->select(['qrcode','stockcode','seq','asgnto','sonum','deviceId'])
        ->where('stockcode','=', $stockcode)
		->where('dt_qacheck','=',null)
         ->where('sonum','=', $sonum)
        ->paginate(10);
      
        $lists2 = DB::table('moresolist')->where('stockcode','=', $stockcode)->where('sonum','=', $sonum)->get();
        $lists3 = DB::table('users')->where('dept','=', '4')->where('location','=', auth()->user()->location)->where('status','A')->orderBy('StaffID')->get();
        return view('BS.addoperator',['lists'=>$lists,'lists2'=>$lists2,'lists3'=>$lists3]);
      
     }
	
    public function edit(Request $request) {

        if($request->input('asgnto') !=""){
            $asgnto = $request->input('asgnto');
            $stockcode = $request->input('stockcode');
			$sonum = $request->input('sonum');
            $qrcode = $request->input('qrcode');
			$sequence1 = $request->input('seq');
			$sequence2 = strtok($sequence1, '/');
			$sequence3 = strtok($sequence1, '/');
			$currentuser = auth()->user()->name;
			
            $data= array('qrcode'=>$qrcode,'asgnto'=>$asgnto,'opasgn_by' => $currentuser, 'dt_opasgn' => Carbon::now());
			
			$show2 = DB::table('moresolist')
            ->where('stockcode', '=', $stockcode)
            ->where('sonum','=', $sonum)
            ->get();

            $pallet = DB::table('moresolist')
            ->where('stockcode', '=', $stockcode)
            ->where('sonum','=', $sonum)
            ->first();
            

      		foreach ($show2 as $shows2)
      		if($shows2->psmb == 0){
        	 $varz = 0;
     		 }else{
        	 $varz = ($shows2->pbag) / ($shows2->psmb);
     		 }
			
			if($sequence2 == '1'){
			$valid = true;
			}
			else{
			$valid = false;
			}
			$cal = $sequence2 - 1;
			$cal2 = $cal * $varz;
			if($valid == true){
			$cal3 = 1;
			$cal4 = $varz;
			}
			else{
			
			$cal3 = $cal2 + 1;
			$cal4 = $cal3 + $varz - 1;
			
			}
			
            if($pallet->uom2 != 'PALLET'){

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
            ->where('number', '>=' ,$sequence1)
            ->where('number', '<=' ,$sequence2)
            ->update(['asgnto'=>$asgnto, 'reasgnto'=>"1"]);*/
          
            }
             /** ORIGINAL */
            /* DB::table('qrmastersmb')
            ->orderBy('number', 'DESC')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->where('qrcodesb','=', NULL)
            ->where('sequence','=', NULL)
            ->where('printseal_by','=', NULL)
            ->where('dt_printseal','=', NULL)
            ->where('dt_opscancomplete','=', NULL)
            ->where('number', '>=' ,$cal3)
            ->where('number', '<=' ,$cal4)
            ->update(['asgnto'=>$asgnto, 'reasgnto'=>"1"]);*
			
            DB::table('qrmaster')->where('qrcode', $qrcode)
            ->update($data);
			
			
            Session::flash('message','Update successfully.');*/


            /** check small bag already scan by other person,if not scanned yet allow reassign to other person */
            $chkMatch = DB::table('qrmastersmb')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->where('qrcodesb','=', NULL)
            ->where('sequence','=', NULL)
            ->whereNotNull('dt_opscancomplete')
            ->where('number', '>=' ,$cal3)
            ->where('number', '<=' ,$cal4)
            ->where('asgnto', '!=' ,$asgnto)->count();

            $assgnperson= DB::table('qrmastersmb')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->where('qrcodesb','=', NULL)
            ->where('sequence','=', NULL)
            ->whereNotNull('dt_opscancomplete')
            ->where('number', '>=' ,$cal3)
            ->where('number', '<=' ,$cal4)
            ->where('asgnto', '!=' ,$asgnto)->first();

            if($assgnperson){

                $who3 = DB::table('users')->where('StaffID','=', $assgnperson->asgnto)->first();
                //return dd($who3);
            }

            $update ="";

            $chkPrint = DB::table('qrmastersmb')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->where('qrcodesb','=', NULL)
            ->where('sequence','=', NULL)
            ->whereNotNull('dt_printseal')
            ->where('dt_opscancomplete','=', NULL)
            ->where('number', '>=' ,$cal3)
            ->where('number', '<=' ,$cal4)
            ->where('asgnto', '!=' ,$asgnto)->count();

            $addmessages= "";
            if($chkPrint >0){

                $addmessages =" <br> Kindly reprint the sticker as the assigned operator has changed.";
            }
            if($chkMatch >0){ 

                Session::flash('Error','Reassign is not allowed ! <br>Small bags already scanned by the assigned person.<br>Staff ID : '.$who3->StaffID.'<br>Staff Name : '.$who3->name.'<br><br>Small bags in the same standard bag need to be scanned by the same person ! ');
                return redirect()->back();
            }else{

            
               $update =  DB::table('qrmastersmb')
                ->orderBy('number', 'DESC')
                ->where('stockcode','=', $stockcode)
                ->where('sonum','=', $sonum)
                ->where('qrcodesb','=', NULL)
                ->where('sequence','=', NULL)
                //->where('printseal_by','=', NULL) //remove this cond,user still can reassign after print and seal as long as not scan yet //updated : 06/2023 by syu
                //->where('dt_printseal','=', NULL)//remove this cond,user still can reassign after print and seal  as long as not scan yet //updated : 06/2023 by syu
                ->where('dt_opscancomplete','=', NULL)
                ->where('number', '>=' ,$cal3)
                ->where('number', '<=' ,$cal4)
                ->update(['asgnto'=>$asgnto, 'reasgnto'=>"1"]);

                
            }
			
            if($update){ //when success update qrmastersmb,then update qrmaster assgnto

                DB::table('qrmaster')->where('qrcode', $qrcode)
                ->update($data);

                Session::flash('message','Update successfully'.$addmessages);
                return redirect()->back();
            }else{ //No row updated
                
                Session::flash('INFO','No data updated !');
                return redirect()->back();
            }
        }else{
            Session::flash('message','Please choose the operator!');
        }
           return redirect()->back();
    }
	
	public function reassignsmb($stockcode, $sonum) {     
            $lists = DB::table('qrmastersmb')
            ->orderByRaw('LENGTH(number)', 'ASC')
            ->orderBy('number', 'ASC')
            ->select(['qrcode','stockcode','number','asgnto','sonum','deviceId'])
            ->where('stockcode','=', $stockcode)
			->where('dt_opscancomplete','=', null )
            //->where('dt_qacheck','=',null)
            ->where('sonum','=', $sonum)
            ->paginate(10);
            
              
            $lists2 = DB::table('moresolist')
            ->where('stockcode','=', $stockcode)
            ->where('sonum','=', $sonum)
            ->get();

            $lists3 = DB::table('users')
            ->where('dept','=', '4')
            ->where('location','=', auth()->user()->location)
            ->where('status','A')->orderBy('StaffID')
            ->get();
            
            return view('reassignsmb.reassignSMB',['lists'=>$lists,'lists2'=>$lists2,'lists3'=>$lists3]);
              
        }
	
	public function editreassignsmb(Request $request) {
            if($request->input('asgnto') !=""){
                $asgnto = $request->input('asgnto');
                $stockcode = $request->input('stockcode');
                $sonum = $request->input('sonum');
                $qrcode = $request->input('qrcode');
                $sequence1 = $request->input('number');
                $currentuser = auth()->user()->name;
                
                $data= array('qrcode'=>$qrcode,'asgnto'=>$asgnto);
                
                $show2 = DB::table('moresolist')
                ->where('stockcode', '=', $stockcode)
                ->where('sonum','=', $sonum)
                ->get();

                foreach ($show2 as $shows2)
                if($shows2->psmb == 0){
                $varz = 0;
                }else{
                $varz = ($shows2->pbag) / ($shows2->psmb);
                }
                
                if($sequence1 == '1'){
                $valid = true;
                }
                else{
                $valid = false;
                }
                $cal = $sequence1 - 1;
                $cal2 = $cal * $varz;
                if($valid == true){
                $cal3 = 1;
                $cal4 = $varz;
                }
                else{
                
                $cal3 = $cal2 + 1;
                $cal4 = $cal3 + $varz - 1;
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
          ->where('number', $sequence1)
          ->update(['asgnto'=>$asgnto, 'reasgnto'=>"1"]);
                
           DB::table('qrmastersmb')
           ->where('qrcode', $qrcode)
           ->update($data);
                
                
                Session::flash('message','Update successfully.');
            }else{
                Session::flash('message','Please choose the operator!');
            }
               return redirect()->back();
                }
     }
     
