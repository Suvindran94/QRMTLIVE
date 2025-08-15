<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Notifications\NewLessonNotification;
use App\Lesson;
use App\User;
class OperatorupdateController_wh extends Controller {

	public function insert(Request $request){
    
        $asgnto = $request->input('asgnto');
        $sonum = $request->input('sonum');
        $opasgn_by = $request->input('opasgn_by');
        $stockcode = $request->input('stockcode');
        $total = $request->input('total');
        $whackwrev_by = $request->input('whackwrev_by');
        $dt_whackwrev = $request->input('dt_whackwrev');
        $lesson = new Lesson;
        $lesson->user_id = auth()->user()->id;
        $lesson->title = $opasgn_by;
        $lesson->body = 'New Task '.$sonum.', '.$stockcode;
        $lesson->save();
        /*$user = User::where('staffId','=', $asgnto)->get();
        if(\Notification::send($user, new NewLessonNotification(Lesson::latest('id')->first())))
        {
            return back();
        }*/

        $quantity = $request->input('quantity');
        $pbag = $request->input('pbag');
        $var = ($quantity %  $pbag);
        if ($var == 0){

            $sonum = $request->input('sonum');
            $pbag = $request->input('pbag');
            $opasgn_by = $request->input('opasgn_by');
            $asgnto = $request->input('asgnto');
            $location = $request->input('location');
            $whackwrev_by = $request->input('whackwrev_by');
            $dt_whackwrev = $request->input('dt_whackwrev');
            $status = $request->input('status');
            $status2 = $request->input('status2');
            $status3 = $request->input('status3');
            $socreated_by = $request->input('socreated_by');
            $dt_socreated = $request->input('dt_socreated');
            $dt_opasgn =$request->input('dt_opasgn');
            $stockcode = $request->input('stockcode');
            $ttlsmb = $request->input('ttlsmb');
            $psmb = $request->input('psmb');
            //$deviceId = $request->input('deviceId');
            //$dev=array('deviceId'=>$deviceId);
            //DB::table('userqr')->where("staffId", "=", $asgnto)->update($dev);
            $data = [];
            for ($i=1; $i<=$total; $i++){

                $qrcode = ('QR'.$i.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);

                $seq =($i.'/'.$total);
                $loca = DB::table('users')->where('location','=', $location)->get();
                //$loca = DB::table('users')->get();
                foreach ($loca as $loca){
                    $data =array('location'=>$location,/*'deviceId'=>$deviceId,*/'sonum'=>$sonum,"status"=>$status,"qrcode"=>$qrcode,"stockcode"=>$stockcode,"seq"=>$seq,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"whackwrev_by"=>$whackwrev_by,"dt_whackwrev"=>$dt_whackwrev,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$pbag);

                    $data3= array('status3'=>$status3);

                }
                $collection = collect($data);   //turn data into collection
                $chunks = $collection->chunk(100); //chunk into smaller pieces
                $chunks->toArray(); //convert chunk to array
                foreach($chunks as $chunk)
                {
                    DB::table('qrmaster_wh')->insert($chunk->toArray());
                }
            }
            $data2 = [];

            $data4= array("asgnto"=>$asgnto,'stockcode'=>$stockcode,'status2'=>$status2,'status'=>$status);
            DB::table('moresolist_wh')->where('stockcode', $stockcode)->where('sonum', $sonum)->update($data4);
            Session::flash('message','Update Sucessfully.');
        }
        else{
            $sonum = $request->input('sonum');
            $pbag = $request->input('pbag');
            $opasgn_by = $request->input('opasgn_by');
            $asgnto = $request->input('asgnto');
            $location = $request->input('location');
            $whackwrev_by = $request->input('whackwrev_by');
            $dt_whackwrev = $request->input('dt_whackwrev');
            $status = $request->input('status');
            $status2 = $request->input('status2');
            $status3 = $request->input('status3');
            $socreated_by = $request->input('socreated_by');
            $dt_socreated = $request->input('dt_socreated');
            $dt_opasgn =$request->input('dt_opasgn');
            $stockcode = $request->input('stockcode');
            $ttlsmb = $request->input('ttlsmb');
            $psmb = $request->input('psmb');
            //$deviceId = $request->input('deviceId');
            //$dev=array('deviceId'=>$deviceId);
            $var2 = ($quantity %  $pbag);
            //DB::table('userqr')->where("staffId", "=", $asgnto)->update($dev);
            for ($i=1; $i<1; $i++){
                $qrcode2 = ('QR'.$total.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);

                $seq2 =($total.'/'.$total);
                $data=array('sonum'=>$sonum,/*"deviceId"=>$deviceId,*/"status"=>$status,"qrcode"=>$qrcode2,"stockcode"=>$stockcode,"seq"=>$seq2,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"whackwrev_by"=>$whackwrev_by,"dt_whackwrev"=>$dt_whackwrev,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$var2);
                DB::table('qrmaster_wh')->insert($data);
            }

            $data = [];
            for ($i=1; $i<=$total; $i++){

                $qrcode = ('QR'.$i.'/'.$total.'|'.mt_rand(1000,9999).'-'.$sonum.'-'.$stockcode);

                $seq =($i.'/'.$total);
                $loca = DB::table('users')->where('location','=', $location)->get();
                //$loca = DB::table('users')->get();
                foreach ($loca as $loca){
                    $var_acc = $quantity - (($pbag * $i) - $pbag);

                    if($var_acc >= $pbag){
                        $var5 = $pbag;
                    }
                    else{
                        $var5 = $var2;
                    }

                    $data =array('location'=>$location,/*'deviceId'=>$deviceId,*/'sonum'=>$sonum,"status"=>$status,"qrcode"=>$qrcode,"stockcode"=>$stockcode,"seq"=>$seq,"dt_opasgn"=>$dt_opasgn,"opasgn_by"=>$opasgn_by,"asgnto"=>$asgnto,"whackwrev_by"=>$whackwrev_by,"dt_whackwrev"=>$dt_whackwrev,"socreated_by"=>$socreated_by,"dt_socreated"=>$dt_socreated,"pbag"=>$var5);

                    $data3= array('status3'=>$status3);

                }
                $collection = collect($data);   //turn data into collection
                $chunks = $collection->chunk(100); //chunk into smaller pieces
                $chunks->toArray(); //convert chunk to array
                foreach($chunks as $chunk)
                {
                    DB::table('qrmaster_wh')->insert($chunk->toArray());

                }
            }
            $data2 = [];
            for ($j=1; $j<=$ttlsmb; $j++){
                $qrcodesmb = ('QRSMB'.$j.'|'.rand(1000,9999).'-'.$sonum.'-'.$stockcode);
                $number = $j;
                array_push($data2,['sonum'=>$sonum,'qrcode'=>$qrcodesmb,'stockcode'=>$stockcode,'asgnto'=>$asgnto,"whackwrev_by"=>$whackwrev_by,"dt_whackwrev"=>$dt_whackwrev,'number'=>$number,'psmb'=>$psmb, 'deviceId'=>$deviceId]);



            }
            $collection2 = collect($data2);   //turn data into collection
            $chunks2 = $collection2->chunk(100); //chunk into smaller pieces
            $chunks2->toArray(); //convert chunk to array

            


            $data2= array("asgnto"=>$asgnto,'stockcode'=>$stockcode,'status2'=>$status2,'status'=>$status);
            DB::table('moresolist_wh')->where('stockcode', $stockcode)->where('sonum', $sonum)->update($data2);
            Session::flash('message','Update Sucessfully.');
        }
		
		return redirect()->back();
	}
}