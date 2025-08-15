 <html>
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>QR Monitoring and Tracking System</title>
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
  

    <!-- jQuery Modal -->

</head>
@if( auth()->check() )
@include ('Navigation.'.auth()->user()->dept)
@endif

<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
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
</style>
	 		

<body>
    <br><br><br><br><br><br>
    <div class="container-fluid">
		<br>
		<br>
		<br>
        <div class="row">
          
            <div class="col-sm-6">
                <div class="card" style="margin-top:2em;">
                    <div class="card-header" style="background:#ebfcfc;border-radius:5px;color:#498282">
                    </div>
                    <div class="card-body" style="background:#fafafa">
                        @foreach ($lists as $list)
                        <table>
                            <tr>
                                <th>P/O NO</th>
                                <td></td>

                            </tr>
                            <tr>
                                <td>REFERENCE NO</td>
                                <td>{{$list->refnum}}</td>
                            </tr>
                            <tr>
                                <td>SHIPPING MARK</td>
                                <td>{{$list->shipmark}}</td>
                            </tr>
                            <tr>
                                <td>ISSUED BY</td>
                                <td>{{$list->issueby}}</td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card" style="margin-top:2em;">
                    <div class="card-header" style="background:#ebfcfc;border-radius:5px;color:#498282">
                    </div>
                    <div class="card-body" style="background:#fafafa">
                        @foreach ($lists as $list)
                        <table>
                            <tr>
                                <th>SALES ORDER NO</th>
                                <th>{{$list->sonum}}</th>
                            </tr>
                            <tr>
                                <td>DATE OF ISSUE</td>
                                <td>{{$list->dateissue}}</td>
                            </tr>
                            <tr>
                                <td>COMMITED DLT</td>
                                <td>{{$list->committeddlt}}</td>
                            </tr>
                            <tr>
                                <td>PAGE </td>
                                <td></td>
                            </tr>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card" style="margin-top:2em;"> 
					 @if(Session::has('message'))
                    <div class="card-header" style="background:#ff3c2e;border-radius:5px;color:#ffffff;font-weight:bolder;">
                       
                        <p>{{ Session::get('message') }}</p>
                       
                        <script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>
                    </div>
					 @endif
                    <div class="card-body" style="background:#fafafa">
                    <div class="container">
                    <form action="/search" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
            @foreach ($lists as $list)
            <input type="text" class="form-control" name="sonum" value="{{$list->sonum}}" hidden> 
            @endforeach
                <input type="text" class="form-control" name="stockcode"
                    placeholder="Search Stockcode" style="border-radius:5px" > <span class="input-group-btn">
                    <button type="submit" class="btn btn-success" hidden>
                      
                    </button>
                </span>
            </div>
        </form>
</div>

