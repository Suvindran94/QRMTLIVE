<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Barcode System</title>

    <link rel="stylesheet" type="text/css" href="css/common.css" />
    <link rel="stylesheet" type="text/css" href="css/style11.css" />

    <script type="text/javascript" src="js/modernizr.custom.79639.js"></script>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <script src="js/html2canvas.min.js" type="text/javascript"></script>
    <script src="js/html2canvas.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>

</head>
@if( auth()->check() )
@include ('Navigation.'.auth()->user()->dept)
@endif

<body>

    <style>
    body {
        font-family: Arial;
        background-image: url('/img/back.jpg');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #464646;
    }

    #divResize,
    #divResize1,
    #divResize2,
    #divResize3,
    #divResize4,
    #divResize5,
    #divResize6 {
        width: 120px;
        height: 120px;
        padding: 5px;
        margin: 5px;
        font: 13px Arial;
        cursor: move;
        background-color: white;
    }

    .card1 {}

    .card1:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.8);
    }

    table {
        font-family: arial, sans-serif;

    }

    a {
        text-transform: uppercase;
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
    </style>
    <br><br><br><br><br><br><br><br>
    <br>
    <center>
        <div id="html-content-holder">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
   @foreach ($prints as $print)
@foreach ($prints2 as $print2)
<?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $print2->sonum);?>
@foreach ($sticker as $sticker)
<?php $edit = DB::table('template')->where('shipmark', '=' ,$sticker->shipmark)->get();?>
@foreach ($edit as $edits)
<table class="page-break" align="center" border="0px" style="margin-top: 5px; width:10.5cm; background-color:white" id="page">
    <tr>
												   <?php
	
  	$stockcode = $print2->stockcode;
    $stk = substr($stockcode,0,1);
	$stk2 = substr($stockcode,0,2);
	if($edits->design == 'default'){
												 if($stk == '2'){
													 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" /></td>';
                                                }
												 }
		 else if($stk == '6'){
													 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/penpipe.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/penpipe.png" /></td>';
                                                }
												 }
		elseif($stk == 'T'){
											 if($stk == '2'){
													 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" /></td>';
                                                }
											 }elseif($stk == 'T'){
										  echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/trading/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" /></td>';
                                                }
										 }
												 else{
												 		 echo
                                                '<td colspan="2"style="background-color:black; border: 5px solid white; color:white;  width:180px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="1" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="2"  style="width:90px"><img style="height: 60px; width:70px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/pen.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="2"  style="width:90px"><img style="height: 60px; width:70px; text-align:center"
                                                        src="./img/barcodetemplate/pen.png" /></td>';
                                                }
												 
												 }
												 }
		else{
												 		 echo
                                                '<td colspan="2"style="background-color:black; border: 5px solid white; color:white;  width:180px; font-size:40px; text-align:center;">
                                                   <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="1" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="2"  style="width:90px"><img style="height: 60px; width:70px; text-align:center"
                                                        src="./img/barcodetemplate/pen.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="2"  style="width:90px"><img style="height: 60px; width:70px; text-align:center"
                                                        src="./img/barcodetemplate/pen.png" /></td>';
                                                }
												 
												 }
	}else{
	 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;">';
												if($stk == 'T'){
												echo '<img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/trading/'.$print2->cat2_code.'.png" />';
												}elseif($stk == '2'){
												echo '<img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$print2->cat2_code.'.png" />';
												}else{
												echo '<img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$print2->cat2_code.'.png" />';
												}
														echo '</td>';
                                               
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center; "
                                                        src="./img/barcodetemplate/logo/custom/'.$edits->logo.'" /></td>';
	}
					
												
                                                ?>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                               <hr style="border:0.5px black solid; margin: 1px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-transform: uppercase; font-size:14px">
                                                    <b>{{$print2->particular}}</b></td>
                                            </tr>
										   <tr>
        <td colspan="6" style="text-transform: uppercase; font-size:14px"><b>{{$print2->particular2}}</b></td>
    </tr>
                                            <tr>

                                                <td colspan="2" style="text-transform: uppercase; font-size:13px"><b>QTY
                                                       <?php 
													$count = $print2->pbag - $print->pbag?>
                                                        :@if($count >= $print->pbag)
													 {{$print->pbag}} {{$print2->uom}}
                                                        
													@else
													{{$print->pbag}} {{$print2->uom}} / {{$print2->uom2}}
													
													@endif</b></td>
                                               <td style="text-align:center; font-size:14px; text-align:right" colspan="5"><b>{{$print->seq}}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:1px; border:0.5px black solid">
                                                </td>
                                            </tr>
                                            <tr style="margin:0px;">
                                                <td style="font-size:10px"><b>S/O : {{$print->sonum}}</b></td>



                                                 <?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $print->sonum);?>
        @foreach ($sticker as $sticker1)
        <td style="font-size:10px;text-align:center; text-align:right" colspan="5"><b>S/M : {{$sticker1->shipmark}}</b>
        </td>
        @endforeach

                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:2px; border:0.5px black solid">
                                                </td>
                                            </tr>
                                            <tr style="margin:0">
                                                <td style="font-size:9px; text-transform: uppercase;" >
                                                    <b>{{$print->stockcode}}</b><br>

                                                    <b> QC BY : {{$print->asgnto}}</b><br>
                                                    <b>
														
														DATE : </b>
													<br><br><br><br><br>
                                                </td>


                                                <td ccolspan="2" style="margin-top:10px; text-align:right">
                                                    <?php
                                                if($edits->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;  margin-left:8px" src="./img/barcodetemplate/qr.png" hidden/>';
                                                }else{
                                                    echo '<img style="height:35px;width:35px;  margin-left:8px" src="./img/barcodetemplate/qr.png" src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($edits->bmlogo == 0){
                                                    echo '<img style="height:35px;width:35px" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:35px;width:35px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                                ?>
                                                  <p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="3">
													<?php
												 if($edits->isologo == 0){
                                                    echo ' <img style="height:45px;width:80px; margin-bottom:25px" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:80px; margin-bottom:25px" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }
													?>
													<?php
													  $png = QrCode::format('png')->generate($print->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-top:0px; width:60px; height:60px; margin-bottom:25px' src='data:image/png;base64," . $png . "'>";
        ?>
												</td>
                                            </tr>
                                      
    
</table>
@endforeach
@endforeach
@endforeach
@endforeach
                        <br>
                        {{$prints->appends(request()->input())->links('pagination::bootstrap-4')}}
                    </div>
                </div>        
            </div>  
        </div> 
    </center>
    </div>
    <br>
    </div>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="js/index.js"></script>
</body>
</html>