<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>QR Monitoring and Tracking System</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'><link rel="stylesheet" href="./style.css">

</head>
<?php use Carbon\Carbon; ?>
<style>
body{
    margin-top:20px;
    background:#FAFAFA;
}
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}
</style>
<body>
  
<div class="container">
      @foreach ($report as $reports)
<h1>{{$reports->sonum}}</h1>
@endforeach
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Product</h6>
                    <h2 class="text-right"><i class="fa fa-industry f-left"></i>
                    <span>
                          @foreach ($report as $reports)
                            <?php 
                                $ttlproduct = DB::table('moresolist')->where('sonum','=', $reports->sonum)->get();
                                $sum = 0;
                                foreach($ttlproduct as $ttlproducts){
                                $sum+= $ttlproducts->quantity;
                                }
                                echo $sum;
                            ?>
                         @endforeach
                    </span></h2>
                    <p class="m-b-0">Completed Product
                    <span class="f-right">
                         @foreach ($report as $reports)
                            <?php 
                                $ttlproduct2 = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->where('dt_opscancomplete', '!=', NULL)->get();
                                $sum2 = 0;
                                foreach($ttlproduct2 as $ttlproducts2){
                                $sum2+= $ttlproducts2->pbag;
                                }
                                echo $sum2;
                            ?>
                         @endforeach
                    </span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Duration</h6>
                    <h2 class="text-right"><i class="fa fa-calendar f-left"></i>
                    <span>
                         @foreach ($report as $reports)
                            <?php 
                                $comp = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->count();
                                $comp2 = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->where('dt_opscancomplete', '!=', NULL)->count();
                                
                                if($comp2 == $comp){
                             
                                }else{
                                $startDate = Carbon::parse($reports->dateissue);
                                $endDate = Carbon::now();
                                $days = $startDate->diffInDays($endDate);
                                $hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                                $minutes = $startDate->copy()->addDays($days)->addHours($hours)->diffInMinutes($endDate);
                                echo $days.'D '.$hours.'H '.$minutes.'M ';
                                }
                               
                            ?>
                         @endforeach
                    </span></h2>
                    <p class="m-b-0">Duration<span class="f-right">
                         @foreach ($report as $reports)
                            <?php 
                                $comp = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->count();
                                $comp2 = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->where('dt_opscancomplete', '!=', NULL)->count();
                                
                                if($comp2 == $comp){
                             echo 'Finished';
                                }else{
                               echo 'Ongoing';
                                }
                               
                            ?>
                         @endforeach
                    </span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Total Operator Contributed</h6>
                    <h2 class="text-right"><i class="fa fa-user f-left"></i><span>
                         @foreach ($report as $reports)
                            <?php 
                                $ttlop = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->distinct('asgnto')->count('asgnto');
                                echo $ttlop;
                            ?>
                         @endforeach
                    </span></h2>
                    <p class="m-b-0">Total Operator<span class="f-right">
                          @foreach ($report as $reports)
                            <?php 
                                $ttlop = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->distinct('asgnto')->count('asgnto');
                                echo $ttlop;
                            ?>
                         @endforeach
                    </span></p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">Orders Received</h6>
                    <h2 class="text-right"><i class="fa fa-truck f-left"></i>
                    <span>
                        0
                    </span>
                    </h2>
                    <p class="m-b-0">Completed Orders<span class="f-right">0</span></p>
                </div>
            </div>
        </div>
	</div>



    <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: [
			{ y: 450 },
			{ y: 414},
			{ y: 520, indexLabel: "highest",markerColor: "red", markerType: "triangle" },
			{ y: 460 },
			{ y: 450 },
			{ y: 500 },
			{ y: 480 },
			{ y: 480 },
			{ y: 410 , indexLabel: "lowest",markerColor: "DarkSlateGrey", markerType: "cross" },
			{ y: 500 },
			{ y: 480 },
			{ y: 510 }
		]
	}]
});
chart.render();

}
</script>
<h3 style="text-align:left">Product Produce Per Week</h3>
<div id="chartContainer" style="height: 300px; width: 100%;"></div><br>
<h3 style="text-align:left">Productivity</h3>
<center>
<table>
  <tr>
  <td><div class="progress-circle" data-progress="60"></div></td>
   <td><div class="progress-circle" data-progress="60"></div></td>
    <td><div class="progress-circle" data-progress="60"></div></td>

  </tr>
  <tr>
  <td align="center">Manufacturing Department</td>
  <td align="center">QA Department</td>
  <td align="center">Warehouse Department</td>
  
 
  </tr>
  </table>
  </center>
  <br> <br>
  <h3 style="text-align:left">Running Machine <span style="color:green">Plant Z</span></h3>
  <center>
  <table>
        @foreach ($report as $reports)
                            <?php 
                                $machine = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->distinct('deviceId')->get('deviceId');
                               
                            ?>
                         @endforeach
                    
    <tr>
             @foreach ($machine as $machines)
    <td><img style="height:200px; width:200px; padding:25px" src="{{ asset('/img/BSicon/machine.png') }}"></td>
  @endforeach
    </tr>
    <tr>
         @foreach ($machine as $machines)
    <td style="text-align:center">{{$machines->deviceId}} <br><span style="color:green">Total Item Produce</span> : 
    <?php 
    $var = DB::table('qrmaster')->where('sonum','=', $reports->sonum)->where('deviceId','=', $machines->deviceId)->get(); 
                            $sum = 0;
                                    foreach ($var as $vars){
                                        $sum+= $vars->pbag;
                                    }
                                    echo ceil($sum);
                                  
    ?>
    </td>
      @endforeach
    </tr>
 
    </table>
    </center>
    <br> <br> <br>
  <style>
  .progress-circle {
  background-color: #ddd;
  border-radius: 50%;
  display: inline-block;
  height: 15rem;
  margin: 4rem 2rem 0;
  position: relative;
  width: 15rem;
}
.progress-circle:before {
  align-items: center;
  background-color: #fff;
  border-radius: 50%;
  content: attr(data-progress) '%';
  display: flex;
  font-size: 3rem;
  justify-content: center;
  position: absolute;
  left: 1rem;
  right: 1rem;
  top: 1rem;
  bottom: 1rem;
  transition: -webkit-transform 0.2s ease;
  transition: transform 0.2s ease;
  transition: transform 0.2s ease, -webkit-transform 0.2s ease;
}
.progress-circle:after {
  background-color: #0083ff;
  border-radius: 50%;
  content: '';
  display: inline-block;
  height: 100%;
  width: 100%;
}
.progress-circle:hover:before,
.progress-circle:focus:before {
  -webkit-transform: scale(0.8);
          transform: scale(0.8);
}
/**
* $step is set to 5 by default, meaning you can only use percentage classes in increments of five (e.g. 25, 30, 45, 50, and so on). This helps to reduce the size of the final CSS file. If you need a number that doesn't end in 0 or 5, you can change the text percentage while rounding the class up/down to the nearest 5.
*/
.progress-circle[data-progress="0"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(90deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="1"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(93.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="2"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(97.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="3"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(100.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="4"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(104.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="5"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(108deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="6"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(111.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="7"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(115.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="8"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(118.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="9"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(122.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="10"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(126deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="11"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(129.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="12"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(133.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="13"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(136.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="14"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(140.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="15"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(144deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="16"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(147.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="17"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(151.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="18"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(154.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="19"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(158.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="20"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(162deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="21"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(165.60000000000002deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="22"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(169.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="23"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(172.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="24"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(176.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="25"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(180deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="26"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(183.60000000000002deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="27"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(187.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="28"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(190.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="29"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(194.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="30"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(198deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="31"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(201.60000000000002deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="32"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(205.2deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="33"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(208.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="34"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(212.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="35"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(216deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="36"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(219.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="37"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(223.20000000000002deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="38"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(226.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="39"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(230.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="40"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(234deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="41"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(237.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="42"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(241.20000000000002deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="43"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(244.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="44"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(248.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="45"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(252deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="46"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(255.6deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="47"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(259.20000000000005deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="48"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(262.8deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="49"]:after {
  background-image: linear-gradient(90deg, #ddd 50%, transparent 50%, transparent), linear-gradient(266.4deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="50"]:after {
  background-image: linear-gradient(-90deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="51"]:after {
  background-image: linear-gradient(-86.4deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="52"]:after {
  background-image: linear-gradient(-82.8deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="53"]:after {
  background-image: linear-gradient(-79.2deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="54"]:after {
  background-image: linear-gradient(-75.6deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="55"]:after {
  background-image: linear-gradient(-72deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="56"]:after {
  background-image: linear-gradient(-68.4deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="57"]:after {
  background-image: linear-gradient(-64.8deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="58"]:after {
  background-image: linear-gradient(-61.2deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="59"]:after {
  background-image: linear-gradient(-57.6deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="60"]:after {
  background-image: linear-gradient(-54deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="61"]:after {
  background-image: linear-gradient(-50.4deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="62"]:after {
  background-image: linear-gradient(-46.8deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="63"]:after {
  background-image: linear-gradient(-43.199999999999996deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="64"]:after {
  background-image: linear-gradient(-39.6deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="65"]:after {
  background-image: linear-gradient(-36deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="66"]:after {
  background-image: linear-gradient(-32.4deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="67"]:after {
  background-image: linear-gradient(-28.799999999999997deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="68"]:after {
  background-image: linear-gradient(-25.200000000000003deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="69"]:after {
  background-image: linear-gradient(-21.599999999999994deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="70"]:after {
  background-image: linear-gradient(-18deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="71"]:after {
  background-image: linear-gradient(-14.399999999999991deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="72"]:after {
  background-image: linear-gradient(-10.799999999999997deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="73"]:after {
  background-image: linear-gradient(-7.200000000000003deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="74"]:after {
  background-image: linear-gradient(-3.599999999999994deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="75"]:after {
  background-image: linear-gradient(0deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="76"]:after {
  background-image: linear-gradient(3.600000000000009deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="77"]:after {
  background-image: linear-gradient(7.200000000000003deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="78"]:after {
  background-image: linear-gradient(10.799999999999997deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="79"]:after {
  background-image: linear-gradient(14.400000000000006deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="80"]:after {
  background-image: linear-gradient(18deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="81"]:after {
  background-image: linear-gradient(21.60000000000001deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="82"]:after {
  background-image: linear-gradient(25.200000000000003deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="83"]:after {
  background-image: linear-gradient(28.799999999999997deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="84"]:after {
  background-image: linear-gradient(32.400000000000006deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="85"]:after {
  background-image: linear-gradient(36deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="86"]:after {
  background-image: linear-gradient(39.599999999999994deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="87"]:after {
  background-image: linear-gradient(43.20000000000002deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="88"]:after {
  background-image: linear-gradient(46.80000000000001deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="89"]:after {
  background-image: linear-gradient(50.400000000000006deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="90"]:after {
  background-image: linear-gradient(54deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="91"]:after {
  background-image: linear-gradient(57.599999999999994deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="92"]:after {
  background-image: linear-gradient(61.20000000000002deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="93"]:after {
  background-image: linear-gradient(64.80000000000001deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="94"]:after {
  background-image: linear-gradient(68.4deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="95"]:after {
  background-image: linear-gradient(72deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="96"]:after {
  background-image: linear-gradient(75.6deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="97"]:after {
  background-image: linear-gradient(79.20000000000002deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="98"]:after {
  background-image: linear-gradient(82.80000000000001deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="99"]:after {
  background-image: linear-gradient(86.4deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
.progress-circle[data-progress="100"]:after {
  background-image: linear-gradient(90deg, #0083ff 50%, transparent 50%, transparent), linear-gradient(270deg, #0083ff 50%, #ddd 50%, #ddd);
}
  </style>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>
</body>
</html>