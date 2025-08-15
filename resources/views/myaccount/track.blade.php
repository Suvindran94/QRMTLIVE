<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	 <title>SO Tracking </title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<?php use Carbon\Carbon;?>
<style>
body {

    background-image: url('/img/back.jpg');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #464646;

}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td,
th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

a,
a:hover,
a:focus {
    font-family: Arial;
    font-size: 14px;
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    background: #00AEF0;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}

/* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

#sidebar {
    width: 250px;
    position: fixed;
    top: 0;
    left: -250px;
    height: 100vh;
    z-index: 999;
    background: #00AEF0;
    color: #fff;
    transition: all 0.3s;
    overflow-y: scroll;
    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
}

#sidebar.active {
    left: 0;
}

#dismiss {
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: #424242;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}

#dismiss:hover {
    background: #fff;
    color: #00AEF0;
}

.overlay {
    display: none;
    position: fixed;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    z-index: 998;
    opacity: 0;
    transition: all 0.5s ease-in-out;
}

.overlay.active {
    display: block;
    opacity: 1;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #00AEF0;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    color: #00AEF0;
    background: #fff;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #424242;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #00AEF0;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #7386D5;
}

/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */
#content {
    width: 100%;
    padding: 20px;

    transition: all 0.3s;
    position: absolute;
    top: 0;
    right: 0;
}

p {
    text-transform: uppercase;
}

li1 {
    width: 60px;
    height: 60px;
    line-height: 26px;
    font-size: 12px;
    font-family: arial, calibri, sans-serif;
    font-weight: bold;
    text-align: center;
    border-radius: 50%;
    background: green;
    display: inline-block;
    color: white;
    position: relative;
    margin: 0px 10px;

}

li1::before {
    content: '';
    position: absolute;
    top: 50%;
    left: -100%;
    width: 100%;
    height: 1px;
    background: dodgerblue;
    z-index: -1;
}

li1:first-child::before {
    display: none;
}

li1:after {}

.active {
    background: green;
}

.active~li1 {
    background: lightblue;
}

.active~li1::before {
    background: lightblue;
}

li1>span {
    position: absolute;
    top: 25px;
    left: -4;
    font-size: 10.5px;
    line-height: 100%;
    content: attr(data-step);
    color: white;
}

li1>p {
    position: absolute;
    top: 25px;
    left: 0;
    font-size: 11px;
    line-height: 100%;
    content: attr(data-step);
    color: black;
}
span1 {
  color: green;
  display: block;
  float: right;
  text-align: right;
}
#sticky {
  padding: 0.5ex;
 
  border-radius: 0.5ex;
}

#sticky.stick {
  position: fixed;
  margin-left: 260px;
  top: 5px;
  z-index: 10000;
  border-radius: 5px;
  background-color:white;
  border: 1px black solid;
  width:46%;
}

</style>

<body>
    <br><br>
    <div class="container">
    <?php
							if (Auth::check())
                            $name = auth()->user()->dept;
                            $name2 = auth()->user()->role;
                            if($name === "Manufacturing" && $name2 === "Supervisor"){
                                echo '<a href="/BShomesu" class="btn btn-success" style="width:100px;">Home</a>';
                            }elseif($name === "BIS"){
                            echo '<a href="/admin" class="btn btn-success" style="width:100px;">Home</a>';
                            }else{
                                echo '<a href=/BShome'.$name.' class="btn btn-success" style="width:100px;	">Home</a>';
                            }
							

    ?>
       
      
        <div class="row">
            <div class="col-sm-12">
                @foreach($tracks as $track1)
                <h1 style="color:white"><b>{{$track1->shipmark}}&nbsp;{{$track1->sonum}}</b></h1><br>
                @endforeach
                <script>
                function sticky_relocate() {
  var window_top = $(window).scrollTop();
  var div_top = $('#sticky-anchor').offset().top;
  if (window_top > div_top) {
    $('#sticky').addClass('stick');
  } else {
    $('#sticky').removeClass('stick');
  }
}

