<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <head>
<style>
@page {
    size: 10cm 6.8cm;
}

@page {
    margin: 0px;
}

body {
    margin: 0px;
    font-family: arial;

}

#page {
    border-collapse: collapse;
}
/* And this to your table's `td` elements. */
#page td {
    padding: 0;
    margin: 0;

}
@font-face {
    font-family: arial;
    font-style: bold;

}
.page-break {
    page-break-after: always;
}
</style>
</head>

<body>

                     
                                      <table class="page-break" align="center"  style="margin-top: 5px; width:9cm" id="page">
										 
                                            <tr>
												   <?php
	
  	$stockcode = $qrmastersmb->stockcode;
    $stk = substr($stockcode,0,1);
	$stk2 = substr($stockcode,0,2);
	if($template->design == 'default'){
												 if($stk == '2'){
													 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$moresolist->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$moresolist->cat2_code.'.png" /></td>';
                                                if($template->penguinlogo == 0){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" /></td>';
                                                }
												 }elseif($stk == 'T'){
													 
												 if($stk == '2'){
													 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$moresolist->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$moresolist->cat2_code.'.png" /></td>';
                                                if($template->penguinlogo == 0){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/polyfuse.png" /></td>';
                                                }
												 }
													 elseif($stk == 'T'){
										  echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$moresolist->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/trading/'.$moresolist->cat2_code.'.png" /></td>';
                                                if($template->penguinlogo == 0){
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
                                                    <b>'.$moresolist->cat2_code.'</b></td>
                                                <td colspan="1" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$moresolist->cat2_code.'.png" /></td>';
                                                if($template->penguinlogo == 0){
                                                echo '<td colspan="2"  style="width:90px"><img style="height: 60px; width:70px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/pen.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="2"  style="width:90px"><img style="height: 60px; width:70px; text-align:center"
                                                        src="./img/barcodetemplate/pen.png" /></td>';
                                                }
												 
												 }
												 }else{
												 		 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$moresolist->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right; padding-left:5px; "><img style="height: 70px;  width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$moresolist->cat2_code.'.png" /></td>';
                                                if($template->penguinlogo == 0){
                                                echo '<td colspan="3" ><img style="height: 60px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/pen.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3" style="text-align:left; "><img style="height: 60px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/pen.png" /></td>';
                                                }
												 
												 }
	}else{
		 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$moresolist->cat2_code.'</b></td>
                                                  <td colspan="2" style="text-align:right;">';
		                                        if($stk == 'T'){
												echo '<img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/trading/'.$moresolist->cat2_code.'.png" />';
												}elseif($stk == '2'){
												echo '<img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/polyfuse/'.$stk2.'/'.$moresolist->cat2_code.'.png" />';
												}else{
												echo '<img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$moresolist->cat2_code.'.png" />';
												}
		echo '</td>';
												if($template->logo == ''){
												 if($stk == '2'){
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center; "
                                                        src="./img/barcodetemplate/logo/polyfuse.png" /></td>';
												 }
												else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center; "
                                                        src="./img/barcodetemplate/logo/pen.png" /></td>';							
												}
												}
												else{
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center; "
                                                        src="./img/barcodetemplate/logo/custom/'.$template->logo.'" /></td>';
												}                                    
	
	}
												
                                                ?>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                               <hr style="border:0.5px black solid; margin: 1px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-transform: uppercase; font-size:13px">
                                                    <b>{{$moresolist->particular}}</b></td>
                                            </tr>
										   <tr>
        <td colspan="6" style="text-transform: uppercase; font-size:14px"><b>{{$moresolist->particular2}}</b></td>
    </tr>
                                            <tr>

                                                <td colspan="2" style="text-transform: uppercase; font-size:13px"><b>QTY
                                                        :
                                                        {{$qrmastersmb->psmb}} {{$moresolist->uom}}</b></td>												<td style="text-align:center; font-size:14px;" colspan="2"><b>@if($template->custStkID == '0') @else {{$moresolist->ARStkCode}} @endif</b></td>

                                               <td style="text-align:center; font-size:14px; text-align:right" colspan="5"><b>{{$qrmastersmb->number}}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:1px; border:0.5px black solid">
                                                </td>
                                            </tr>
                                            <tr style="margin:0px;">
                                                <td style="font-size:10px"><b>S/O : {{$qrmastersmb->sonum}}</b></td>



                                                 <?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $qrmastersmb->sonum);?>
    
        <td style="font-size:10px;text-align:center; text-align:right" colspan="5"><b>S/M : {{$solist->shipmark}}</b>
        </td>


                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:2px; border:0.5px black solid">
                                                </td>
                                            </tr>
										  
										         
										      <tr style="margin:0px;">
                                                <td colspan="6" style="font-size:10px; text-transform: uppercase;"><b>{{$qrmastersmb->stockcode}}</b></td>
                                            </tr>
										  @if($template->qrwebsite == 0)
                                            <tr style="margin:0; ">
												
											
												<?php
    $stk = substr($qrmastersmb->stockcode,0,1);
												if($stk == '2'){
													$newDateFormat3 = \Carbon\Carbon::parse($qrmastersmb->dt_printseal)->format("d/m/Y");
                                                echo '<td colspan="1"  style="font-size:9px;  height:30px;text-transform: uppercase;  " >
                                                  

                                                    <b> QC BY : '.$qrmastersmb->asgnto.'</b><br>
                                                    <b>
														
														DATE : '.$newDateFormat3.'</b>
													<br>
                                                </td>


                                                <td colspan="2" style="text-align:right; ">';

                                                if($template->bmlogo == 1){
                                                    $margin = '5px';
                                                }else{
                                                    $margin = '50px';
                                                }
                                                  
                                                if($template->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:5px;visibility:hidden" src="./img/barcodetemplate/qr.png" hidden/>';
                                                }else{
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:'.$margin.'" src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($template->bmlogo == 0){
                                                    echo '<img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px;visibility:hidden" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                           
                                                  echo'<p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="3">';
													
												 if($template->isologo == 0){
                                                    echo ' <img style="height:40px;width:70px;  position: absolute; margin-left:8px;
top: 4;visibility:hidden" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:40px;width:70px;  position: absolute; margin-left:8px;
top: 4;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }											
													  $png = QrCode::format('png')->generate($qrmastersmb->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-left:80px; position: absolute;
top: 0;width:70px; height:70px; 'src='data:image/png;base64," . $png . "'>";
      
												echo '</td>';
												}else{
																	$newDateFormat3 = \Carbon\Carbon::parse($qrmastersmb->dt_printseal)->format("d/m/Y");
                                                echo '<td colspan="1"   style="font-size:9px;  height:30px;text-transform: uppercase;">
                                                 

                                                    <b> QC BY : '.$qrmastersmb->asgnto.'</b><br>
                                                    <b>
														
														DATE : '.$newDateFormat3.'</b>
													<br><br><br><br><br>
                                                </td>

 					
                                                <td colspan="2" style="text-align:right;">';

                                                if($template->bmlogo == 1){
                                                    $margin = '5px';
                                                }else{
                                                    $margin = '50px';
                                                }
                                             
                                                if($template->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:5px;visibility:hidden" src="./img/barcodetemplate/qr.png" hidden/>';
                                                }else{
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:'.$margin.'" src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($template->bmlogo == 0){
                                                    echo '<img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px;visibility:hidden" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:40px;position: absolute;top:4; margin-left:130px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                           
                                                  echo'<p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="2">';
													
												 if($template->isologo == 0){
                                                    echo ' <img style="height:40px;width:70px;  position: absolute; margin-left:8px;
top: 4;visibility:hidden" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:40px;width:70px;  position: absolute; margin-left:8px;
top: 4;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }											
													  $png = QrCode::format('png')->generate($qrmastersmb->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-left:80px; position: absolute;
top: 0;width:70px; height:70px; 'src='data:image/png;base64," . $png . "'>";
      
												echo '</td>';
												}
												
												
													?>
                                           </tr>
										  @else
										                                              <tr style="margin:0; ">
												
											
												<?php
    $stk = substr($qrmastersmb->stockcode,0,1);
												if($stk == '2'){
													$newDateFormat3 = \Carbon\Carbon::parse($qrmastersmb->dt_printseal)->format("d/m/Y");
                                                echo '<td colspan="1"  style="font-size:9px;  height:30px;text-transform: uppercase;  " >
                                                  

                                                    <b> QC BY : '.$qrmastersmb->asgnto.'</b><br>
                                                    <b>
														
														DATE : '.$newDateFormat3.'</b>
													<br>
                                                </td>


                                                <td colspan="2" style="text-align:right; ">';
                                                if($template->bmlogo == 1){
                                                    $margin = '5px';
                                                }else{
                                                    $margin = '50px';
                                                }
                                                  
                                                if($template->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:5px;visibility:hidden" src="./img/barcodetemplate/qr.png" hidden/>';
                                                }else{
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:'.$margin.'" src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($template->bmlogo == 0){
                                                    echo '<img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px;visibility:hidden" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                           
                                                  echo'<p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="3">';
													
												 if($template->isologo == 0){
                                                    echo ' <img style="height:40px;width:70px;  position: absolute; margin-left:8px;
top: 4;visibility:hidden" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:40px;width:70px;  position: absolute; margin-left:8px;
top: 4;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }											
													  $png = QrCode::format('png')->generate($qrmastersmb->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-left:80px; position: absolute;
top: 0;width:70px; height:70px; 'src='data:image/png;base64," . $png . "'>";
      
												echo '</td>';
												}else{
																	$newDateFormat3 = \Carbon\Carbon::parse($qrmastersmb->dt_printseal)->format("d/m/Y");
                                                echo '<td colspan="1"   style="font-size:9px;  height:30px;text-transform: uppercase;">
                                                 

                                                    <b> QC BY : '.$qrmastersmb->asgnto.'</b><br>
                                                    <b>
														
														DATE : '.$newDateFormat3.'</b>
													<br><br><br><br><br>
                                                </td>

 					
                                                <td colspan="2" style="text-align:right;">';

                                                if($template->bmlogo == 1){
                                                    $margin = '5px';
                                                }else{
                                                    $margin = '50px';
                                                }
                                             
                                                if($template->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:5px;visibility:hidden" src="./img/barcodetemplate/qr.png" hidden/>';
                                                }else{
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:'. $margin .'" src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($template->bmlogo == 0){
                                                    echo '<img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px;visibility:hidden" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                           
                                                  echo'<p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="3">';
													
												 if($template->isologo == 0){
                                                    echo ' <img style="height:50px;width:70px;  position: absolute; margin-left:8px;
top: 4;visibility:hidden" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:70px;  position: absolute; margin-left:8px;
top: 4;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }											
													  $png = QrCode::format('png')->generate($qrmastersmb->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-left:80px; position: absolute;
top: 0;width:70px; height:70px; 'src='data:image/png;base64," . $png . "'>";
      
												echo '</td>';
												}
												
												
													?>
                                           </tr>
										  @endif

                                        
                                        </table>

                                  

                                        </body>

</html>



