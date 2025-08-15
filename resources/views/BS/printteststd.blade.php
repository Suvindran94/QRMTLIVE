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



@foreach ($prints as $print)
@foreach ($prints2 as $print2)
<?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $print2->sonum);
$character = strlen($print2->particular);
$character2 = strlen($print2->particular2);?>
@foreach ($sticker as $sticker)
<?php $edit = DB::table('template')->where('shipmark', '=' ,$sticker->shipmark)->get();?>
@foreach ($edit as $edits)


                     
                                      <table class="page-break" align="center"  style="margin-top: 5px; width:9cm" id="page">
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
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
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
                                                echo '<td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
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
												 }else{
												 		 echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right; padding-left:5px; "><img style="height: 70px;  width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
                                                echo '<td colspan="3" ><img style="height: 60px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/pen.png" hidden /></td>';
                                                }else{
                                                echo '<td colspan="3" style="text-align:left; "><img style="height: 60px; width:150px; text-align:center"
                                                        src="./img/barcodetemplate/logo/pen.png" /></td>';
                                                }
												 
												 }
												 }
		 else{
												 		  echo
                                                '<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>'.$print2->cat2_code.'</b></td>
                                                <td colspan="2" style="text-align:right; padding-left:5px; "><img style="height: 70px;  width:90px; text-align:center;"
                                                        src="./img/penguin/'.$stk2.'/'.$print2->cat2_code.'.png" /></td>';
                                                if($edits->penguinlogo == 0){
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
                                               
                                                      if($edits->logo == ''){
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
                                                        src="./img/barcodetemplate/logo/custom/'.$edits->logo.'" /></td>';
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
												@if($character >= 47)
                                                <td colspan="6" style="text-transform: uppercase; font-size:10.5px">
                                                    <b>{{$print2->particular}}</b></td>
												@else
												<td colspan="6" style="text-transform: uppercase; font-size:12px">
                                                    <b>{{$print2->particular}}</b></td>
												@endif
                                            </tr>
										   <tr>
											   	@if($character2 >= 47)
                                                <td colspan="6" style="text-transform: uppercase; font-size:11px">
                                                    <b>{{$print2->particular2}}</b>
											   	</td>
												@else
												<td colspan="6" style="text-transform: uppercase; font-size:12px">
                                                    <b>{{$print2->particular2}}</b>
											   	</td>
											   @endif
    										</tr>
                                            <tr>

                                                <td colspan="2" style="text-transform: uppercase; font-size:12px"><b>QTY
                                                        :
                                                        {{$print->pbag}} {{$print2->uom}} / {{$print2->uom2}}</b></td>
												<td style="text-align:center; font-size:14px;" colspan="2"><b>@if($edits->custStkID == '0') @else {{$print2->ARStkCode}} @endif</b></td>
                                               <td style="text-align:center; font-size:14px; text-align:right" colspan="5"><b>{{$print->seq}}</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:1px; border:0.5px black solid">
                                                </td>
                                            </tr>
                                            <tr style="margin:0px;">
                                                <td style="font-size:10px"><b>S/O : {{$print->sonum}}  </b></td>



                                                 <?php $sticker = DB::table('solist')->get(['shipmark','sonum'])->where('sonum','=', $print->sonum);
	
												?>
        @foreach ($sticker as $sticker1)
				<td style="font-size:14px;text-align:center; text-align:right" colspan="5"><b style="margin-right:20px"> @if($edits->soTotalSeq == '0') @else {{$print->soTotalSeq}} @endif </b> <b style="font-size:10px">S/M : {{$sticker1->shipmark}}</b>
        </td>
        @endforeach

                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:2px; border:0.5px black solid">
                                                </td>
                                            </tr>
										     <tr style="margin:0px;">
                                                <td colspan="6" style="font-size:10px;text-transform: uppercase;"><b>{{$print->stockcode}}</b></td>
                                            </tr>
                                            <tr style="margin:0">
                                                 <td colspan="1" style="font-size:9px;  height:auto;text-transform: uppercase; ">
                                                 

                                                    <b> QC BY : {{$print->asgnto}}</b><br>
                                                    <b>
														<?php $newDateFormat3 = \Carbon\Carbon::parse($print->dt_printseal)->format("d/m/Y"); ?>
														DATE : {{$newDateFormat3}}</b>
													<br>
                                                </td>


                                            @if($edits->qrwebsite == 0)
												
                                                <td colspan="2" style="text-align:right;">
                                                    <?php
													if($edits->bmlogo == 1){
                                                    $margin = '5px';
                                                }else{
                                                    $margin = '50px';
                                                }
                                                if($edits->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:5px; visibility:hidden;" src="./img/barcodetemplate/qr.png" hidden />';
										
                                                }else{
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:'.$margin.'"  src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($edits->bmlogo == 0){
                                                    echo '<img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px; visibility:hidden;" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:40px;position: absolute;top:4; margin-left:130px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                                ?>
                                                  <p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="2">
													<?php
												 if($edits->isologo == 0){
                                                    echo ' <img  style="height:40px;width:70px;   position: absolute; margin-left:8px;
top: 4; visibility:hidden;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img  style="height:40px;width:70px;   position: absolute; margin-left:8px;
top: 4;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }
													?>
	<?php
	$png = QrCode::format('png')->generate($print->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-left:80px; position: absolute;
top: 0;width:70px; height:70px; 'src='data:image/png;base64," . $png . "'>";
   ?>
												</td>
												@else
												  <td colspan="2" style="text-align:right;">
                                                    <?php
													  if($edits->bmlogo == 1){
                                                    $margin = '5px';
                                                }else{
                                                    $margin = '50px';
                                                }
                                                if($edits->qrwebsite == 0){
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:'.$margin.'; visibility:hidden;" src="./img/barcodetemplate/qr.png" hidden />';
										
                                                }else{
                                                    echo '<img style="height:35px;width:35px;position: absolute;top:4;margin-left:5px"  src="./img/barcodetemplate/qr.png" />';
                                                }
                                                if($edits->bmlogo == 0){
                                                    echo '<img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px; visibility:hidden;" src="./img/barcodetemplate/logo/mly.png" hidden/>';
                                                }else{
                                                    echo ' <img style="height:45px;width:40px;position: absolute;top:4; margin-left:50px" src="./img/barcodetemplate/logo/mly.png" />';
                                                }
                                               
                                                ?>
                                                  <p style="font-size:0px;   text-transform: lowercase;margin-top:5px">www.polyware.com.my</p>
                                                </td>
												<td colspan="3">
													<?php
												 if($edits->isologo == 0){
                                                    echo ' <img  style="height:40px;width:70px;   position: absolute; margin-left:8px;
top: 4; visibility:hidden;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" hidden/>';
                                                }else{
                                                    echo ' <img  style="height:40px;width:70px;   position: absolute; margin-left:8px;
top: 4;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" />';
                                                }
													?>
	<?php
	$png = QrCode::format('png')->generate($print->qrcode);
    $png = base64_encode($png);
        echo "<img style='margin-left:80px; position: absolute;
top: 0;width:70px; height:70px; 'src='data:image/png;base64," . $png . "'>";
   ?>
												</td>
												@endif
                                            </tr>
                                      
                                        </table>

                                  
@endforeach
@endforeach
@endforeach
@endforeach
