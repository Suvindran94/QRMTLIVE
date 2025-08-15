<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Page;
use DB;
use Auth;
use App\Notifications\NewLessonNotification;
use Carbon\Carbon;



use App\Lesson;
use App\User;
class PagesController extends Controller
{
    public function internalAudit() {
     
        return view('cars.internalaudit');
    }
    
    public function internalCust() {
     
        return view('cars.internalcust');
    }


    public function externalCust() {
     
        return view('cars.externalcust');
    }

    public function carHome() {
     
        return view('cars.carhome');
    }

    public function carList() {
     
        return view('cars.carlist');
    }

    public function trackCar() {
     
        return view('cars.cartracker');
    }

    public function externalProvider() {
     
        return view('cars.externalProvider');
    }

    public function letsImprove() {
     
        return view('cars.letsImprove');
    }

    public function carTracker() {
     
        return view('cars.tracker');
    }

    public function home2() {
     
        return view('cars.home2');
    }

    public function validateCars() {
     
        return view('cars.validateCars');
    }

    public function myCar() {
     
        return view('cars.myCar');
    }
    public function BShomeManufacturing() {

        return view('BS.home');
    }
    public function BShomeWarehouse() {

        return view('BS.homewarehouse');
    }
	
	  public function BShomePlanner() {

        return view('BS.homeplanner');
    }
	
	
    public function BShomeQA() {

        return view('BS.homeqa');
    }
	
	
    public function BSlist() {
     
        return view('BS.list');
    }
    public function BSprint() {
     
        return view('BS.print');
    }
    public function BSsearch() {
     
        return view('BS.search');
    }
     public function index($id=0){
 
    // Fetch all records
    $userData['data'] = Page::getuserData();
 
    $userData['edit'] = $id;

    // Fetch edit record
    if($id>0){
      $userData['editData'] = Page::getuserData($id);
    }

    // Pass to view
    return view('BS.scan')->with("userData",$userData);
     }

