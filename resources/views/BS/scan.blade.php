<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
  


 
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>


    <style type="text/css">
    .scanner-laser {
        position: absolute;
        margin: 40px;
        height: 30px;
        width: 30px;
    }

    .swal2-popup {
  font-size: 1.6rem !important;
}

    .laser-leftTop {
        top: 0;
        left: 0;
        border-top: solid red 5px;
        border-left: solid red 5px;
    }

    .laser-leftBottom {
        bottom: 0;
        left: 0;
        border-bottom: solid red 5px;
        border-left: solid red 5px;
    }

    .laser-rightTop {
        top: 0;
        right: 0;
        border-top: solid red 5px;
        border-right: solid red 5px;
    }

    .laser-rightBottom {
        bottom: 0;
        right: 0;
        border-bottom: solid red 5px;
        border-right: solid red 5px;
    }
    </style>
</head>
<body>
    <br>
    <div id="QR-Code" class="container" style="width:100%">
        <div class="panel panel-primary">
            <div class="panel-heading" style="display: inline-block;width: 100%;">	
				<table style="width:100%;">
					<tr>
						<td>
				<h3>{{$id2->name}}<h3>
					</td>
				
					<td>
                <div style="float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
					
                    <a href="https://ierp.tk/" type="button" class="btn btn-success btn-lg"
                        style="width:100px; margin-left:110px">Home</a>
                    <button id="play"  title="Play" type="button"
                        class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play"></span></button>
                </div>
					</td>
					</tr>
				</table>
            </div>
           
            <div class="panel-body">
                <div class="col-md-6" style="text-align: center;">
                    <legend>Data</legend>
                    
                    <?php $count = DB::table('userdevice')->where('deviceId', '=', $deviceId)->count(); 
                    
                    $array = array();
                    ?>

				<?php $count2 = DB::table('userdevice')->where('deviceId', '=', $deviceId)->get(); ?>

						@if($count != 0)
					<?php $getuser = DB::table('userdevice')->where('deviceId', '=', $deviceId)->pluck('StaffID'); ?>
					<?php $getusername = DB::table('users')->whereIn('StaffID',$getuser)->paginate(); ?>
					@endif
					
                   
                    <button type="button" class="btn btn-primary" data-toggle="modal">Total User
                        <?php 
                  if ( empty ( $count ) ) {
                    echo 0;
                 }else{
                    echo $count;
					  echo '<br>';
					  echo '|';
					  
					  	foreach($getusername as  $key=> $getuser)
					echo '&nbsp'.$getuser->fname.'&nbsp;'.'|';
				
					
					
                  }
						?>
					
				
			
					</button><br><br>

                  <?php
                 	if(empty($count2)){
					echo '<p>The Data is Empty, Please Check In first.</p>';
					}else{?>
                    @foreach($count2 as $count2)
                    <?php $try3 = DB::table('users')->where('StaffID', '=', $count2->StaffID)->get(); ?>
                    
                
                    
                    @foreach($try3 as $try3)  
                    <?php
                    $try4 = DB::table('qrmaster')

                    ->select('stockcode', 'sonum')
                     //->orderByRaw('LENGTH(stockcode)', 'ASC')->orderBy('stockcode', 'ASC')
                     //->orderByRaw('LENGTH(seq)', 'ASC')
                     //->orderBy('seq', 'ASC')
                        ->whereIn('status', ['ps','ao'])->where('deviceId', '=', $deviceId)

                        ->where('trx_status', 'A')
                        ->groupby('stockcode', 'sonum')
                     ->get();

                    
    

                    $try4count = DB::table('qrmaster')

                    ->select('stockcode', 'sonum')
                    //->orderByRaw('LENGTH(stockcode)', 'ASC')->orderBy('stockcode', 'ASC')
                    //->orderByRaw('LENGTH(seq)', 'ASC')
                    //->orderBy('seq', 'ASC')
                    ->whereIn('status', ['ps','ao'])->where('deviceId', '=', $deviceId)
                    ->where('trx_status', 'A')
                    ->groupby('stockcode', 'sonum')
                    ->count();
                          
                   
                   
                     foreach ($try4 as  $try4) 
                         $try2 = DB::table('qrmastersmb')
                     ->where('deleted_at', null)
                     ->where('sonum', '=', $try4->sonum)
                     ->where('stockcode', '=', $try4->stockcode)
                     ->where('asgnto', '=', $count2->StaffID)
                     ->where('deviceId', '=', $deviceId)
                     ->where('dt_opscancomplete', '!=', null)
                     ->where('qrcodesb', '=', null)
                     ->count();
                     
                    
                     if ($try4count == 0) {
                         echo 'Please Print Sticker';
                     } else {
                         $try5 = DB::table('moresolist')
                     ->where('sonum', '=', $try4->sonum)
                     ->where('stockcode', '=', $try4->stockcode)
                     ->first();
                     }
                

                   
                        $try6 = DB::table('qrmastersmb')
                        ->where('deleted_at', null)
                        ->distinct('stockcode', 'sonum')
                        ->select('stockcode', 'sonum', 'deviceId', 'asgnto')
                        ->where('deviceId', '=', $deviceId)
                       ->where('asgnto', '=', $count2->StaffID)
                        ->where('dt_printseal', '!=', null)
                        ->where('dt_opscancomplete', '=', null)
                        ->get();


                  
            
                        //Thisssssss line

               
                    
                   ?>
					
					<script>
						var numOfRows = <?php echo $try6; ?>;
				
					</script>
                  @foreach($try6 as $key => $try6)

					<?php
                        $array[]=$try6->sonum.''.$try6->stockcode;

                           $unscans = DB::table('qrmastersmb')
                                    ->where('deleted_at', null)
                                    ->where('sonum', '=', $try6->sonum)
                                    ->where('stockcode', '=', $try6->stockcode)
                                    ->where('dt_opscancomplete', '=', null)
                                    ->where('dt_printseal', '!=', null)
                                    ->get();
						  
						  
                    ?>
					
					<?php
                          $arrayunscan = array();
                                                  
                          foreach ($unscans as $x) {
                              if (array_key_exists($key, $arrayunscan)) {
                                  $getval = $arrayunscan[$key];
                                  $arrayunscan[$key] = $getval . ' '.'|'. ' '. $x->number;
                              } else {
                                  $arrayunscan[$key] = ' '.$x->number;
                              }
                          }
                          
                          ?>
                  
                 
                          <?php
                            $total = array_count_values($array);

                            $palletCheck = DB::table('moresolist')->where('sonum', $try6->sonum)->where('stockcode', $try6->stockcode)->first();
                           
                            if ($total[$try6->sonum.''. $try6->stockcode] > 1 && $palletCheck->uom2 == 'PALLET') {
					

                            }
                            else{
                            
                                
                            
                          ?>
                        <button type="button"  class="btn btn-primary checkunscan"  data-unscan="{{ $arrayunscan[$key]  }}"

							 data-sonum="{{ $try6->sonum  }}"
							 data-stk="{{ $try6->stockcode  }}"
							data-toggle="modal" data-target="#myBalances">
					 
                    <?php


                        $palletCheck = DB::table('moresolist')->where('sonum', $try6->sonum)->where('stockcode', $try6->stockcode)->first();

                  //  return dd($try5);
                           if (empty($try5)) {
                           } elseif ($palletCheck->uom2=='PALLET' && $palletCheck->smbAvailability=='Y') {
                               echo $palletCheck->uom2 ;
                           } else {
                               echo 'Small Bag ';
                    
                    
                               $try7 = DB::table('users')->where('StaffID', '=', $try6->asgnto)->get();
                            
                               foreach ($try7 as $try7) {
                                   echo $try7->name.':';
                               }
                           }
                    ?>
                 
                    
                    <?php

                    if ($palletCheck->uom2=='PALLET' && $palletCheck->smbAvailability=='Y') {
                        $try2 = DB::table('qrmastersmb')
                        ->where('deleted_at', null)
                        ->where('sonum', '=', $try6->sonum)
                        ->where('stockcode', '=', $try6->stockcode)
                        ->where('deviceId', '=', $deviceId)
                        ->where('dt_opscancomplete', '!=', null)
                        ->where('qrcodesb', '=', null)
                        ->count();
                    } else {
                        $try2 = DB::table('qrmastersmb')
                    ->where('deleted_at', null)
                    ->where('sonum', '=', $try6->sonum)
                    ->where('stockcode', '=', $try6->stockcode)
                    ->where('asgnto', '=', $count2->StaffID)
                    ->where('deviceId', '=', $deviceId)
                    ->where('dt_opscancomplete', '!=', null)
                    ->where('qrcodesb', '=', null)
                    ->count();
                    }

                     if (empty($try4)) {
                         echo 'Please Print Sticker 1';
                     } else {
                         $try5 = DB::table('moresolist')
                        ->where('sonum', '=', $try6->sonum)
                        ->where('stockcode', '=', $try6->stockcode)
                        ->get();
                         $try11 = DB::table('qrmaster')
                        ->where('sonum', '=', $try6->sonum)
                        ->where('stockcode', '=', $try6->stockcode)
                        ->where('status', '=', 'ps')
                        ->where('trx_status', '=', 'A')
                        ->count();
                       
                         $try12 = DB::table('qrmaster')
                        ->where('sonum', '=', $try6->sonum)
                        ->where('stockcode', '=', $try6->stockcode)
                        ->where('status', '=', 'ps')
                        ->where('trx_status', '=', 'A')
                        ->first();
                    
                         foreach ($try5 as $try5) {
                             $floor = floor($try5->total);
                             $totals = $try5->total - $floor;

                             if ($try11 > 1) {
                                 echo $try2.'/'.$try5->ttlpsmb.'<br>';
                             } elseif ($try11 = 1) {
                                 if ($totals == 0) {
                                     echo $try2.'/'.$try5->ttlpsmb.'<br>';
                                 } else {
                                     if ($try12 != '') {
                                         echo $try2.'/'.$try12->pbag.'<br>';
                                     } else {
                                         echo $try2.'/'.$try5->ttlpsmb.'<br>';
                                     }
                                 }
                             } elseif ($try11 = null) {
                                 echo $try2.'/'.$try5->ttlpsmb.'<br>';
                             }
                             echo $try6->stockcode;
                         }
                     }
                    
                    
                    ?>
                    </button>

                    <?php

                    }
?>
					
							<div class="modal fade" id="myBalances" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">UnScan Small Bag No.</h4>

						 <h4 class="modal-title2"></h4>
						 <h4 class="modal-title3"></h4>
                    </div>
                    <div class="modal-body">
                        <center>
						
							<textarea style="width:100%; text-align:center; border-style: solid;" rows= "3"; id="getunscan" readonly></textarea>

						<script>
						var check = <?php echo $unscans; ?>;
					
					</script>
						
						
							
					
						
                          
                                   
                                   

                                
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
					
					
                 @endforeach
                    @endforeach
                   @endforeach


                   <div class="modal fade" id="generalmodal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h2 class="modal-title">Insufficient Balance</h2>

						 <h4 class="modal-title2"></h4>
						 <h4 class="modal-title3"></h4>
                    </div>
                    <div class="modal-body">
                        <center>
						
						<table id="mytable" class="table" style="width:100%;">
  <thead class="thead-dark">
    <tr>
      <th scope="col" style="width:5%;">#</th>
      <th scope="col">Stockcode</th>
      <th scope="col" style="text-align:right;">Quantity</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
                        </center>
                    </div>
                    <div class="modal-footer">
                        <center>
                        <h3>You're unable to proceed! Please contact your Supervisor/Plant Manager!!</h3>
                        <button type="button" class="btn btn-success btn-lg" data-dismiss="modal">OK</button>
                        </center>
                    </div>
                </div>

            </div>
        </div>


                   <?php 

//print_r(array_count_values($array));

                   
                   
                   ?>
                   
                    <br><br>
                    <table style="border-collapse: collapse; width: 100%;  border: 1px solid black;" id="mytable2">
                        <tr style="border: 1px solid black;">
                            <th style="border: 1px solid black;text-align: center;">Name</th>
                            <th style="border: 1px solid black;text-align: center;">Sequence</th>
                            <th style="border: 1px solid black;text-align: center;">Sonum</th>
                            <th style="border: 1px solid black;text-align: center;">Stockcode</th>
                            <th style="border: 1px solid black;text-align: center;">Date Printed</th>
                            <th style="border: 1px solid black;text-align: center;">Status</th>
                        </tr>
                        @foreach($devices as $device)
                        <?php  //$users = DB::select('select * from users where StaffID = ?',[$device->StaffID]); ?>
						 <?php  $user = DB::table('users')->select('name')->where('StaffID',$device->StaffID)->first(); ?>
                      
                         @foreach($id as $ids)
                        <?php  
                            $users2 = DB::table('qrmaster')
                            ->orderByRaw('LENGTH(stockcode)', 'ASC')->orderBy('stockcode', 'ASC')
                            ->orderByRaw('LENGTH(seq)', 'ASC')
                            ->orderBy('seq', 'ASC')
                            ->where('printseal_by','=', $user->name)
                            ->where('deviceId','=', $ids->deviceId)
							->where('status','=','ps')
							->where('trx_status','=','A')
                             ->get();
                            ?>
                        @foreach($users2 as $user2)
                        <tr style="border: 1px solid black;">
                            <?php 
                            $users3 = DB::select('select * from users where name = ?',[$user2->printseal_by]);
                            foreach($users3 as $users3)
                            $users4 = DB::select('select * from userdevice where StaffID = ?',[$users3->StaffID]);
                            ['users4'=>$users4];
                            foreach($users4 as $users4)
                    if ($user2->dt_opscancomplete != NULL){
                            echo '<td style="border: 1px solid black;text-align: center; "hidden>'.$user2->printseal_by.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;" hidden>'.$user2->seq.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;"hidden>'.$user2->sonum.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;"hidden>'.$user2->stockcode.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;"hidden>'.$user2->dt_printseal.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;"hidden><img style="width:20px; height: 20px" src=/img/checked.png></td>';
                          }else{
                            echo '<td style="border: 1px solid black;text-align: center;">'.$user2->printseal_by.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;">'.$user2->seq.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;">'.$user2->sonum.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;">'.$user2->stockcode.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;">'.$user2->dt_printseal.'</td>';
                            echo '<td style="border: 1px solid black;text-align: center;" ><img style="width:20px; height: 20px" src=/img/cancel.png></td>';
                    }
                    ?>
                        </tr>
                       
                        @endforeach
                        @endforeach
                        @endforeach
						<?php } ?>
                    </table>
                </div><br>
                <div class="col-md-6" style="text-align: center;">

                    <div id="result" class="thumbnail">
                    @if (session()->has('message'))
                    <div class="alert alert-dismissable alert-success" style="font-size:25px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {!! session()->get('message') !!}

                    </div>
                    @endif
                    @if (session()->has('message2'))
                    <div class="alert alert-dismissable alert-danger" style="font-size:25px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {!! session()->get('message2') !!}

                    </div>
                    @endif
                    @if (session()->has('message3'))
                    <div class="alert alert-dismissable alert-warning" style="font-size:25px">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {!! session()->get('message3') !!}

                    </div>
                    @endif
                        <div class="well" style="position: relative;display: inline-block;">
                            
                            <img style="height:300px; width:450px"
                            src="{{ asset('/img/device/mobile.png') }}">
                        </div>
                        <div class="caption">
                            <h3>Scanned Result</h3>
                         
                                 @foreach($id as $ids)
                                 <input type='text' name='deviceId' id='deviceId' value="{{$ids->deviceId}}" hidden>
                                 @endforeach
                                <!-- Message -->
                                <table align="center" style='border-collapse: collapse;'>
                                    <tr>
                                        <td colspan="4">{{ csrf_field() }}</td>
                                    </tr>
                                    <tr>
                                       
                                        <td>
                                            <p id="scanned-QR" onchange="update" hidden></p>
                                            <input type="text" name="qrcode" id="qrcode" value="" placeholder="QR Code"
                                                autofocus="autofocus" onblur="this.focus()" style=" text-transform: lowercase;" required>
                                            <script type="text/javascript">
                                           // setInterval(update, 1);
                                           // function update() {
                                              //  var code_id_value = document.getElementById("scanned-QR").innerHTML;
                                            //    document.getElementById("code_id_value").value = code_id_value;
                                            //    var res = code_id_value.substr(17, 9);
                                             //   document.getElementById("res").value = res;
                                          //  }
                                          //  update();
                                            </script>
                                        </td>
                                        <input type='text' name='status' value="oc" hidden>
										   <input type='text' name='xenter' id='xenter' value="Y" hidden>
                                        <input type="hidden" name="_token" id="csrf" value="{{Session::token()}}" hidden>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                        <td ><br><input class="btn btn-success btn-lg" type='button' id="submitbtn" name='submit'
                                                value='Confirm'></td>
                                        <td><br><input type='text' name='dt_opscancomplete'
                                                value="<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>"
                                                hidden></td>
                                    </tr>
                                </table>
                                <script>
                                </script>
                    
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
		<style>
    .modalz {
        display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 10000000 !important;
            padding-top: 10px;
            /* Location of the box */
            left: 0;
            top: 0;
               width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading .modalz {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modalz {
    display: block;
}
</style>

<div class="modalz"></div>
</body>
	<script>
					$(document).ready(function() {

					
							  $(".checkunscan").click(function () {
							var id = $(this).data('unscan');
							var sonum = $(this).data('sonum');
							var stk = $(this).data('stk');
							
						
								  
								   $("#myBalances").modal("show");
							
							$('#getunscan').val(id);
							
							$('.modal-title2').html(sonum);
								$('.modal-title3').html(stk);
						
							
						});

                        function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}


						
							$(document).off("click").on("click", "#submitbtn", function(e) {
                                  e.preventDefault();
                               

									var qrcode = $('#qrcode').val();
                                    var deviceId = $('#deviceId').val();
                                    var status = "oc";
								
								
								
									if(qrcode != ''){
										
										$('#xenter').val('N')
										
										 $('#qrcode').prop('readonly', true);
                                    $.ajax({
											url: "/saveajax",
											type: "POST",
								
											data: {
												_token: $("#csrf").val(),
												qrcode: qrcode,
												deviceId: deviceId,
												status: status,
											},
											dataType: 'json',
											cache: false,
											success: function(dataResult) {
												
											},
											complete: function(dataResult) {

                                                $('#qrcode').val('').prop('readonly', false);

												if(dataResult.statusText != "parsererror"){
                                                  var message = dataResult.responseJSON.message;
                                                var type = dataResult.responseJSON.type;

                                                if(type == 'INFO'){
                                                    Swal.fire({
  icon: 'info',
  title: 'Oops...',
  html: message,
														  showConfirmButton: false,
  allowOutsideClick: false,
  allowEscapeKey: false
});

setTimeout(function() { 
    location.reload();
    }, 1500);
                                                }
                                                else if(type == 'ERROR'){
                                                    Swal.fire({
  icon: 'error',
  title: 'Whoops!',
  html: message,
														  showConfirmButton: false,
  allowOutsideClick: false,
  allowEscapeKey: false
});
setTimeout(function() { 
    location.reload();
    }, 1500);
                                                }
                                                else if(type == 'SUCCESS'){
                                                    Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success',
                                                    html: message,
														  showConfirmButton: false,
  allowOutsideClick: false,
  allowEscapeKey: false
                                                    });
                                                    setTimeout(function() { 
                                                        location.reload();
    }, 1500);
                                                }
                                                else if(type == 'BALANCE'){
                                                    $("#generalmodal").modal("show");
							
									if ($.fn.DataTable.isDataTable('#mytable')) {

										// Destroy existing table
										$('#mytable').DataTable().destroy();
										$('#mytable tbody').empty();
									}

											$.each(message, function(i, data) {

                                      

												var body = "<tr>";

												body += "<td>" + ++i + "</td>";

												body += "<td>" + data.RAWSTKCODE + "</td>";
												
												body += "<td style='text-align:right;'>" + addCommas(data.QTY) + "</td>";
	
												body += "</tr>";
												$("#mytable tbody").append(body);

											});

											$('#mytable').DataTable({
												"destroy": true,
												"lengthMenu": [
													[5, 10, 50, -1],
													[5, 10, 50, "All"]
												]
											});
		
                                                }
												}
                                              
											},
                                            error: function (xhr, ajaxOptions, thrownError) {
                                                $('#qrcode').val('').prop('readonly', false);
                                                Swal.fire({
                                                icon: 'error',
                                                title: 'Whoops!',
                                                html: "System Error! Please Contact BIS!",
                                                });

                                                setTimeout(function() { 
                                                //location.reload();
                                                }, 2500);
      }
										});
									}
								
								
							
						});


                        $body = $("body");
    $(document).on({
    ajaxStart: function() { $body.addClass("loading");},
    ajaxStop: function() { $body.removeClass("loading"); }    
});


							});
							
							
	</script>
<script>
var text = document.getElementById("scanned-QR");
var form = document.getElementById("myform");
	
$(document).keypress(function(e) {
	     var xenter = $('#xenter').val();
	
    if(e.which == 13 && xenter != 'N') {
  $('#submitbtn').trigger('click');
    }
});
	/*
	$("#qrcode").keyup(function(){

		var EMP = "emp";
		var QR = "QR";
		var QRSMB = "QRSMB";
		var string = this.value;

		if (string.includes(EMP) && this.value.length == 18) {
			$('#submitbtn').trigger('click');
		}
		else if(string.includes(QRSMB) && this.value.length >= 39){
			$('#submitbtn').trigger('click');
		}
		else if(string.includes(QR) && this.value.length >= 40){
			$('#submitbtn').trigger('click');
		}
	});
	*/
/*
	$("#qrcode").keyup(function(){
		if (this.value.length > 15) {
		$('#submitbtn').trigger('click');
		}
});
*/
	
/*
text.onkeyup = function() {
    if (text.value.length > 15) {
		console.log('OK');
        $('#submitbtn').trigger('click');
    }
}
*/
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/qrcodelib.js"></script>
<script type="text/javascript" src="js/WebCodeCam.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</html>