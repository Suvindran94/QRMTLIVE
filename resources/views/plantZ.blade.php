<!DOCTYPE html>
<html lang="en">

<head>
    <title>QR M&T Dashboard</title>
    <meta charset="utf-8">
    @if( $job->lastItem() == 6)
    <meta http-equiv="REFRESH" CONTENT="10;url=/plantZ?page=2&&currentjob=2&&machine=2">
    @elseif( $job->lastItem() == 12)
    <meta http-equiv="REFRESH" CONTENT="10;url=/plantZ?page=3">
    @elseif( $job->lastItem() == 18)
    <meta http-equiv="REFRESH" CONTENT="10;url=/plantZ?page=4">
    @elseif( $job->lastItem() == 24)
    <meta http-equiv="REFRESH" CONTENT="10;url=/plantZ?page=5">
    @elseif( $job->lastItem() == 30)
    <meta http-equiv="REFRESH" CONTENT="10;url=/plantZ?page=6">
    @elseif( $job->lastItem() == 36)
    <meta http-equiv="REFRESH" CONTENT="10;url=/plantZ?page=7">
    @else
    <meta http-equiv="REFRESH" CONTENT="5;url=/plantZstat">
  @endif
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Titillium+Web" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<script>
window.onload = function() {
    "use strict";

    var month, day, setDay, setDate, setMonth,
        setHours, setMinutes, setSeconds, amPm, $;

    month = ['January', 'February', 'March', 'April',
        'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ]

    day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday',
        'Thursday', 'Friday', 'Saturday'
    ]


    function twelveHourTime() {
        setDay = new Date().getDay();
        setDate = new Date().getDate();
        setMonth = new Date().getMonth();
        setHours = new Date().getHours();
        setMinutes = new Date().getMinutes();
        setSeconds = new Date().getSeconds();

        $ = document.getElementById.bind(document);

        //hours
        if (setHours > 9) {
            if (setHours == 12) {
                $("h").innerHTML = setHours + ":";
                $("am-pm").innerHTML = "PM";
            } else if (setHours > 12 && setHours < 22) {
                $("h").innerHTML = "0" + (setHours - 12) + ":";
                $("am-pm").innerHTML = "PM";
            } else if (setHours > 21 && setHours <= 23) {
                $("h").innerHTML = (setHours - 12) + ":";
                $("am-pm").innerHTML = "PM";
            } else if (setHours > 9 && setHours < 12) {
                $("h").innerHTML = setHours + ":";
                $("am-pm").innerHTML = "AM";
            }
        } else {
            if (setHours == 0) {
                $("h").innerHTML = (setHours + 12) + ":";
                $("am-pm").innerHTML = "AM";
            } else if (setHours < 10 && setHours != 0) {
                $("h").innerHTML = "0" + setHours + ":";
                $("am-pm").innerHTML = "AM";
            }
        }

        //minutes
        if (setMinutes < 10)
            $("m").innerHTML = "0" + setMinutes;
        else
            $("m").innerHTML = setMinutes;

        //seconds
        if (setSeconds < 10)
            $("s").innerHTML = "0" + setSeconds;
        else
            $("s").innerHTML = setSeconds;

        //day of the week
        switch (setDay) {
            case 0:
                setDay = day[0];
                break;
            case 1:
                setDay = day[1];
                break;
            case 2:
                setDay = day[2];
                break;
            case 3:
                setDay = day[3];
                break;
            case 4:
                setDay = day[4];
                break;
            case 5:
                setDay = day[5];
                break;
            default:
                setDay = day[6];
        }

        //month
        switch (setMonth) {
            case 0:
                setMonth = month[0];
                break;
            case 1:
                setMonth = month[1];
                break;
            case 2:
                setMonth = month[2];
                break;
            case 3:
                setMonth = month[3];
                break;
            case 4:
                setMonth = month[4];
                break;
            case 5:
                setMonth = month[5];
                break;
            case 6:
                setMonth = month[6];
                break;
            case 7:
                setMonth = month[7];
                break;
            case 8:
                setMonth = month[8];
                break;
            case 9:
                setMonth = month[9];
                break;
            case 10:
                setMonth = month[10];
                break;
            default:
                setMonth = month[11];
        }

        //set date
        if (setDate < 10)
            $("date").innerHTML = setDay + " 0" + setDate +
            " " + setMonth;
        else
            $("date").innerHTML = setDay + " " + setDate +
            " " + setMonth;
    }
    setTimeout(twelveHourTime, -1000);
    setInterval(twelveHourTime, 1000);
}
</script>
<style>
#timeContainer1 {
    display: table-cell;
    vertical-align: right;
    /* border:1px solid red; */
    text-align: center;
}

#timeContainer2 {
    display: inline-table;
    /* border:1px solid blue; */

    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
}

