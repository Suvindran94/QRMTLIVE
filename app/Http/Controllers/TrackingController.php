<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class TrackingController extends Controller
{
    public function index() {
      
        return view('BS.tracking');
     }
    public function show($sonum) {
		
        $tracks = DB::table('solist')->where('sonum',$sonum)->get(); 
        $track2 = DB::table('moresolist')->where('sonum',$sonum)->where('trxstatus','!=','D')->get(); 
        $track3 =  DB::table('qrmaster')->where('sonum',$sonum)->get(); 
        $track4 = DB::table('solist')->where('sonum',$sonum)->get(); 
		$stockcodes = DB::table('moresolist')->where('sonum',$sonum)->where('trxstatus','!=','D')->get(); 
        return view('myaccount.track',['tracks'=>$tracks, 'track2'=>$track2, 'track3'=>$track3, 'track4'=>$track4,'stockcodes'=>$stockcodes],compact('sonum'));
     }
	
	public function search(Request $request) {
	$stockcode = $request->input('stockcode');
    $sonum = $request->input('sonum');
	
	$stockcodes = DB::table('moresolist')->where('sonum',$sonum)->where('trxstatus','!=','D')->get(); 
    $tracks = DB::select('select * from solist where sonum = ?',[$sonum]);  
    $track3 = DB::select('select * from qrmaster where sonum = ?',[$sonum]);
    $track4 = DB::select('select * from solist where sonum = ?',[$sonum]);
	if($stockcode != 'All'){
    $track2 =DB::table('moresolist')->where('stockcode', 'LIKE', '%' . $stockcode . '%')->where('trxstatus','!=','D')->where('sonum', '=', $sonum )->get();
	}
	else{
	 $track2 = DB::table('moresolist')->where('sonum',$sonum)->where('trxstatus','!=','D')->get(); 	
	}
		 
		 if($track2->count() <= 0 &&  $stockcode != ''){
		  Session::flash('message','No Result Found !');
		 }
		 
	 return view('myaccount.track',['tracks'=>$tracks, 'track2'=>$track2, 'track3'=>$track3, 'track4'=>$track4,'stockcodes'=>$stockcodes],compact('sonum'));
 }
	
		public function searchindex(Request $request,$sonum) {
		$so = $sonum;
		$stockcodes = DB::table('moresolist')->where('sonum',$so)->where('trxstatus','!=','D')->get(); 
		$soshipmark = DB::table('solist')->where('sonum',$so)->first(); 
    	
 
	 	return view('myaccount.searchtrack',compact('so','stockcodes','soshipmark'));
 }
   
}
