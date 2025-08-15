<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//pagingCars
use App\Events\FormSubmitted;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Middleware\checkIP;
use GuzzleHttp\Client;

Route::get('testrskey', function () {
   
	$apiEndpoint = 'http://plantm.tplinkdns.com:9001/api/v1/runRSKEY';


                $client = new Client([
                'verify' => false,
                ]);
            
	
                $responses = $client->get($apiEndpoint);
	
	dd($responses);


  });

Route::get('/internalaudit', 'PagesController@internalAudit');
Route::get('/internacust', 'PagesController@internalCust');
Route::get('/externalcust', 'PagesController@externalCust');
Route::get('/carhome', 'PagesController@carHome');
Route::get('/BShome6', 'PagesController@BShomeQA');
Route::get('/BShome4', 'PagesController@BShomeManufacturing');
Route::get('/BShome3', 'PagesController@BShomeWarehouse');
Route::get('/BShome8', 'PagesController@BShomePlanner');
Route::get('/carlist', 'PagesController@carList');
Route::get('/cartracker', 'PagesController@trackCar');
Route::get('/externalProvider', 'PagesController@externalProvider');
Route::get('/letsImprove', 'PagesController@letsImprove');
Route::get('/tracker', 'PagesController@carTracker');
Route::get('/home2', 'PagesController@home2');
Route::get('/BSlist', 'PagesController@BSlist');
Route::get('/BSprint', 'PagesController@BSprint');
Route::get('BSsearch', function () {
    \QrCode::size(100)
              ->format('png')
              ->generate('SO19', public_path('img/qrcode.png'));
      
    return view('BS.search');
      
  });
//register and login
Route::get('/home2', 'UserController@create');
Route::post('home2', 'UserController@store');
Route::get('/login', 'SessionController@create');
Route::post('/login', 'SessionController@store');
Route::post('/login2', 'SessionController@store2');
Route::get('/logout', 'SessionController@destroy');
//

Route::get('/validateCars', 'PagesController@validateCars');
Route::get('/myCar', 'PagesController@myCar');

Route::get("externalProvPDF","HomeController@downloadPDF");
Route::get("internalAuditPDF","HomeController@downloadPDF2");

Route::get('view-records','ListController@index'); 
Route::get('view-lists','BarcodeshowController@index'); 

  Route::get('/', function (Request $request) {
      
         return redirect()->intended('https://ierp.tk/');
    });

Route::get('/BShomeqa', function()
{
    return view('BS.homeqa');
});
Route::get('/BShomesu', function()
{
    return view('BS.homemansu');
});
Route::get('/home', function()
{
    return view('home');
});
Route::get('/scan', function()
{
    return view('BS.scan');
});
Route::get('/scan2', function()
{
    return view('BS.scanwarehouse');
});
Route::get('/scan3', function()
{
    return view('BS.scandriver');
});
Route::get('/back', function()
{
    return view('BS.print');
});
Route::get('/sodetail', function()
{
    return view('BS.sodetail');
});
Route::get('/sticker', function()
{
    return view('BS.sticker');
});

// STICKER TEMPLATE NEW
Route::get('shipmark/{id}', 'AdminController@getShipmark')->name('getShipmark');


Route::get('/custome', function()
{
    return view('BS.search');
});
Route::get('/scansv', function()
{
    return view('BS.scansv');
});

Route::get('/scanqa','Pages3Controller@retrieve');
Route::get('/scanwh','Pages4Controller@retrieve');
/* Route::get('/scanop', function()
{
    return view('BS.scan');
});
*/


Route::post('register', 'Auth\RegisterController@create');


Route::get('lang/{locale}', 'HomeController@lang');


Route::post('edit/{barcodeid}','ListController@edit');
Route::group(['prefix' => 'laravel-crud-search-sort-ajax-modal-form'], function () {
    Route::get('/', 'Crud5Controller@index');
    Route::match(['get', 'post'], 'create', 'Crud5Controller@create');
    Route::match(['get', 'put'], 'update/{id}', 'Crud5Controller@update');
    Route::delete('delete/{id}', 'Crud5Controller@delete');
});
Route::resource('ajaxproducts','ProductAjaxController');


