<html>

<head>
<title>QR Monitoring and Tracking System</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="css/style51.css" rel="stylesheet" />
 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>

</head>
@if( auth()->check() )
@include ('Navigation.'.auth()->user()->dept)
@endif
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

.column {
    float: left;
    width: 25%;
    padding: 0 5px;
}

.row {
    margin: 0 -5px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
    .column {
        width: 100%;
        display: block;
        margin-bottom: 10px;
    }
}

/* Style the counter cards */
.card1 {
    box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.5);
    padding: 16px;
    text-align: center;
    background-color: white;
    color: white;
    border-radius: 25px;
}

.fa {
    font-size: 50px;
}
</style>
<body>
    <br><br><br><br><br><br><br><br><br>
    <p style="text-align:center; font-size:28px; color:white">QR MONITORING AND TRACKING SYSTEM</p><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php  
 $name = auth()->user()->StaffID;
 $name2 = auth()->user()->name;
 $prints2 = DB::table('qrmaster')->where('asgnto','=', $name)->count();
 $prints3 = DB::table('qrmaster')->where('asgnto','=', $name)->where('dt_printseal','!=', NULL)->count();
 $prints4 = DB::table('qrmaster')->where('asgnto','=', $name)->where('dt_opscancomplete','!=', NULL)->count();
 $prints5 = DB::table('qrmaster')->where('printseal_by','=', $name2)->where('dt_reprintseal','!=', NULL)->count();
 $prints6 = DB::table('qrmaster')->where('printseal_by','=', $name2)->count();

 if($prints6 != 0){
    $var3 = ($prints5/$prints6)*100;
    $int5 = (int)$var3;
 }else{
    $var3 = 0;
    $int5 = 0;
 }


 if($prints2 != 0){
 $var = ($prints3/$prints2)*100;
 $var2 = ($prints4/$prints2)*100;
 $int = (int)$var;
 $int2 = (int)$var2;
 $int3 = $prints2 - $prints3;
 $int4 = $prints2 - $prints4;
 }
 else{
 $var = 0;
 $var2 = 0;
 $int = (int)$var;
 $int2 = (int)$var2;
 $int3 = $prints2 - $prints3;
 $int4 = $prints2 - $prints4;
 }
 ?>
                <center>
                    <table style="border: 1px solid transparent; width:100px">
                        <tr style="border: 1px solid transparent">
                            <td style="text-align:center;border: 1px solid transparent">
                                <div class="chart" data-percent="<?php echo $var?>"><?php echo $int?>%</div>
                                <p style="font-size:15px;">
                                    <span
                                        style="background-color:green; color:white; border-radius: 15px">&nbsp;Print&nbsp;</span>
                                    <br><?php echo $prints3?>/<?php echo $prints2?><br><span
                                        style="background-color:yellow; color:black; border-radius: 15px">&nbsp;<?php echo $int3?>
                                        Remaining&nbsp;</span></p>
                            </td>
                            <td style="text-align:center;border: 1px solid transparent">
                                <div class="chart" data-percent="<?php echo $var2?>"><?php echo $int2?>%</div>
                                <p style="font-size:15px">
                                    <span
                                        style="background-color:green; color:white; border-radius: 15px">&nbsp;Complete
                                        Task&nbsp;</span>
                                    <br><?php echo $prints4?>/<?php echo $prints2?><br><span
                                        style="background-color:yellow; color:black; border-radius: 15px">&nbsp;<?php echo $int4?>
                                        Remaining&nbsp;</span></p>
                            </td>
                            <td style="text-align:center;border: 1px solid transparent">
                                <div class="chart" data-percent="<?php echo $int5?>"><?php echo $int5?>%</div>
                                <p style="font-size:15px">
                                    <span style="background-color:green; color:white; border-radius: 15px">&nbsp;Total
                                        Reprint&nbsp;</span>
                                    <br><?php echo $prints5?>/<?php echo $prints6?><br>Rarely</p>
                            </td>
                            <td style="text-align:center;border: 1px solid transparent">
                                <div class="chart" data-percent="50">50%</div>
                                <p style="font-size:15px">
                                    <span
                                        style="background-color:green; color:white; border-radius: 15px">&nbsp;Productivity&nbsp;</span>
                                    <br>Poor<br>&#9733;&#9733;&#9733;</p>
                            </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
    </div><br>
</body>
<style>
.container {
    padding: 20px;
    text-align: center;
}

.chart {
    position: relative;
    display: inline-block;
    margin: 0px 15px;
    font-size: 18px;
    text-transform: uppercase;
    text-align: center;
}

.chart canvas {
    position: absolute;
    top: 0;
    left: 0;
}
</style>
<script>
$(function() {
    $('.chart').easyPieChart({
        scaleColor: false,
        lineWidth: 10,
        lineCap: '',
        barColor: 'green',
        size: 180,
        animate: 2000,

    });
});
</script>
	<script src="{{asset('js/jquery.easy-pie-chart.js')}}"></script>
</html>