<center>
                        <table style="width:100%;">
                            <tr>
                                <th>No</th>
                                <th>Stock Code</th>
                                <th>Particular</th>
                                <th>Quantity</th>
                                <th>P/Bag</th>
                                <th>Total</th>
                                <th>Operator</th>
                                <th>Device ID</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                           <?php $i = 1; ?>
                            @foreach ($lists2 as $list2)
                            <tr>
                            <td>{{$i++}}</td>
                                <td  style="width:200px">{{$list2->stockcode}}</td>
                                <td>{{$list2->particular}}<br>{{$list2->particular2}}</td>
                                
                                <?php
                                $var4 = $list2->quantity;
                                $var5 = (int)$var4;
                                $var6 = $list2->pbag;
                                $var7 = (int)$var6;
                                $var8 = number_format($list2->kgnos, 4, '.', '');
                                $var9 = number_format($list2->ttlweight, 4, '.', '');
                                ?>
                                <td><?php echo $var5;?>{{$list2->uom}}</td>
                                <td><?php echo $var7;?>{{$list2->uom}}</td>
                              
                                <td>
                                <?php 
                                 $var = ($list2->quantity / $list2->pbag);
                                 $var = (int)$var;
                                 $var2 = ($list2->quantity %  $list2->pbag);
                                 $var3 = ($list2->quantity / $list2->pbag);
                                 if($var2 == 0){
                                    echo $var = (int)$var.''.$list2->uom2 ;
                                 }else{
                                    echo $var = (int)$var.''.$list2->uom2 ;
                                    echo '<br>';
                                    echo $var2 = ($list2->quantity %  $list2->pbag).''.$list2->uom;
                                 }
                                ?>
                                </td>
                                <td>
                                <center>
                                <form action="/editoperator" method="post">
									
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
								
								<input type='text' name='start' value='{{$list2->stickerStart}}' hidden>
							
								
								<input type='text' name='end' value='{{$list2->stickerEnd}}' hidden>
						
									
								<input type='text' name='sototal' value='{{$list2->SOTotal}}' hidden>
									
									
								@foreach ($lists as $list)
           					
            					
									
								<?php $customs = DB::table('template')->where('shipmark',$list->shipmark)->get(); 
									$sototal = $customs[0]->soTotalSeq; 
									$design = $customs[0]->design;
									
									if($design == 'default'){
									$custom = 'NO';
									}
									elseif($design == 'custom'){
									if($sototal == '1'){
									$custom = 'YES';
									}
									else{
									$custom = 'NO';
									}
									}
									?>
									
									 <input type="text" class="form-control" name="custom" value="{{$custom}}" hidden> 
									
									
									@endforeach
									
		
                                <input type='text' name='pbag' value="{{$list2->pbag}}" hidden>
                                <input type='text' name='quantity' value="{{$list2->quantity}}" hidden>
                                <?php $sticker = DB::table('qrmaster')->distinct()->get(['stockcode','sonum','asgnto','deviceId'])->where('stockcode','=', $list2->stockcode)->where('sonum','=', $list2->sonum);?>
                                @foreach ($sticker as $sticker)
                                <?php $user = DB::table('users')->get(['StaffID','name'])->where('StaffID','=', $sticker->asgnto); ?>
                                @foreach ($user as $users)
                                <p style="text-transform:uppercase;">{{ $sticker->asgnto }} - {{ $users->name}}</p>
                                @endforeach
                                @endforeach
                                <select style="margin-top:15px; text-transform:uppercase; width:200px;" class="ui dropdown" name='asgnto' required {{$list2->status2}}>
                               <option style="text-transform:lowercase;"value="" selected disabled>Select Operator</option>
                                @foreach ($lists3 as $list3)
                                <option value="{{$list3->StaffID}}">{{$list3->StaffID}} - {{$list3->name}}</option>
                                @endforeach
                                </select>
                                @foreach ($lists4 as $list4)
                                <input type='text' name='socreated_by' value="{{$list4->issueby}}" hidden>
                                <input type='text' name='dt_socreated' value="{{$list4->dateissue}}" hidden>
                                @endforeach
                                <div class="card" style=" height: 8.cm; width: 10.0cm" hidden>
                                <div class="card-body">
                                <table >
                                <tr>
                                <th width="50%">
                                <input type='text' name='sonum' value="{{$list2->sonum}}" >
                                <input type='text' name='total' value="{{ceil($var3)}}" >
                                <input type='text' name='stockcode' value="{{$list2->stockcode}}" >
                                <input type='text' name='status2' value='hidden' >
                                <input type='text' name='status3' value='display' >
                                <input type='text' name='status' value='ao' >
                                <input type='text' name='ttlsmb' value='{{$list2->ttlsmb}}' hidden >
                                <input type='text' name='psmb' value='{{$list2->psmb}}' hidden >
							
                                @if( auth()->check() )
                                <input type='text' name='opasgn_by' value="{{ auth()->user()->name }}">
                                @endif
                                <input type='text' name='dt_opasgn' value="<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>" hidden>
                                <?php
                                echo '</th>';
                                echo '</tr>';
                                echo '</table>';
                                echo '</div>';
                                echo '</div>';
                                ?>
                                </center>
                                </td>
                                <td>
                             
                                <?php 
                                if($list2->status2 != "hidden" ){
                              $device = DB::table('device')->where('location', '=', auth()->user()->location)->get(); 
                                echo '<select style="width:130px" class="ui dropdown" name="deviceId" id="deviceId'.$i.'" required >';
									echo '<option value="" selected disabled>Select Device</option>';
                                foreach ($device as $device){
                                echo '<option value="'.$device->deviceId.'">'.$device->deviceId.'</option>';
                                }
                                echo '</select>';
                            }else{
                                $device = DB::table('qrmaster')->where("stockcode", "=", $list2->stockcode)->where("sonum", "=",  $list2->sonum)->get();
                               
                                    echo $device[0]->deviceId;
                            
                            }
                                ?>
                               
                                </td>
                                <td style="text-align:center">

                                <input class="btn btn-warning butsave" style="width:120px" id="butsave" type='button' value="Save" data-stockcode = "{{$list2->stockcode}}" data-sonum = "{{$list2->sonum}}" data-id="{{$i}}" {{$list2->status2}}/> 
                                <input class="btn btn-warning" style="width:120px" id="{{$i}}" type='submit' value="Save" data-stockcode = "{{$list2->stockcode}}" data-sonum = "{{$list2->sonum}}" data-id="{{$i}}" {{$list2->status2}} hidden/> 
                                </form>

                                <form action="/sticker/" method="get">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type='text' name='sonum' value="{{$list2->sonum}}" hidden>
                                <input type='text' name='stockcode' value="{{$list2->stockcode}}" hidden>
                                <input class="btn btn-info" style="width:120px" type='submit' value="View Sticker" />
                                <?php
                                if( $list2->status2 == 'hidden'){
                                    if($list2->uom2 == 'PALLET'){
                                    echo '<a href=/reassignsmb/'.$list2->stockcode.'/'.$list2->sonum.' class="btn btn-danger" style="width:auto;padding-right:20px">Reassign Small Bag</a>';
                                    }
                                    echo '<a href=/addoperator/'.$list2->stockcode.'/'.$list2->sonum.' class="btn btn-success" style="width:auto">Add Operator</a>';
                                }else{
                                    echo '<a href=/addoperator/'.$list2->stockcode.'/'.$list2->sonum.' class="btn btn-success" style="width:120px" hidden>Add Operator</a>';
                                }
                                ?>
                                </form>

                              
                              
                       
                                </td>
                                </tr>
                                @endforeach
                                <tr>
                                <th colspan="8" style="text-align:right">Total Full Packing :
                                <?php
                                $sum = 0;
                                foreach ($lists2 as $list2){
                                $sum+= (($list2->quantity / $list2->pbag));
                                }
                                echo ceil($sum);
                                ?>
                                </th>
                                </tr>
                        </table>
                        </center>
                        {{$lists2->appends(request()->input())->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <br> <br> <br> <br>
</body>
				<script>

                    // COMMAS SPLIT
function addCommas(nStr) {
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
									 $(document).ready(function() {
										 $('.butsave').on('click', function() {


                                            var id = $(this).data('id');
                                            var device = $('#deviceId'+id).val();
                                            var stockcode = $(this).data('stockcode');
                                            var sonum = $(this).data('sonum');
                                            var btnid = $(this).data('btnid');

                             if(device != null){

                                            $.ajax({
                        type: "GET",
                        url: "/checkComponent",
                        async: true,
                        data: {
                            _token: $("#csrf").val(),
                            device: device,
                            stockcode: stockcode,
                            sonum: sonum
                        },
                        success: function (data) {
                            switch (data.type) {

                                case "success":
                                    this.disabled=true;
											 this.value='Saving...'; 
                                             $('#'+id).trigger('click');
                                break;


                                case "WO":
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        text: 'No WORK ORDER found for the '+sonum+' and '+stockcode+' !'
                                    });
                                break;

                                case "BALANCE":
                                    var myModal = new bootstrap.Modal(document.getElementById('generalmodal'));
                                    //myModal.show();
                                    myModal.show({ backdrop: 'static', keyboard: false });

                                    if ($.fn.DataTable.isDataTable('#mytable')) {
                                        $('#mytable').DataTable().destroy();
                                        $('#mytable tbody').empty();
                                    }

                                    $.each(data.message, function (i, data2) {
                                        var body = "<tr>";
                                        body += "<td>" + ++i + "</td>";
                                        body += "<td>" + data2.RAWSTKCODE + "</td>";
                                        body += "<td style='text-align:right;'>" + addCommas(data2.QTY) + "</td>";
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
                                    $("#overlay").fadeOut(300);
                                    /*
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        myModal.hide();
                                    }, 10000);
                                    */
                                    break;

                                default:
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        text: 'Something Wrong !'
                                    });
                                    break;
                            }
                        }
                    });
                }else{
                    alert('Please select Device!');
                }
                                            /*
												this.disabled=true;
											 this.value='Saving...'; 
											 this.form.submit();
                                             */
											   }); 
										    });
									</script>


<div class="modal fade" id="generalmodal" role="dialog">
            <div class="modal-dialog modal-lg">

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
                            <br>
                            <button type="button" class="btn btn-primary" onclick="location.reload()">Try Again</button>
                        </center>
                    </div>
                </div>

            </div>
        </div>
</html>