Route::get('productAjax', function () {
    return view('productAjax');
});
//Route::get('show/{sonum}','BarcodeshowController@show')->where('sonum', '[A-Za-z0-9_/-]+');
Route::get ( 'show/{sonum}', function ($sonum) {
  
    $lists = DB::select('select * from solist where sonum = ?',[$sonum]);
	
	$temp = DB::table('template')->where('shipmark', $lists[0]->shipmark)->count();
	
	$shipmark = $lists[0]->shipmark;
	
	if($temp <= 0){
	abort(403,"No Sticker template found for Shipmark $shipmark | $sonum, Kindly Contact BIS!");	
	}
	
    $lists2 = DB::table('moresolist')->where('sonum', '=', $sonum)->where('trxstatus','!=','D')->where('location', '=', auth()->user()->location)->paginate(5);
	
	
    $lists3 = DB::table('users')->where('location', '=', auth()->user()->location)->where('dept', '=',"4")->whereIn('role',['16','30','25','32'])->where('status','A')->orderBy('StaffID')->get();
    $lists4 = DB::select('select * from solist where sonum = ?',[$sonum]);
    return view('BS.sodetail',['lists'=>$lists, 'lists2'=>$lists2, 'lists3'=>$lists3, 'lists4'=>$lists4]);
  
   } )->where('sonum', '[A-Za-z0-9_/-]+');

Route::get('BS.sodetail','BarcodeshowController@index');

Route::get('track/{sonum}','TrackingController@show')->where('sonum', '[A-Za-z0-9_/-]+');
Route::get('/searchtracking','TrackingController@search')->where('sonum', '[A-Za-z0-9_/-]+')->where('stockcode', '[A-Za-z0-9_/-]+');
Route::get('searchtrack/{sonum}','TrackingController@searchindex')->where('sonum', '[A-Za-z0-9_/-]+');

Route::get('assign/{id}','AssignController@edit');
Route::get('sticker/','StickerController@view');
Route::get('BS.sticker','StickerController@index');
Route::resource('operator','OperatorController');
Route::get('edit-records','ListController@index');
Route::get('edit/{id}','OperatorupdateController@show');
Route::post('/editoperator','OperatorupdateController@insert'); 
Route::get('BSprint/{name}','BarcodeshowController@retrieve'); 
Route::get('BSprint/print/{stockcode}','BarcodeshowController@print'); 
Route::get('print/{stockcode}','BarcodeshowController@print'); 
Route::any('print2','BarcodeshowController@reprint')->where('sonum', '[A-Za-z0-9_/-]+'); 
Route::get('printsmb/{stockcode}/{sonum}','BarcodeshowController@printsmb')->where('sonum', '[A-Za-z0-9_/-]+'); 
Route::get('/live_search', 'LiveSearch@index');
Route::get('/live_search/action', 'LiveSearch@action')->name('live_search.action');
Route::get('/live_search2', 'LiveSearch@index2');
Route::get('/live_search2/action', 'LiveSearch@action2')->name('live_search2.action2');
Route::post('/edit1/{stockcode}','BarcodeshowController@update');
Route::post('/edit2/{stockcode}','BarcodeshowController@update2');
Route::post('/print/edit/{stockcode}','BarcodeshowController@print');
Route::resource('scan', 'ScanController');



// Controller-name@method-name

Route::post('/save', 'PagesController@save');

Route::post('/save2', 'Pages2Controller@save');

Route::post('/save3', 'Pages3Controller@save3')->name('save3');


Route::post('/save4', 'Pages4Controller@save4');



Route::resource('ajaxproducts','ProductAjaxController');
Route::post('/saveqrcode', 'SavestickerController@store');
Route::get('/addoperator/{stockcode}/{sonum}','AddoperatorController@index')->where('sonum', '[A-Za-z0-9_/-]+');
Route::post('/moreoperator','AddoperatorController@edit');
Route::post('/dynamic_pdf/pdf', 'DynamicPDFController@pdf');
Route::get('/dynamic_pdf', 'DynamicPDFController@pdfview');
Route::post('/reprint','RepController@reprint');