    public function save2(Request $request){
      if ($request->input('submit') != null ){
          // Update record
          if($request->input('qrcode') !=null ){
            $qrcode = $request->input('qrcode');
            $status = $request->input('status');
            $dt_opscancomplete = Carbon::now();

			  
			  	$qrmasterinfo = DB::table('qrmaster')->where('qrcode','=', $qrcode)
			->join('moresolist', function($join)
				   {
					   $join->on('qrmaster.sonum','=','moresolist.sonum')
						   ->On('qrmaster.stockcode','=','moresolist.stockcode');
				   })->first();
			
			  
            $null = DB::select('select dt_opscancomplete from qrmaster where qrcode = ?',[$qrcode]);
            ['null'=>$null];
            $null2 = DB::select('select dt_printseal from qrmaster where qrcode = ?',[$qrcode]);
            ['null2'=>$null2];
            $null3 = DB::select('select asgnto from qrmaster where qrcode = ?',[$qrcode]);
            ['null3'=>$null3];
            $null4 = DB::select('select * from qrmaster where qrcode = ?',[$qrcode]);
            ['null4'=>$null4];
           
            foreach ($null3 as $nulls3)
            $null5 = DB::select('select * from users where StaffID = ?',[$nulls3->asgnto]);
           if(!empty($null5)){
            foreach ($null2 as $nulls2)
            if($nulls2->dt_printseal !== null){
                foreach ($null as $nulls)
                if($nulls->dt_opscancomplete === null){
                    foreach ($null3 as $nulls3)
                    $lesson = new Lesson;
                    foreach ($null5 as $nulls5)
                    $lesson->user_id = $nulls5->id;
                    foreach ($null5 as $nulls5)
                    $lesson->title = $nulls5->name;
                    foreach ($null4 as $nulls4)
                    $lesson->body = 'Finished, '.$nulls4->sonum.', '.$nulls4->stockcode.', '.$nulls4->seq;
                    $lesson->save();
                    $user = User::where('name','=', $nulls4->opasgn_by)->get();
                    if(\Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first())))
                    {
                        return back();
                    }
                   $data = array('qrcode'=>$qrcode,"status"=>$status,"dt_opscancomplete"=>$dt_opscancomplete);
                   // Update
                   Page::updateData($qrcode, $data);
                  Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

                }else{
                  Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
                }
            }else{
              Session::flash('message3','Please Print Sticker First.');
            }  
        }else{
            Session::flash('message3','Invalid QR Code.');
          }
        
        }
        
        }
        
        return redirect()->back();
      }   

     public function save(Request $request){
        if ($request->input('submit') != null ){
            // Update record
			 $qrcode =  $request->input('qrcode');
             $deviceId =  $request->input('deviceId'); 
			$status = $request->input('status');
			$dt_opscancomplete = Carbon::now();
			
			$qrmasterinfo = DB::table('qrmaster')->where('qrcode','=', $qrcode)
			->join('moresolist', function($join)
				   {
					   $join->on('qrmaster.sonum','=','moresolist.sonum')
						   ->On('qrmaster.stockcode','=','moresolist.stockcode');
				   })->first();
			
			
						$qrmastersmbinfo = DB::table('qrmastersmb')->where('qrcode','=', $qrcode)
			->join('moresolist', function($join)
				   {
					   $join->on('qrmastersmb.sonum','=','moresolist.sonum')
						   ->On('qrmastersmb.stockcode','=','moresolist.stockcode');
				   })->first();
			
			
            if($request->input('qrcode') !=null ){

             $res = strtolower(substr($qrcode,0,3));
           
              if($res == "emp"){
               
                $StaffID = substr($qrcode,3,6);
                $qr = DB::table('userdevice')->where('StaffID','=', $StaffID)->first();
                $qr4 = DB::table('userdevice')->where('StaffID','=', $StaffID)->where('deviceId','=', NULL)->first();
                if($qr === NULL && $qr4 === NULL){
                    $qr2 = DB::table('userqr')->where('StaffID','=', $StaffID)->first();
                    
                    $da = array('StaffID'=>$qr2->StaffID,"deviceId"=>$qr2->deviceId);
                    DB::table('userdevice')->insert($da);
                    $qr5 = DB::table('users')->where('StaffID','=', $StaffID)->first();
                   
                    Session::flash('message','Welcome '.$qr5->name.' !');
                   
                    date_default_timezone_set("Asia/Kuala_Lumpur");
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    $clock = array('StaffID'=>$qr2->StaffID,"deviceId"=>$qr2->deviceId,"location"=>$qr2->location,"date"=>$date,"clock"=>$time,"status"=>'I');
                     DB::table('users_clockinout')->insert($clock);
                }elseif($qr !== NULL && $qr4 === NULL){
                    $qr2 = DB::table('userqr')->where('StaffID','=', $StaffID)->first();
                
                    $da = array('deviceId'=>NULL);
                    DB::table('userdevice')->where('StaffID','=', $qr2->StaffID )->update($da);
                    $qr5 = DB::table('users')->where('StaffID','=', $StaffID)->first();
                   
                    Session::flash('message','Bye '.$qr5->name.' !');
                 
                     date_default_timezone_set("Asia/Kuala_Lumpur");
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    $clock = array('StaffID'=>$qr2->StaffID,"deviceId"=>$qr2->deviceId,"location"=>$qr2->location,"date"=>$date,"clock"=>$time,"status"=>'O');
                     DB::table('users_clockinout')->insert($clock);
                }elseif($qr4 !== NULL && $qr !== NULL){
                    $qr2 = DB::table('userqr')->where('StaffID','=', $StaffID)->first();
                   
                    $da = array("deviceId"=>$request->input('deviceId'));
                    DB::table('userdevice')->where('StaffID','=', $qr2->StaffID )->update($da);
                    DB::table('userqr')->where('StaffID','=', $qr2->StaffID )->update($da);
                    $qr5 = DB::table('users')->where('StaffID','=', $StaffID)->first();
                   
                    Session::flash('message','Welcome '.$qr5->name.' !');
                  
                     date_default_timezone_set("Asia/Kuala_Lumpur");
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    $clock = array('StaffID'=>$qr2->StaffID,"deviceId"=>$qr2->deviceId,"location"=>$qr2->location,"date"=>$date,"clock"=>$time,"status"=>'I');
                     DB::table('users_clockinout')->insert($clock);
            }else{
                Session::flash('message3','Please Register Your QR Code');
            }
              }else{
             
              $status = $request->input('status');
              $dt_opscancomplete = Carbon::now();
              $prints2 = DB::table('qrmastersmb')
              ->where('qrcode','=', $qrcode)
              ->first();	  
				  
				
   
			
              if(!empty($prints2->qrcode)){
            
              $checkMoresolistPallet = DB::table('moresolist')
              ->where('sonum','=', $prints2->sonum)
              ->where('stockcode','=', $prints2->stockcode)
              ->first();

            
              if($checkMoresolistPallet->uom2=='PALLET' && $checkMoresolistPallet->smbAvailability =='Y' ){
                $prints3 = DB::table('qrmastersmb')
              ->where('sonum','=', $prints2->sonum)
              ->where('stockcode','=', $prints2->stockcode)  
              ->where('dt_opscancomplete','!=', NULL) 
              ->where('sequence','=', NULL) 
              ->get();

              }else{
              
              $prints3 = DB::table('qrmastersmb')
              ->where('asgnto','=', $prints2->asgnto)
              ->where('sonum','=', $prints2->sonum)
              ->where('stockcode','=', $prints2->stockcode)  
              ->where('dt_opscancomplete','!=', NULL) 
              ->where('sequence','=', NULL) 
              ->get();
              }

              
              $total = 0;
             
              foreach($prints3 as $print3){
                  $total+= $print3->psmb;

                 
              }
                $prints4 = DB::table('moresolist')
                ->where('sonum','=', $prints2->sonum)
                ->where('stockcode','=', $prints2->stockcode) 
                ->get();
				  
				      $prints10 = DB::table('qrmaster')
                ->where('sonum','=', $prints2->sonum)
                ->where('stockcode','=', $prints2->stockcode) 
                ->whereIn('status',['ps','ao'])
                ->first();
				  
				    $prints11 = DB::table('qrmaster')
                ->where('sonum','=', $prints2->sonum)
                ->where('stockcode','=', $prints2->stockcode) 
                ->whereIn('status',['ps','ao']) 
                ->count();
				  
				
            foreach ($prints4 as $print4)
				
				  if($prints11 > 1){
					  
					$var10 = $print4->pbag; //total order qty
				  }
				   else if($prints11 = 1){
					$var10 = $prints10->pbag;  //total order qty
					  
				  }
					else{
						$var10 = $print4->pbag; //total order qty
					}

      
				  
            if($print4->smbAvailability == 'N'){
            
              $null = DB::table('qrmaster')->where('qrcode',$qrcode)->first();
				
               $null5 = DB::table('users')->where('StaffID',$null->asgnto)->first();
				
             if(!empty($null5)){
              if($null->dt_printseal !== null){
                  if($null->dt_opscancomplete === null){
                     $data = array('qrcode'=>$qrcode,"status"=>$status,"dt_opscancomplete"=>$dt_opscancomplete);
                     // Update
                     Page::updateData($qrcode, $data);
                     Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
					  
					  											try {
				DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
			} catch (\Exception $e) {		
				try {
					DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
				}
				catch (\Exception $e) {
					\Log::emergency($e->getMessage()); 
				}			
			}

                  }else{
                   Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

                  }
              }else{
                Session::flash('message3','Please Print Sticker First.');
              }  
          }else{
              Session::flash('message3','Invalid QR Code.');
            }
            }else{
              if($var10 == $total){
				  
				$checksmb = DB::table('qrmastersmb')->where('qrcode',$qrcode)->count(); //standard packing 
                
                if($checksmb > 0){
                  Session::flash('message3','Please Scan Standard Bag Sticker.');
                  return redirect()->back();
                }
				  
				$qrcode = $request->input('qrcode');
                $null = DB::table('qrmaster')->where('qrcode',$qrcode)->first(); //standard packing 
				/*$nullsmb = DB::table('qrmastersmb')->where('qrcode',$qrcode)->first(); //standard packing
				  
				  if($null == '' && $nullsmb != ''){
					   Session::flash('message3','Please Scan Standard Bag Sticker.');
					  return redirect()->back();
				  }*/
				  
				
				   $null5 = DB::table('users')->where('StaffID',$null->asgnto)->first(); // user
				 
              

               $checkPallet = DB::table('moresolist')->where('sonum',$null->sonum)->where('stockcode',$null->stockcode)->first();
               if(!empty($null5)){ 
                if($null->dt_printseal !== null){
                    if($null->dt_opscancomplete === null){
                       $data = array('qrcode'=>$qrcode,"status"=>$status,"dt_opscancomplete"=>$dt_opscancomplete);
                       $data3 = array('sequence'=>$null->seq, 'qrcodesb'=>$qrcode);

                       if($checkPallet->uom2=='PALLET' && $checkPallet->smbAvailability =='Y'){
                        DB::table('qrmastersmb')
                        ->where('dt_opscancomplete','!=', NULL)
                        ->where('stockcode', '=', $null->stockcode)
                        ->where('sonum', '=', $null->sonum)
                        ->where('sequence', '=', NULL)
                        ->update($data3);
                       }else{
                       DB::table('qrmastersmb')
                       ->where('dt_opscancomplete','!=', NULL)
                       ->where('stockcode', '=', $null->stockcode)
                       ->where('sonum', '=', $null->sonum)
                       ->where('asgnto', '=', $null->asgnto)
                       ->where('sequence', '=', NULL)
                       ->update($data3);
                      }
						
				

                       
                       // Update
                       Page::updateData($qrcode, $data);
                       Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
						
													try {
				DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
			} catch (\Exception $e) {		
				try {
					DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
				}
				catch (\Exception $e) {
					\Log::emergency($e->getMessage()); 
				}			
			}
						
						
						
                    }else{
                      Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

                    }
				   
				
				   
                }else{
                  Session::flash('message3','Please Print Sticker First.');
                } 
				   			
            }else{
                Session::flash('message3','Please Scan Standard Bag Sticker.');
              }

            
            }else{
  
				
					  
              $data2 = array("dt_opscancomplete"=>$dt_opscancomplete);
              if( DB::table('qrmastersmb')->where('dt_opscancomplete','=', NULL) ->where('qrcode', $qrcode)->update($data2)){
              Session::flash('message','Successfully Scanned!<br> Small Bag No. ' .$qrmastersmbinfo->number. ' <br> ' .$qrmastersmbinfo->particular.'&nbsp'.$qrmastersmbinfo->particular2.'');
              }else{
                $check = DB::table('qrmastersmb')->where('qrcode','=', $qrcode)->first();
                if ($check === NULL){
                    Session::flash('message2','Please Scan Small Bag');
                }else{
                    Session::flash('message2','Already Scanned!<br> Small Bag No. ' .$qrmastersmbinfo->number. ' <br> ' .$qrmastersmbinfo->particular.'&nbsp'.$qrmastersmbinfo->particular2.'');
                }
              }
          }
            
        }
            }else{
                $prints2 = DB::table('qrmaster')
                ->where('qrcode','=', $qrcode)
                ->first();
				  
			if($prints2 == ''){
				Session::flash('message2','Invalid QR Code.');
				return redirect()->back();
			}
				    
              $checkMoresolistPallet = DB::table('moresolist')
              ->where('sonum','=', $prints2->sonum)
              ->where('stockcode','=', $prints2->stockcode)->first();            
             
              if($checkMoresolistPallet->uom2=='PALLET' && $checkMoresolistPallet->smbAvailability =='Y' ){
                $prints3 = DB::table('qrmastersmb')
              ->where('sonum','=', $prints2->sonum)
              ->where('stockcode','=', $prints2->stockcode)  
              ->where('dt_opscancomplete','!=', NULL) 
              ->where('sequence','=', NULL) 
              ->get();

              }else{
              
              $prints3 = DB::table('qrmastersmb')
              ->where('asgnto','=', $prints2->asgnto)
              ->where('sonum','=', $prints2->sonum)
              ->where('stockcode','=', $prints2->stockcode)  
              ->where('dt_opscancomplete','!=', NULL) 
              ->where('sequence','=', NULL) 
              ->get();
              }
           
                $total = 0;
                if(!empty($prints3)){

             
                foreach($prints3 as $print3){
                
                    $total+= $print3->psmb;

                   
                }
              
                  $prints4 = DB::table('moresolist')
                  ->where('sonum','=', $prints2->sonum)
                  ->where('stockcode','=', $prints2->stockcode) 
                  ->get();

                 
					  $prints10 = DB::table('qrmaster')
                ->where('sonum','=', $prints2->sonum)
                ->where('stockcode','=', $prints2->stockcode) 
                ->whereIn('status',['ps','ao'])
                ->first();
				  
				    $prints11 = DB::table('qrmaster')
                ->where('sonum','=', $prints2->sonum)
                ->where('stockcode','=', $prints2->stockcode) 
                ->whereIn('status',['ps','ao'])
                ->count();
				  
               
					
                  foreach($prints4 as $prints4)
					    if($prints11 > 1){
					  
					$var10 = $prints4->pbag;
				  }
				   else if($prints11 = 1){
					$var10 = $prints10->pbag;
					  
				  }
					else{
						$var10 = $prints4->pbag;
					}

                  if($prints4->smbAvailability == 'N'){
           
                
               $null = DB::table('qrmaster')->where('qrcode',$qrcode)->first();
				
               $null5 = DB::table('users')->where('StaffID',$null->asgnto)->first();

               
                   
                   if(!empty($null5)){
                    
                    if($null->dt_printseal !== null){
                       
                        if($null->dt_opscancomplete === null){
                           $data = array('qrcode'=>$qrcode,"status"=>$status,"dt_opscancomplete"=>$dt_opscancomplete);
                           // Update
                           Page::updateData($qrcode, $data);
                          Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
																	try {
				DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
			} catch (\Exception $e) {		
				try {
					DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
				}
				catch (\Exception $e) {
					\Log::emergency($e->getMessage()); 
				}			
			}
							
                        }else{
                          Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

                        }
                    }else{
                      Session::flash('message3','Please Print Sticker First.');
                    }  
                }else{
                    Session::flash('message3','Invalid QR Code.');
                  }
                  }else{

               
                   
                    if($var10 == $total){
					
					$checksmb = DB::table('qrmastersmb')->where('qrcode',$qrcode)->count(); //standard packing 
                
					if($checksmb > 0){
					  Session::flash('message3','Please Scan Standard Bag Sticker.');
					  return redirect()->back();
					}

                               $null = DB::table('qrmaster')->where('qrcode',$qrcode)->first();
				
               $null5 = DB::table('users')->where('StaffID',$null->asgnto)->first();

               $checkPallet = DB::table('moresolist')->where('sonum',$null->sonum)->where('stockcode',$null->stockcode)->first();
                     
             
               
                     if(!empty($null5)){
                    
                      if($null->dt_printseal !== null){                       
                          if($null->dt_opscancomplete === null){

                           

                             $data = array('qrcode'=>$qrcode,"status"=>$status,"dt_opscancomplete"=>$dt_opscancomplete);
                             $data3 = array('sequence'=>$null->seq, 'qrcodesb'=>$qrcode);

                       
                             if($checkPallet->uom2=='PALLET' && $checkPallet->smbAvailability =='Y'){
                              DB::table('qrmastersmb')
                              ->where('dt_opscancomplete','!=', NULL)
                              ->where('stockcode', '=', $null->stockcode)
                              ->where('sonum', '=', $null->sonum)
                              ->where('sequence', '=', NULL)
                              ->update($data3);
                             }else{
                             DB::table('qrmastersmb')
                             ->where('dt_opscancomplete','!=', NULL)
                             ->where('stockcode', '=', $null->stockcode)
                             ->where('sonum', '=', $null->sonum)
                             ->where('asgnto', '=', $null->asgnto)
                             ->where('sequence', '=', NULL)
                             ->update($data3);
                            }
                             // Update
                             Page::updateData($qrcode, $data);
                           Session::flash('message','Successfully Updated!<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');
																		try {
				DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
			} catch (\Exception $e) {		
				try {
					DB::select('CALL SP_INSERT_SFU(?)',array($qrcode));
				}
				catch (\Exception $e) {
					\Log::emergency($e->getMessage()); 
				}			
			}
							  
                          }else{
                            Session::flash('message2','Already Scan<br> No. ' .$qrmasterinfo->seq. ' - ' .$qrmasterinfo->particular.'&nbsp'.$qrmasterinfo->particular2.'');

                          }
                      }else{
                        Session::flash('message3','Please Print Sticker First.');
                      }  
                  }else{
                      Session::flash('message3','Please Scan Standard Bag Sticker.');
                    }
                  
                  }else{
        
                    $data2 = array("dt_opscancomplete"=>$dt_opscancomplete);
                    if( DB::table('qrmastersmb')->where('dt_opscancomplete','=', NULL) ->where('qrcode', $qrcode)->update($data2)){
                     Session::flash('message','Successfully Scanned!<br> Small Bag No. ' .$qrmastersmbinfo->number. ' <br> ' .$qrmastersmbinfo->particular.'&nbsp'.$qrmastersmbinfo->particular2.'');
                    }else{
                      $check = DB::table('qrmastersmb')->where('qrcode','=', $qrcode)->first();
                      if ($check === NULL){
                          Session::flash('message2','Please Scan  Small Bag');
                      }else{
                          Session::flash('message2','Already Scanned!<br> Small Bag No. ' .$qrmastersmbinfo->number. ' <br> ' .$qrmastersmbinfo->particular.'&nbsp'.$qrmastersmbinfo->particular2.'');
                      }
                    }
                }
                  }
                  
                
            }else{

              Session::flash('message3','Invalid QR Code.');
        }

        } 
    }
          }
        }
          
          return redirect()->back();
        }   
}