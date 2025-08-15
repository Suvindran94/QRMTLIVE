<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
   
    <title>QR M&T Dashboard</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu|Titillium+Web" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  @if( $stat->lastItem() == 13)
    <meta http-equiv="REFRESH" CONTENT="60;url=/plantMstat?page=2">
    @elseif( $stat->lastItem() == 26)
    <meta http-equiv="REFRESH" CONTENT="60;url=/plantMstat?page=3">
    @else
    <meta http-equiv="REFRESH" CONTENT="60;url=https://cars.ierp.tk/carsDashboardPlantM">
  @endif

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
            <h1 style="font-family:Roboto">QR M&T Dashboard <span style=" color: green; display: block; float: right; text-align: right; background-color:green;color:white;font-size:40px; border-radius:7px;">&nbsp;Plant M&nbsp;</span><input href="#" id="auto" onclick="$('#myModal').modal({'backdrop': 'static'});"
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
        tr:nth-child(even){
            background-color: #f2f2f2;
        }
        </style>
        
        <h1 style="font-family:Roboto; text-align:center; margin-top:35px;">TODAY STATISTIC</h1>
        <div class="row">
            <div class="col-sm-12">
                <?php 
                $stat = DB::table('qrmaster')
                 ->select('sonum', 'stockcode', 'pbag', 'deviceId')
                 ->groupBy( 'deviceId','sonum','stockcode', 'pbag')
                 ->where('asgnto', '!=', NULL)
					->where('location', '=', 'Plant M')
					->where('trx_status','A')
                 ->orderBy('deviceId', 'asc')->orderBy('sonum', 'asc')->orderBy('stockcode', 'asc')
                 ->paginate(10);
                ?>
                <table align="center">
                <tr>
                <td style="padding:10px"> <b>NO</b> </td>
                <td style="padding:10px"> <b>Machine</b> </td>
                <td style="padding:10px"> <b>Sonum</b> </td>
                <td style="padding:10px"> <b>Stockcode</b> </td>
                <td style="padding:10px"> <b>Per Ctn</b> </td>
                <td style="padding:10px"> <b>Total</b> </td>
                <td style="padding:10px"> <b>Assigned<br>Total</b> </td>
                <td style="padding:10px"> <b>Today OP<br>Completed</b> </td>
                <td style="padding:10px"> <b>SPV<br> Total</b> </td>
                <td style="padding:10px"> <b>Today SPV<br>Completed</b> </td>
                <td style="padding:10px"> <b>QA<br>Total</b> </td>
                <td style="padding:10px"> <b>Today QA<br>Completed</b> </td>
                <td style="padding:10px"> <b>WH<br>Total</b> </td>
                <td style="padding:10px"> <b>Total WH<br>Completed</b> </td>
                <td style="padding:10px"> <b>Remaining<br>Task</b> </td>
                </tr>
                <?php $i = 1; ?>
                @foreach ($stat as $stats)
                <tr>
                <td style="padding:5px; font-size:20px">{{$i++}} </td>
             
                <td style="padding:5px; font-size:20px">{{$stats->deviceId}} </td>
                <td style="padding:5px; font-size:20px">{{$stats->sonum}} </td>
                <td style="padding:5px; font-size:20px"> {{$stats->stockcode}}</td>
                <td style="padding:5px; font-size:20px"> <center>{{$stats->pbag}}</center></td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat2 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('asgnto', '!=', NULL)->where('trx_status','A')->count();
                    ?>
                    <?php echo '<center>'.ceil($stat2).'</center>'?>
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat2 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('asgnto', '!=', NULL)->where('trx_status','A')->count();
                    ?>
                    <?php echo '<center>'.ceil($stat2).'</center>'?>
                  
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat3 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('asgnto', '!=', NULL)->whereRaw('date(dt_opscancomplete) = CURDATE()')->where('trx_status','A')->count();
                    
                   if($stat3 > 0){
                       echo '<center><span class="dot">'.$stat3.'</span></center>';
                   }else{
                        echo '<center>'.$stat3.'</center>';
                   }
                   ?>
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat4 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('spvscanrev_by', '!=', NULL)->where('trx_status','A')->count();
                    ?>
                   
                    <?php echo '<center>'.$stat4.'</center>'?>
                  
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat5 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('dt_spvscanrev', '!=', NULL)->whereRaw('date(dt_spvscanrev) = CURDATE()')->where('trx_status','A')->count();
                     if($stat5 > 0){
                       echo '<center><span class="dot">'.$stat5.'</span></center>';
                   }else{
                        echo '<center>'.$stat5.'</center>';
                   }
                    ?>

                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat6 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('qacheck_by', '!=', NULL)->where('trx_status','A')->count();
                    ?>
                   
                    <?php echo '<center>'.$stat6.'</center>'?>
                  
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat6 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('qacheck_by', '!=', NULL)->whereRaw('date(dt_qacheck) = CURDATE()')->where('trx_status','A')->count();
                     if($stat6 > 0){
                       echo '<center><span class="dot">'.$stat6.'</span></center>';
                   }else{
                        echo '<center>'.$stat6.'</center>';
                   }
                    ?>
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat7 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('whackwrev_by', '!=', NULL)->where('trx_status','A')->count();
                    ?>
                   
                    <?php echo '<center>'.$stat7.'</center>'?>
                  
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php 
                         $stat8 = DB::table('qrmaster')->where('sonum', '=', $stats->sonum)->where('stockcode', '=', $stats->stockcode)->where('pbag', '=', $stats->pbag)->where('whackwrev_by', '!=', NULL)->whereRaw('date(dt_whackwrev) = CURDATE()')->where('trx_status','A')->count();
                     if($stat8 > 0){
                       echo '<center><span class="dot">'.$stat8.'</span></center>';
                   }else{
                        echo '<center>'.$stat8.'</center>';
                   }
                    ?>
                </td>
                <td style="padding:5px; font-size:20px"> 
                    <?php echo '<center>'.((ceil($stat2)) - ($stat7)).'</center>'?>
                </td>
                </tr>
                @endforeach
                </table>
                 <p style="text-align:center; font-size:13px">Showing {{ $stat->firstItem() }} to {{ $stat->lastItem() }} of total {{$stat->total()}} entries</p>
                <style>
                     .dot {
                        color:white;
                        height: 30px;
                        width: 30px;
                        background-color: green;
                        border-radius: 50%;
                        display: inline-block;
                        }
                </style>
            </div>
        </div>
    <div class="footer">
        <p>&copy; Copyright 2019 Polyware Sdn Bhd</p>
    </div>
</body>
</html>