Route::post('/markAsRead','LessonController@markAsRead')->name('markAsRead');
Route::get('/mark','LessonController@allMarkAsRead');
Route::get('/readAllLesson','LessonController@readAllLesson');
Route::post('/allMarkAsRead','LessonController@allMarkAsRead');
Route::get('/searchstockcode','BarcodeshowController@show2');

Route::any ( '/search', function (Request $request) {
    $stockcode = request()->get('stockcode');
    $sonum = $request->input('sonum');
    $lists2 = DB::table('moresolist')->where('stockcode', 'LIKE', "%{$stockcode}%")->where('sonum', '=', $sonum )->where('location', '=', auth()->user()->location)->where('trxstatus','!=','D')->paginate(5)->setPath ( '' );
    $lists = DB::table('solist')->where('sonum', '=', $sonum)->get();
  $lists3 = DB::table('users')->where('location', '=', auth()->user()->location)->where('dept', '=',"4")->where('status','A')->get();
    $lists4 = DB::table('solist')->where('sonum', '=', $sonum)->get();
  
    if($stockcode != ""){
    $pagination = $lists2->appends ( array (
        $stockcode = $request->input('stockcode') 
        ) );
    if (count ( $lists2 ) > 0)
    
    return view('BS.sodetail',['lists'=>$lists, 'lists2'=>$lists2, 'lists3'=>$lists3, 'lists4'=>$lists4]);
    }
  
    return view('BS.sodetail',['lists'=>$lists, 'lists2'=>$lists2, 'lists3'=>$lists3, 'lists4'=>$lists4])->withMessage ( 'No Details found. Try to search again !' );
} );

Route::any ( '/searchtrack', function (Request $request) {
    $stockcode = $request->input('stockcode');
    $sonum = $request->input('sonum');
    $tracks = DB::select('select * from solist where sonum = ?',[$sonum]);  
    $track3 = DB::select('select * from qrmaster where sonum = ?',[$sonum]);
    $track4 = DB::select('select * from solist where sonum = ?',[$sonum]);
    $track2 =DB::table('moresolist')->where('stockcode', 'LIKE', '%' . $stockcode . '%')->where('sonum', '=', $sonum )->paginate(5);
    if($stockcode != ""){
    
    $pagination = $track2->appends ( array (
        $stockcode = $request->input('stockcode') 
        ) );
    if (count ( $track2 ) > 0)
    return view('myaccount.track',['tracks'=>$tracks, 'track2'=>$track2, 'track3'=>$track3, 'track4'=>$track4]);
    }
    return view('myaccount.track',['tracks'=>$tracks, 'track2'=>$track2, 'track3'=>$track3, 'track4'=>$track4])->withMessage ( 'No Details found. Try to search again !' );
} );

Route::post('/updaterange','BarcodeshowController@updaterange');

Route::get('/admin', function()
{
    return view('BS.admin');
});
Route::get('/staff', function()
{
    return view('BS.staff');
});
Route::get('/productivity', function()
{
    return view('BS.productivity');
});
Route::get('/template', function()
{
    return view('BS.templatesticker');
});
Route::get('/device', function()
{
    return view('BS.device');
});
Route::get('/editstaff','AdminController@edit');
Route::post('/updatestaff','AdminController@update');
Route::post('/qr','AdminController@generateqr');

Route::post('/editdesign','AdminController@editdesign');
Route::get('/tracking', function()
{
    return view('BS.admintracking');
});

Route::middleware([checkIP::class])->group(function(){
Route::get('/scanop','BarcodeshowController@device');
});

Route::post('/adduser','BarcodeshowController@device2');
Route::post('/removeuser','BarcodeshowController@device3');
Route::get('/dashboard', function()
{
    return view('dashboard');
});
Route::get('/plantZ','AdminController@plantZ');
Route::get('/plantP','AdminController@plantP');
Route::get('/plantPstat','AdminController@plantPstat');
Route::get('/plantZstat','AdminController@plantZstat');
Route::get('/plantMstat','AdminController@plantMstat');
Route::get('/plantM','AdminController@plantM');