.inline-block {
    display: inline-block;
    font-size: 400%;
    font-weight: bolder;
    /* border: 1px solid green; */
}

.block {
    font-size: 104%;
    display: block;
    font-weight: bolder;
    line-height: 115%;
    text-align: right;
}

#h-m-container {
    display: inline-block;
    /*    border: 1px solid yellow; */
    color: black;
    text-shadow: 0 1px white, 1px 0 white,
        -1px 0 white, 0 -1px white;
}

#s-ap-container {
    /*    border: 1px solid green; */
    display: inline-block;
}

#s {
    color: skyblue;
    font-size: 30px;
    text-shadow: 0 0.95px white, 0.95px 0 white,
        -0.95px 0 white, 0 -0.95px white;
}

#am-pm {
    color: black;
    text-shadow: 0 0.95px white, 0.95px 0 white,
        -0.95px 0 white, 0 -0.95px white;
}

#date {
    display: block;
    font-size: 100%;
    line-height: 0%;
}

#name {
    position: fixed;
    bottom: 0;
    /* border:1px solid green; */
    font-size: 60%;
    text-align: center;
    padding: 10px 0;
    width: 100%;
    height: 13%;
    color: grey;
    display: block;
}

.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: white;
    color: black;
    text-align: center;
}

.container {
    margin: auto;
    max-width: 800px;
    margin-top: 150px;
}

.text {
    padding: 50px;
    font-family: "Sans-Serif";
    color: #666;
}

.inputcontainer {
    position: relative;
}

input {
    width: 100%;
    box-sizing: border-box;
}

.icon-container {
    position: absolute;
    right: 10px;
    top: calc(50% - 10px);
}

.loader {
    position: relative;
    height: 20px;
    width: 20px;
    display: inline-block;
    animation: around 5.4s infinite;
}

@keyframes around {
    0% {
        transform: rotate(0deg)
    }

    100% {
        transform: rotate(360deg)
    }
}

.loader::after,
.loader::before {
    content: "";
    background: white;
    position: absolute;
    display: inline-block;
    width: 100%;
    height: 100%;
    border-width: 2px;
    border-color: #333 #333 transparent transparent;
    border-style: solid;
    border-radius: 20px;
    box-sizing: border-box;
    top: 0;
    left: 0;
    animation: around 0.7s ease-in-out infinite;
}

.loader::after {
    animation: around 0.7s ease-in-out 0.1s infinite;
    background: transparent;
}

</style>