$(function() {
  $(window).scroll(sticky_relocate);
  sticky_relocate();
});
                </script>
                <div id="sticky-anchor"></div>
                <center>
                <div id="sticky">
                    <ul1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/socreate.png" /><a
                                style="color:black">SO Created</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/assign.png" /><a
                                style="color:black">Operator Assigned</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/printer.png" /><a
                                style="color:black">Print Completed</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/scan1.png" /><a
                                style="color:black">Operator Scan</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/receive.png" /><a
                                style="color:black">SV Received</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/checked.png" /><a
                                style="color:black">QA Checked</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/warehouse.png" /><a
                                style="color:black">Warehouse Received</a></li1>
                    </ul1>
                    </div>
                </center>
            </div>
        </div>
    </div><br><br>
    <div class="container">
   <form action="/searchtracking" method="GET">
           <table>
			   <tr>
				   <td>
            <div class="input-group">
            
            <input type="text" class="form-control" name="sonum" value="{{$sonum}}" hidden> 
           		
                <select class="form-control" name="stockcode" id="stockcode" required>
					<option value="" selected disabled>Select Products</option>
					<option value="All">Show All</option>
					@foreach($stockcodes as $stk)
					<option value="{{$stk->stockcode}}">{{$stk->stockcode}} - {{$stk->particular}}&nbsp;{{$stk->particular2}}</option>
					@endforeach
				</select>
				  </div>
				   </td>
				   <td>
	   
				<center>
                    <button type="submit" class="btn btn-success" value="Search" >
                      Search
                    </button>
				</center>
				   </td>
			   </tr>
	   </table>
	   
               
          
        </form>