Route::get('/detail', function()
{
    return view('BS.detailreport');
});
Route::get('/repdetail/{sonum}','AdminController@repdetail')->where('sonum', '[A-Za-z0-9_/-]+');


Route::get('/reprintrange','RepController@reprintrange');
Route::get('/updatedevice','AdminController@updatedevice');
Route::post('/updatedevice2','AdminController@updatedevice2');
Route::post('/adddevice','AdminController@addevice');
Route::get('/viewpallet/{sonum}','RepController@viewpallet')->where('sonum', '[A-Za-z0-9_/-]+');
Route::get('/printpallet/{sonum}/{pallet}','RepController@printpallet')->where('sonum', '[A-Za-z0-9_/-]+');
Route::get('/printqr/{staffId}','AdminController@viewQR');


  Route::get('autologinsu', function () {
	  
	  	$user = $_GET['id'];
		//$api = $_GET['api'];
        Auth::loginUsingId($user, true);
		
		//if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/BShomesu');
		//}
		//else{
        //\LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        //auth()->logout();
		//return redirect()->intended('http://ierp.tk/home2');
		//}
    });


  Route::get('autologinoper', function () {
	  
	  		$user = $_GET['id'];
		$api = $_GET['api'];
        Auth::loginUsingId($user, true);
		
		if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
		$userstaffid = auth()->user()->StaffID;
        return redirect()->intended("/BSprint/$userstaffid");
		}
		else{
        \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        auth()->logout();
		return redirect()->intended('http://ierp.tk/home2');
		}
    });

   
    Route::get('autologinadmin', function () {
		$user = $_GET['id'];
		$api = $_GET['api'];
        Auth::loginUsingId($user, true);
				if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/admin');
		}
		else{
        \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        auth()->logout();
		return redirect()->intended('http://ierp.tk/home2');
		}
		
   
    });

    Route::get('autologin6', function () {
		
		$user = $_GET['id'];
		$api = $_GET['api'];
        Auth::loginUsingId($user, true);
				if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/BShome6');
		}
		else{
        \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        auth()->logout();
		return redirect()->intended('http://ierp.tk/home2');
		}
		
    });
 Route::get('autologin4', function () {
	 
	 		$user = $_GET['id'];
		$api = $_GET['api'];
        Auth::loginUsingId($user, true);
				if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/BShome4');
		}
		else{
        \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        auth()->logout();
		return redirect()->intended('http://ierp.tk/home2');
		}

    });
 Route::get('autologin3', function () {
	 
	 	 		$user = $_GET['id'];
		//$api = $_GET['api'];
        Auth::loginUsingId($user, true);
				//if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/BShome3');
		//}
		//else{
       // \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        //auth()->logout();
		//return redirect()->intended('http://ierp.tk/home2');
		//}
    });
 Route::get('autologin5', function () {
	 
	 	 		$user = $_GET['id'];
		$api = $_GET['api'];
        Auth::loginUsingId($user, true);
				if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/BShome3');
		}
		else{
        \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        auth()->logout();
		return redirect()->intended('http://ierp.tk/home2');
		}
	 
    });


 Route::get('autologin8', function () {
	 
	 	 		$user = $_GET['id'];
		$api = $_GET['api'];
        Auth::loginUsingId($user, true);
				if($api == auth()->user()->api_token){
        \LogActivity::addToLog('Login IQRMT');
        return redirect()->intended('/BShome8');
		}
		else{
        \LogActivity::addToLog('Invalid IQRMT ID/TOKEN');
        auth()->logout();
		return redirect()->intended('http://ierp.tk/home2');
		}
	 
    });


Route::get('printsmb/{stockcode}/{sonum}','BarcodeshowController@printsmb')->where('sonum', '[A-Za-z0-9_/-]+'); 
Route::get('/reprintrange','RepController@reprintrange');
Route::get('/reprintrangesmb','RepController@reprintrangesmb');
Route::post('/calendarttl','AdminController@calendarttl');
Route::get('/deletetemp','AdminController@deletetemp');
Route::get('/reportnos','AdminController@reportnos');
Route::get('/report', 'AdminController@report');

//New Code Portion begin
Route::post('/qrP','AdminController@generateqrP');
//New Code Portion end