<body>
    <!-- <script>
    jQuery(function() {
        jQuery('#auto').click();
    });
    </script>-->
    <div class="container-fluid">
        <br>
        <legend>
            <h1 style="font-family:Roboto">QR M&T Dashboard <span style=" color: green; display: block; float: right; text-align: right; background-color:green;color:white;font-size:40px; border-radius:7px;">&nbsp;Plant Z&nbsp;</span><input href="#" id="auto" onclick="$('#myModal').modal({'backdrop': 'static'});"
                    class="btn" hidden /></h1>
                    
        </legend>

        <div id="timeContainer2">
            <div id="timeContainer1">
                <span id="h-m-container">
                    <span style="font-size:80px" class="inline-block" id="h"></span>
                    <span style="font-size:80px" class="inline-block" id="m"></span>
                </span>
                <span id="s-ap-container">
                    <span class="block" id="s"></span>
                    <span class="block" id="am-pm"></span>
                </span>
                <span style="font-size:25px" id="date"> </span>
               
            </div>
        </div>

        </table>
        <style>
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
        </style>
        <div class="row">
            <div class="col-sm-12">
                <center>
                    <ul1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/socreate.png" /><a
                                style="color:black; font-size:16px">SO Created</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/assign.png" /><a
                                style="color:black; font-size:16px">Operator Assigned</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/printer.png" /><a
                                style="color:black; font-size:16px">Print Sticker</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/scan1.png" /><a
                                style="color:black; font-size:16px">Operator Scan</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/receive.png" /><a
                                style="color:black; font-size:16px">SPV Received</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/checked.png" /><a
                                style="color:black; font-size:16px">QA Checked</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/warehouse.png" /><a
                                style="color:black; font-size:16px">Warehouse Received</a></li1>
                    </ul1><br><br>
                </center>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
        <div id="table-container">
        <center>
                        <table style="width:100%; font-size:26px; color:black;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);">
                        <tr ><td colspan="6" style="color:black;background:#ebfcfc; width:100%;padding:15px; margin-top:0px; text-align:left; font-size:20px;">Task Today</td></tr>
                        @foreach($job as $jobs)
                          <tr>
                            <td style="color:black; padding:7px">{{$jobs->sonum}}</td>
                            <td style="color:black">{{$jobs->stockcode}}</td>
                            <td style="color:black">{{$jobs->seq}}</td>
                            <td style="color:black">
                            <?php $user3 = DB::table('users')->where('StaffID', '=', $jobs->asgnto)->get();?>
                            <?php 
                            foreach ($user3 as $user3)
                            if($jobs->printseal_by == NULL){
                                echo '<center>'.$user3->name.'<center>';
                            }elseif($jobs->printseal_by != NULL && $jobs->dt_opscancomplete == NULL){
                                echo '<center>'.$user3->name.'<center>';
                            }elseif($jobs->dt_opscancomplete != NULL && $jobs->spvscanrev_by == NULL){
                                echo '<center>'.$jobs->opasgn_by.'<center>';
                            }elseif($jobs->spvscanrev_by != NULL && $jobs->dt_qacheck == NULL){
                                echo "<center>QA</center>";
                            }elseif($jobs->dt_qacheck != NULL && $jobs->whackwrev_by == NULL){
                                echo "<center>Warehouse</center>";
                            }elseif($jobs->whackwrev_by != NULL){
                                echo "<center><span style=' color:black; border-radius:5px; font-size:24px; color:green'>&nbsp;All Received&nbsp;</span></center>";
                            }
                            ?>
                            </td>
                            <td>
                            <?php 
                            if($jobs->printseal_by == NULL){
                                echo "<center><span style='background-color:#0086b3; color:white; border-radius:5px'>&nbsp;Print Sticker&nbsp;</span></center>";
                            }elseif($jobs->printseal_by != NULL && $jobs->dt_opscancomplete == NULL){
                                echo "<center><span style='background-color:#208000; color:white; border-radius:5px'>&nbsp;Operator Scan&nbsp;</span></center>";
                            }elseif($jobs->dt_opscancomplete != NULL && $jobs->spvscanrev_by == NULL){
                                echo "<center><span style='background-color:#ff66cc; color:white; border-radius:5px'>&nbsp;SPV Received&nbsp;</span></center>";
                            }elseif($jobs->spvscanrev_by != NULL && $jobs->dt_qacheck == NULL){
                                echo "<center><span style='background-color:#ff6600; color:white; border-radius:5px'>&nbsp;QA Checked&nbsp;</span></center>";
                            }elseif($jobs->dt_qacheck != NULL && $jobs->whackwrev_by == NULL){
                                echo "<center><span style='background-color:#9999ff; color:white; border-radius:5px; font-size:24px'>&nbsp;Warehouse&nbsp;</span></center>";
                            }elseif($jobs->whackwrev_by != NULL){
                                echo "<center><span style=' color:black; border-radius:5px; font-size:24px; color:green'>&nbsp;All Received&nbsp;</span></center>";
                            }
                            ?>
                            </td>
                            <td>
                            <?php 
                            if($jobs->printseal_by == NULL){
                                echo "<center><span style='color:red; '>In Progress</span></center>";
                            }elseif($jobs->printseal_by != NULL && $jobs->dt_opscancomplete == NULL){
                                echo "<center><span style='color:red; '>In Progress</span></center>";
                            }elseif($jobs->dt_opscancomplete != NULL && $jobs->spvscanrev_by == NULL){
                                echo "<center><span style='color:red; '>In Progress</span></center>";
                            }elseif($jobs->spvscanrev_by != NULL && $jobs->dt_qacheck == NULL){
                                echo "<center><span style='color:red; '>In Progress</span></center>";
                            }elseif($jobs->dt_qacheck != NULL && $jobs->whackwrev_by == NULL){
                                echo "<center><span style='color:red; '>In Progress</span></center>";
                            }elseif($jobs->whackwrev_by != NULL){
                                echo "<center><span style='color:green; '>Completed</span></center>";
                            }
                            ?>
                            </td>
                          </tr>
                        @endforeach
                        </table>
                        {{$job->appends(request()->input())->links('pagination::bootstrap-4')}}
                        </center>
                    </div>
                    </table>
                    </div>
                    <div class="col-sm-3">
                <div class="card" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);">
                    <table style=" width:100%;  border-radius: 25px;">
                        <tr style="background:#ebfcfc;border-radius:5px;color:#498282; width:100%; ">
                            <td colspan="4">
                                <h4 style="color:black">&nbsp;&nbsp;Current Job</h4>
                            </td>
                        </tr>
                        <?php 
                        date_default_timezone_set("Asia/Kuala_Lumpur"); 
                        $date2 = date('Y-m-d'); 
                        $job2 = DB::table('qrmaster')->where('location', '=', 'Plant Z')->where('trx_status','A')->distinct()->paginate(2,['stockcode','sonum'],'currentjob'); ?>
                        @foreach ($job2 as $jobs2)
                        <tr style="border-radius:5px;color:#498282; width:100%;">
                            <td style="padding:5px">
                                <p style="padding:3px; margin-top:10px; text-align:right"><span
                                        style="background-color:yellow; color:black; font-size:24px">&nbsp;&nbsp;{{$jobs2->sonum}}&nbsp;&nbsp;</span>
                                </p>
                            </td>
                            <td colspan="3" style="padding:0px">
                                <p style="padding:3px; margin-top:10px; text-align:left"><span
                                        style="color:black; font-size:15px">&nbsp;&nbsp;{{$jobs2->stockcode}}&nbsp;&nbsp;</span>
                                </p>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                   
                </div>
           <br>
                <div class="card" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5);">
                    <table style=" width:100%;  border-radius: 25px;">
                        <tr style="background:#ebfcfc;border-radius:5px;color:#498282; width:100%; ">
                            <td colspan="4">
                                <h4 style="color:black">&nbsp;&nbsp;Machine</h4>
                            </td>
                        </tr>
                        <?php $user = DB::table('userqr')->where("location", "=", "Plant Z")->where("deviceId", "!=", NULL)->paginate(2,['*'],'machine'); ?>
                        @foreach ($user as $user)
                        <tr style="border-radius:5px;color:#498282; width:100%;">
                            <td style="padding:5px; size:24px">
                                <p style="padding:3px; margin-top:10px; text-align:right"><span
                                        style="background-color:yellow; color:black;padding:3px; font-size:24px">&nbsp;&nbsp;{{$user->deviceId}}&nbsp;&nbsp;</span>
                                </p>
                            </td>
                            <td  style="padding:5px">
                                <?php $user2 = DB::table('users')->where('StaffID', '=', $user->StaffID)->get(); ?>
                                @foreach ($user2 as $users2)
                                <p style="padding:3px; margin-top:10px; text-align:center">
                                <span style="color:black; font-size:24px">&nbsp;{{$users2->name}}&nbsp;
                               
                                </span>
                                </p>
                                @endforeach
                            </td>
                         <td style="text-align:left; color:black; font-size:24px">
                         <?php  
 $prints2 = DB::table('qrmaster')->where('asgnto','=', $user->StaffID)->where('trx_status','A')->count();
 $prints3 = DB::table('qrmaster')->where('asgnto','=', $user->StaffID)->where('dt_printseal','!=', NULL)->where('trx_status','A')->count();
 $prints4 = DB::table('qrmaster')->where('asgnto','=', $user->StaffID)->where('dt_opscancomplete','!=', NULL)->where('trx_status','A')->count();
 $prints5 = DB::table('qrmaster')->where('printseal_by','=', $user->StaffID)->where('dt_reprintseal','!=', NULL)->where('trx_status','A')->count();
 $prints6 = DB::table('qrmaster')->where('printseal_by','=', $user->StaffID)->where('trx_status','A')->count();
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
 <?php echo $prints4?>/<?php echo $prints2?>
                         </td>
                         <td style="text-align:left; ">
                            <?php $user3 = DB::table('userdevice')->where('StaffID', '=', $user->StaffID)->get(); ?>
                                @foreach ($user3 as $user3)
                                <?php    
                                if ($user3->deviceId != NUll)  { 
                                   echo  '<span class="dot"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                }else{
                                    echo  '<span class="dot2"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                }
                                ?>
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </table>
                 
                </div>
            </div>
        </div>
        <style>
        .dot {
            height: 15px;
            width: 15px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
        }
        .dot2 {
            height: 15px;
            width: 15px;
            background-color: red;
            border-radius: 50%;
            display: inline-block;
        }
        </style>
                <?php 
                        date_default_timezone_set("Asia/Kuala_Lumpur"); 
                        $date = date('Y-m-d'); 
                        $job3 = DB::table('qrmaster')->where('dt_opasgn', 'like', '%' .$date. '%')->where('trx_status','A')->get(); ?>
                <script>
                $(document).on('shown.bs.modal', function(e) {
                    $('[autofocus]', e.target).focus();
                });
                </script>
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content" style="border-radius: 5%;">
                            <div class="modal-body">
                                <center>
                                    <form action="/signdash" method="post">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <img style="height:150px; width:150px"
                                            src="{{ asset('/img/device/canva.png') }}">
                                        <br><br>
                                        Please Scan QR Code
                                        <table>
                                            <tr>
                                                <td>
                                                    <input type="password" name="signin" autofocus="autofocus"
                                                        onblur="this.focus()" required>
                                                </td>
                                            <tr>
                                            </tr>
                                            <td hidden><input class="btn btn-info" style="width:120px" type='submit'
                                                    value="signin" /></td>
                                            </tr>
                                        </table>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                       
                 
            </div>
        </div>
        <br>
    </div>
    <div class="footer">
        <p>&copy; Copyright 2019 Polyware Sdn Bhd</p>
    </div>
</body>
</html>