</div>
	<br>
		 <div class="container">
        @if (Session::has('message'))
                <div class="alert alert-dismissable alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                   <strong>Whoops!</strong>  {!! Session::pull('message') !!}

                </div>
                @endif
		     </div>
    @foreach($track2 as $track2)
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"
                    style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <h4 class="panel-title">
                    <?php
                    $summary1ttl = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->get();
                    $summary1 = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->where('dt_opscancomplete', '!=', NULL)->get();
                    $summary2 = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->where('dt_spvscanrev', '!=', NULL)->get();
                    $summary3 = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->where('dt_qacheck', '!=', NULL)->get();
                    $summary4 = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->where('dt_whackwrev', '!=', NULL)->get();
                    $summary5 = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->where('dt_opasgn', '!=', NULL)->get();
                    $summary6 = DB::table('qrmaster')->where('sonum','=', $track2->sonum)->where('stockcode','=', $track2->stockcode)->where('dt_printseal', '!=', NULL)->get();
                    $sum1 = 0;
                    foreach ($summary1 as $summary1){
                    $sum1+= ($summary1->pbag);
                    }
                    $sum2 = 0;
                    foreach ($summary2 as $summary2){
                    $sum2+= ($summary2->pbag);
                    }
                    $sum3 = 0;
                    foreach ($summary3 as $summary3){
                    $sum3+= ($summary3->pbag);
                    }
                    $sum4 = 0;
                    foreach ($summary4 as $summary4){
                    $sum4+= ($summary4->pbag);
                    }
                    $sum1ttl = 0;
                    foreach ($summary1ttl as $summary1ttl){
                    $sum1ttl+= ($summary1ttl->pbag);
                    }
                    $sum5ttl = 0;
                    foreach ($summary5 as $summary5){
                    $sum5ttl+= ($summary5->pbag);
                    }
                    $sum6ttl = 0;
                    foreach ($summary6 as $summary6){
                    $sum6ttl+= ($summary6->pbag);
                    }
                    if($sum1 == '0' && $sum2 == '0' && $sum3 == '0' && $sum4 == '0' && $sum5ttl != '0'&& $sum6ttl == '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1ttl).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum5ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }elseif($sum1 == '0' && $sum2 == '0' && $sum3 == '0' && $sum4 == '0' && $sum5ttl != '0'  && $sum6ttl != '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1ttl).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum5ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum6ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }elseif($sum1 != '0' && $sum2 == '0' && $sum3 == '0' && $sum4 == '0' && $sum5ttl != '0'  && $sum6ttl != '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1ttl).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum5ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum6ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }elseif($sum1 != '0' && $sum2 != '0' && $sum3 == '0' && $sum4 == '0' && $sum5ttl != '0'  && $sum6ttl != '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1ttl).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum5ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum6ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum2).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }elseif($sum1 != '0' && $sum2 != '0' && $sum3 != '0' && $sum4 == '0' && $sum5ttl != '0'  && $sum6ttl != '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1ttl).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum5ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum6ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum2).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum3).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }elseif($sum1 != '0' && $sum2 != '0' && $sum3 != '0' && $sum4 != '0' && $sum5ttl != '0'  && $sum6ttl != '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1ttl).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum5ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.$sum6ttl.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum1).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum2).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum3).''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:green">'.ceil($sum4).''.$track2->uom.'</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }elseif($sum1 == '0' && $sum2 == '0' && $sum3 == '0' && $sum4 == '0'&& $sum5ttl == '0'){
                        echo '<a data-toggle="collapse" href="#'.$track2->stockcode.'">
                        <table>
                        <tr>
                        <td width="23%">'.$track2->stockcode.'</td>
                        <td width="8%" style="text-align:center; color:green">'.(int)$track2->quantity.''.$track2->uom.'</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="8%" style="text-align:center; color:red">0</td>
                        <td width="20%"></td>
                       </tr>
                       </table>
                       </a>';
                    }
                    ?>   
                    </h4>
                </div>
                <div id="{{$track2->stockcode}}" class="panel-collapse collapse">
              
					
					    <?php $sticker = DB::table('qrmaster')
	
                ->select(['qrcode','stockcode','seq','asgnto','sonum','dt_whackwrev', 'dt_qacheck', 'dt_spvscanrev', 'dt_opscancomplete', 'dt_printseal'])
                ->where('stockcode','=', $track2->stockcode)
                 ->where('sonum','=', $track2->sonum)
				->orderByRaw("FIELD(status , 'oc','wh') ASC")
				
                ->orderByRaw('LENGTH(seq)', 'ASC')
                ->orderBy('seq', 'ASC')
                ->paginate(10);?>
					
                    @foreach($sticker as $sticker)
                    <br>
                    <center>
                        <ul1>
                            {{$sticker->seq}}
                            
                            <?php 
                                  $prints = DB::table('qrmaster')->where('sonum','=', $sticker->sonum)->where('stockcode','=', $sticker->stockcode)->where('seq','=', $sticker->seq)->get();
                            ?>
                            @foreach($prints as $print)
                            @if( $print->status == 'so' )
                            <li1 class="active">&#10004;<span>{{$print->dt_socreated}}<p
                                        style="color:black;margin-top:15px">{{$print->socreated_by}}</p></span></li1>
                            <li1>&#10008;<span>{{$print->dt_opasgn}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_printseal}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_opscancomplete}}</span></span></li1>
                            <li1>&#10008;<span>{{$print->dt_spvscanrev}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_qacheck}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_whackwrev}}</span></li1>
                            <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::now();
                            $days = $startDate->diffInDays($endDate);
                            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                            ?>
                            <span style="background-color:red; color:white; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                            <br>
                            @elseif( $print->status == 'ao' )
                            <li1>&#10004;<span>{{$print->dt_socreated}}<p style="color:black;margin-top:15px">
                                        {{$print->socreated_by}}</p></span></li1>
                                        <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_opasgn);
                            $days = $startDate->diffInDays($endDate);
                            ?>
                                        <span style="display:inline; color: red; border-bottom: 1px solid red"><?php echo $days.' Days'?></span>
                            <li1 class="active" style=" border-style: solid;border-color: red;">&#10004;<span>{{$print->dt_opasgn}}<p style="color:black;margin-top:15px">
                                        {{$print->opasgn_by}}<br>ASIGN<br>
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}</p>
                                        @endforeach</span></li1>
                            <li1>&#10008;<span>{{$print->dt_printseal}}</span></span></li1>
                            <li1>&#10008;<span>{{$print->dt_opscancomplete}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_spvscanrev}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_qacheck}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_whackwrev}}</span></li1>
                            <?php 
                             $startDate = Carbon::parse($print->dt_socreated);
                             $endDate = Carbon::now();
                             $days = $startDate->diffInDays($endDate);
                             $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                             $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                             ?>
                            <span style="background-color:red; color:white; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                            <br>
                            @elseif( $print->status == 'ps' )
                            <li1>&#10004;<span>{{$print->dt_socreated}}<p style="color:black;margin-top:15px">
                                        {{$print->socreated_by}}</p></span></li1>
                                        <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_opasgn);
                            $days = $startDate->diffInDays($endDate);
                            ?>
                                        <span style="display:inline; color: red; border-bottom: 1px solid red"><?php echo $days.' Days'?></span>
                            <li1 style=" border-style: solid;border-color: red;">&#10004;<span>{{$print->dt_opasgn}}<p style="color:black;margin-top:15px">
                                        {{$print->opasgn_by}}<br>ASIGN<br>
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}</p>
                                        @endforeach</span></li1>
                            <li1 class="active">&#10004;<span>{{$print->dt_printseal}}<p
                                        style="color:black;margin-top:15px">{{$print->printseal_by}}</p></span></span>
                            </li1>
                            <li1>&#10008;<span>{{$print->dt_opscancomplete}}</li1>
                            <li1>&#10008;<span>{{$print->dt_spvscanrev}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_qacheck}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_whackwrev}}</span></li1>
                            <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::now();
                            $days = $startDate->diffInDays($endDate);
                            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                            ?>
                            <span style="background-color:red; color:white; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                           
                            <br>
                            @elseif( $print->status == 'oc' )
                            <li1>&#10004;<span>{{$print->dt_socreated}}<p style="color:black;margin-top:15px">
                                        {{$print->socreated_by}}</p></span></li1>
                                        <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_opasgn);
                            $days = $startDate->diffInDays($endDate);
                            ?>
                                        <span style="display:inline; color: red; border-bottom: 1px solid red"><?php echo $days.' Days'?></span>
                            <li1 style=" border-style: solid;border-color: red;">&#10004;<span>{{$print->dt_opasgn}}<p style="color:black;margin-top:15px">
                                        {{$print->opasgn_by}}<br>ASIGN<br>
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}</p>
                                        @endforeach</span></li1>
                            <li1>&#10004;<span>{{$print->dt_printseal}}<p
                                        style="color:black;margin-top:15px">{{$print->printseal_by}}</p></span></span>
                            </li1>
                            <li1 class="active">&#10004;<span>{{$print->dt_opscancomplete}}<p
                                        style="color:black;margin-top:15px">
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}
                                        @endforeach
                                        </p></span></li1>
                            <li1>&#10008;<span>{{$print->dt_spvscanrev}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_qacheck}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_whackwrev}}</span></li1>
                            <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::now();
                            $days = $startDate->diffInDays($endDate);
                            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                            ?>
                            <span style="background-color:yellow; color:black; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                            <br>
                            @elseif( $print->status == 'sr' )
                            <li1>&#10004;<span>{{$print->dt_socreated}}<p style="color:black;margin-top:15px">
                                        {{$print->socreated_by}}</p></span></li1>
                                        <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_opasgn);
                            $days = $startDate->diffInDays($endDate);
                            ?>
                                        <span style="display:inline; color: red; border-bottom: 1px solid red"><?php echo $days.' Days'?></span>
                            <li1 style=" border-style: solid;border-color: red;">&#10004;<span>{{$print->dt_opasgn}}<p style="color:black;margin-top:15px">
                                        {{$print->opasgn_by}}<br>ASIGN<br>
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}</p>
                                        @endforeach</span></li1>
                            <li1 >&#10004;<span>{{$print->dt_printseal}}<p
                                        style="color:black;margin-top:15px">{{$print->printseal_by}}</p></span></span>
                            </li1>
                              <li1>&#10004;<span>{{$print->dt_opscancomplete}}<p
                                        style="color:black;margin-top:15px">
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}
                                        @endforeach
                                        </p></span></li1>
                            <li1 class="active">&#10004;<span>{{$print->dt_spvscanrev}}<p
                                        style="color:black;margin-top:15px">{{$print->spvscanrev_by}}</p></span></li1>
                            <li1>&#10008;<span>{{$print->dt_qacheck}}</span></li1>
                            <li1>&#10008;<span>{{$print->dt_whackwrev}}</span></li1>
                            <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::now();
                            $days = $startDate->diffInDays($endDate);
                            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                            ?>
                            <span style="background-color:yellow; color:black; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                            <br>
                            @elseif( $print->status == 'qa' )
                            <li1>&#10004;<span>{{$print->dt_socreated}}<p style="color:black;margin-top:15px">
                                        {{$print->socreated_by}}</p></span></li1>
                                        <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_opasgn);
                            $days = $startDate->diffInDays($endDate);
                            ?>
                                        <span style="display:inline; color: red; border-bottom: 1px solid red"><?php echo $days.' Days'?></span>
                            <li1 style=" border-style: solid;border-color: red;">&#10004;<span>{{$print->dt_opasgn}}<p style="color:black;margin-top:15px">
                                        {{$print->opasgn_by}}<br>ASIGN<br>
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}</p>
                                        @endforeach</span></li1>
                            <li1>&#10004;<span>{{$print->dt_printseal}}<p
                                        style="color:black;margin-top:15px">{{$print->printseal_by}}</p></span></span>
                            </li1>
                                        <li1 >&#10004;<span>{{$print->dt_opscancomplete}}<p
                                        style="color:black;margin-top:15px">
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}
                                        @endforeach
                                        </p></span></li1>
                            <li1>&#10004;<span>{{$print->dt_spvscanrev}}<p style="color:black;margin-top:15px">
                                        {{$print->spvscanrev_by}}</p></span></li1>
                            <li1 class="active">&#10004;<span>{{$print->dt_qacheck}}<p
                                        style="color:black;margin-top:15px">{{$print->qacheck_by}}</p></span></li1>
                            <li1>&#10008;<span>{{$print->dt_whackwrev}}</span></li1>
                            <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::now();
                            $days = $startDate->diffInDays($endDate);
                            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                            ?>
                            <span style="background-color:yellow; color:black; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                            <br>
                            @elseif( $print->status == 'wh' )
                            <li1>&#10004;<span>{{$print->dt_socreated}}<p style="color:black;margin-top:15px">
                                        {{$print->socreated_by}}</p></span></li1>
                                        <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_opasgn);
                            $days = $startDate->diffInDays($endDate);
                            ?>
                                        <span style="display:inline; color: red; border-bottom: 1px solid red"><?php echo $days.' Days'?></span>
                            <li1 style=" border-style: solid;border-color: red;">&#10004;<span>{{$print->dt_opasgn}}<p style="color:black;margin-top:15px">
                                        {{$print->opasgn_by}}<br>ASIGN<br>
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}</p>
                                        @endforeach</span></li1>
                            <li1>&#10004;<span>{{$print->dt_printseal}}<p style="color:black;margin-top:15px">
                                        {{$print->printseal_by}}</p></span></span></li1>
                                        <li1 >&#10004;<span>{{$print->dt_opscancomplete}}<p
                                        style="color:black;margin-top:15px">
                                        <?php $user = DB::table('users')->where('StaffID','=', $print->asgnto)->get(); ?>
                                        @foreach ($user as $user)
                                        {{$user->name}}
                                        @endforeach
                                        </p></span></li1>
                            <li1>&#10004;<span>{{$print->dt_spvscanrev}}<p style="color:black;margin-top:15px">
                                        {{$print->spvscanrev_by}}</p></span></li1>
                            <li1>&#10004;<span>{{$print->dt_qacheck}}<p style="color:black;margin-top:15px">
                                        {{$print->qacheck_by}}</p></span></li1>
                            <li1 class="active">&#10004;<span>{{$print->dt_whackwrev}}<p
                                        style="color:black;margin-top:15px">{{$print->whackwrev_by}}</p></span></li1>
                            <?php 
                            $startDate = Carbon::parse($print->dt_socreated);
                            $endDate = Carbon::parse($print->dt_whackwrev);
                            $days = $startDate->diffInDays($endDate);
                            $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                            $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                            ?>
                            <span style="background-color:green; color:white; border-radius: 15px">&nbsp;{{ $days }}D
                                {{ $hours }}H {{ $minutes }}M&nbsp;</span>
                            <br>
                            @endif
                            @endforeach
                        </ul1><br>
                    </center>
                    @endforeach<br>
                    <div class="clearfix">
                        <?php $sticker = DB::table('qrmaster')
                          
                            ->select(['qrcode','stockcode','seq','asgnto','sonum'])
                            ->where('stockcode','=', $track2->stockcode)
                             ->where('sonum','=', $track2->sonum)
		->orderByRaw("FIELD(status , 'oc','wh') ASC")
                ->orderByRaw('LENGTH(seq)', 'ASC')
                ->orderBy('seq', 'ASC')
                            ->paginate(10);?>
                        <center>
                            <table>
                                {{$sticker->appends(request()->input())->links('pagination::bootstrap-4')}}
                            </table>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
    </div>
     <script>
	   $(document).ready(function() {
    $('#stockcode').select2();
});
	</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <br> <br> <br> <br>
</body>

</html>