//New Code Portion begin
Route::get('/printqrP/{staffId}','AdminController@viewQRP');
//New Code Portion end


//new scanqa
Route::get('/qascanso', function()
{
    return view('BS.scansoqa');
});

//No repack route
Route::get('/norepack', function()
{
    $so = DB::table('whqrmaster')
    ->select('sonum')
    ->where('shipmark','KMB')
    ->groupBy('sonum')
    ->get();
    return view('BS.norepack',compact('so'));
});
Route::post('/norepack', 'Pages2Controller@norepack');
//End No repack route

//Rerassign small bag for Pallet
Route::get('/reassignsmb/{stockcode}/{sonum}','AddoperatorController@reassignsmb')->where('sonum', '[A-Za-z0-9_/-]+');
Route::post('/editreassignsmb','AddoperatorController@editreassignsmb');
Route::post('/smb_pdf/pdf', 'DynamicPDFController@smbpdf');
Route::post('/updaterangesmb','BarcodeshowController@updaterangesmb');

Route::get('getstockcode','LiveSearch@getstockcode');
Route::post('/saveajax', 'AjaxController_live@save');

//Daily Timesheet
Route::get('/daily_timesheet', 'DailyTimesheetController@dailyTimesheet')->name('dailyTimesheet');
Route::post('/generate_report', 'DailyTimesheetController@generateReportPDF')->name('generate_report');
Route::get('/generate_operator_report', 'DailyTimesheetController@dataGenerateOperatorList');
Route::get('/getOperators', 'DailyTimesheetController@dataGetOperatorAjax');
Route::post('store-newtimesheet', 'DailyTimesheetController@storeNewTimeSheet')->name('store-newtimesheet');
Route::post('store-updatedtimesheet', 'DailyTimesheetController@storeUpdatedTimeSheet')->name('store-updatedtimesheet');
Route::get('fetch-operators-by-date', 'DailyTimesheetController@fetchOperatorsByDate')->name('fetch-operators-by-date');
Route::post('store-clonetimesheet', 'DailyTimesheetController@storeCloneTimeSheet')->name('store-clonetimesheet');
Route::get('highlight-operator-date', 'DailyTimesheetController@getHighlightOperatorsDate')->name('highlight-operator-date');

//NEW OPERATOR UPDATE METHOD
Route::get('operatorDash/{id}','OperatorNewUpdateController@index')->where('id', '[A-Za-z0-9_/-]+');;
Route::get('processWO','OperatorNewUpdateController@processWO');
Route::any('printStdBagSticker','OperatorNewUpdateController@printStdBagSticker');
Route::any('printSmallBagSticker','OperatorNewUpdateController@printSmallBagSticker');
Route::any('sealSmallBag','OperatorNewUpdateController@sealSmallBag');
Route::any('scanSmallBag','OperatorNewUpdateController@scanSmallBag');
Route::any('sealStdBag','OperatorNewUpdateController@sealStdBag');
Route::any('scanStdBag','OperatorNewUpdateController@scanStdBag');
Route::any('switchUser','OperatorNewUpdateController@switchUser');
Route::any('checkWOstatus','OperatorNewUpdateController@checkWOstatus');
Route::any('reloadWO','OperatorNewUpdateController@reloadWO');
Route::any('weightsmallbag','OperatorNewUpdateController@weightsmallbag');
Route::any('requestSupervisor','OperatorNewUpdateController@requestSupervisor');



Route::get('listbypass','OperatorNewUpdateController@listbypass');
Route::post('bypassApproval','OperatorNewUpdateController@bypassApproval');
Route::get('switch_wo','OperatorNewUpdateController@switch_wo');
Route::any('switch_wo_seq','OperatorNewUpdateController@switch_wo_seq');
Route::any('activate_wo','OperatorNewUpdateController@activate_wo');




Route::get('fetchDashboardData','OperatorNewUpdateController@fetchdata');
Route::get('/test', function()
{
    return view('test');
});

Route::get('/read-com-port', 'ComPortController@readComPort');
Route::any('checkComponent','OperatorNewUpdateController@checkComponent');