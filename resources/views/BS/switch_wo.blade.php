<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>

   
    <script src="{{asset('js2/jquery.min.js')}}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="icon" href="{!! asset('/img/ICONT.png') !!}" />
    <script src="{{asset('js2/bootstrap2.min.js')}}"></script>
    <!DOCTYPE html>

    <html>

    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS CDN -->
        
         <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}"> 
         
            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

            <!-- Include Bootstrap JavaScript -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
        
        <link rel="stylesheet" href='https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css' /> 
        <!-- Our Custom CSS -->

        <!-- Scrollbar Custom CSS -->


        <script src="{{asset('js/solid.js')}}"></script>
        <script src="{{asset('js/fontawesome.js')}}"></script>
        <script src ="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>

    <?php 
                            use Carbon\Carbon;
                            $my_var = url()->current();
                            use App\User;
                       
     ?>

<body>

    <style>
    body {
        background-image: url('/img/back.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
    }

    #myInput {
        background-image: url('img/search2.png');
        background-position: 0px 1px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 15px;
        padding: 5px 16px 5px 36px;
        border: 1px solid #ddd;
        border-radius: 20px;
        margin-top: 4px;
    }
    </style>
    <link rel="stylesheet" href="css/style31.css">
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i style="margin-top:10px" class="fas fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3>QR M&T</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <?php
								if (Auth::check())
								$name = auth()->user()->dept;
								$name2 = auth()->user()->role;
								if($name === "4" && $name2 === "21"){
									echo '<a href="/BShomesu"><img style="height:35px; width:35px"
                                    src=/img/BSicon/house.png>&nbsp;&nbsp;Home</a>';
								}
						else if($name == "8"){
								echo '<a href="/BShome8"><img style="height:35px; width:35px"
                                    src=/img/BSicon/house.png>&nbsp;&nbsp;Home</a>';
							}
							else{
								echo '<a href=/BShome'.$name.'><img style="height:35px; width:35px"
                                src=/img/BSicon/house.png>&nbsp;&nbsp;Home</a>';
							    }
						?>

                </li>
                @if( auth()->check() )
                <?php
                if (auth()->user()->role == "16") {
                echo "<li hidden>";
                echo '<a href="/view-records">'; 
                echo '<img style="height:35px; width:35px" src="/img/BSicon/barcodelist2.png" />';
                echo "&nbsp;&nbsp;Sales Order List";
                echo "</a>";
                echo "</li>";
                echo "<li>";
                echo '<a href="/scan"> <img style="height:35px; width:35px"src="/img/BSicon/qr.png">&nbsp;&nbsp;Scan</a>';
                echo "</li>";            
                }
				else if(auth()->user()->dept == "8"){
				 echo "<li>";
                echo '<a href="/live_search2">'; 
                echo '<img style="height:35px; width:35px" src="/img/BSicon/barcodelist2.png" />';
                echo "&nbsp;&nbsp;Sales Order List";
                echo "</a>";
                echo "</li>";
               
				}
				else{
                echo "<li>";
                echo '<a href="/live_search2">'; 
                echo '<img style="height:35px; width:35px" src="/img/BSicon/barcodelist2.png" />';
                echo "&nbsp;&nbsp;Sales Order List";
                echo "</a>";
                echo "</li>";
                echo "<li>";      
                echo '<a href="/scansv"> <img style="height:35px; width:35px" src="/img/BSicon/qr.png">&nbsp;&nbsp;Scan</a>';
                echo "</li>";
                echo "<li>";
                echo '<a href="/live_search">';
                echo '<img style="height:35px; width:35px" src="/img/BSicon/re.png"/>';
                echo "&nbsp;&nbsp;Reprint Sticker";
                echo "</a>";
                echo "</li>";
                }  
              ?>
                @endif

                @if(auth()->user()->dept != "8")
                <li>
                    @if( auth()->check() )
                    <a href="/BSprint/{{ auth()->user()->StaffID }}"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/printer.png') }}">&nbsp;&nbsp;Seal & Print</a>
                    @endif
                </li>

                <?php $roles = DB::table('roles')->where('id',auth()->user()->role)->first(); ?>
               
               

              
                <li>
                    <a href="/report"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/report.png') }}">&nbsp;&nbsp;Report</a>
                </li>
				
				 <li>
                  
                    <a href="/listbypass"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/skip.png') }}">&nbsp;&nbsp;Work Order Bypass</a>
                </li>
                <li>
                  
                  <a href="/switch_wo"> <img style="height:35px; width:35px"
                          src="{{ asset('/img/BSicon/wo.png') }}">&nbsp;&nbsp;Switch Work Order</a>
                </li>
				
				 <li>
                  
                <a href="/daily_timesheet"><img style="height:35px; width:35px" src=/img/BSicon/dts.png>&nbsp;&nbsp;Daily Timesheet</a>
                 
              </li>
                @endif
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light"
                style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="container-fluid">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <?php
								if (Auth::check())
								$name = auth()->user()->dept;
								$name2 = auth()->user()->role;
								if($name === "4" && $name2 === "21"){
									echo '<a href="/BShomesu"><img src=/img/poly.png></a></li>';
								}
							else if($name == "8"){
								echo '<a href="/BShome8"><img src=/img/poly.png></a></li>';
							}
							else{
								echo '<a href=/BShome'.$name.'><img src=/img/poly.png></a></li>';
							    }
						?>
                    </ul>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                @if( auth()->check() )
                                <a class="nav-link" style="font-color:black">Hi {{ auth()->user()->name }}!</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/logout">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ABOUT</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">FEEDBACK</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <button type="button" id="sidebarCollapse" class="btn btn-info" style=background:#00AEF0>
                <i class="fas fa-align-left"></i>
                <span style="font-size:18px">Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true"
                aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>
        </div>
    </div>
    </div>
    <!-- <div class="overlay"></div> -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->

    <script src="{{asset('js/popper.min.js')}}"></script> <!-- if comment this,modal not pop up -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script> <!-- if comment this,modal not pop up -->
    <script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#dismiss, .overlay').on('click', function() {
            $('#sidebar').removeClass('active');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').addClass('active');
            $('.overlay').addClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
    </script>
</body>

</html>
</head>

<body>
    <style>
body {
        margin :0;
        background-image: url('/img/back.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
}

#overlay {
    position: fixed;
    display: none;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;

    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 99999999;
    cursor: pointer;
  }
.divCenter {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.title {
    margin-bottom: 10px; /* Adjust this margin based on your design preference */
}

.dropdown {
    /* You can add styling for the dropdown container if needed */
}


        #tableContainer {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
        }


        #tableList {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        #tableList th, #tableList td {
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.2);
            color: black;
           
        }

        #tableList th {
            text-align: left;
            background-color: rgb(60, 60, 60, 0.8) !important;
            color: white;
        }

        #tableList tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.3) !important;
            font-weight: bold;
            font-size: 1.1em; /* Increase font size on hover */
        }

        #tableList tbody td {
            position: relative;
        }

        #tableList tbody td:hover:before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: -9999px;
            bottom: -9999px;
            background-color: rgba(255, 255, 255, 0.2) !important;
            z-index: -1;
        }

        .approved {
            cursor: pointer; /* Set the cursor to a hand symbol */
            transition: transform 0.3s ease; /* Add a smooth transition effect for scaling */
        }

        .approved:hover{
            transform: scale(1.2); /* You can adjust the scaling factor as needed */
            transition: transform 0.3s ease; /* Add a smooth transition effect */
        }

        /* Approve Toggle Start*/
        .switch {
            position: relative;
            display: block;
            vertical-align: top;
            width: 100px;
            height: 30px;
            padding: 3px;
            margin: 0 10px 10px 0;
            background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
            background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
            border-radius: 18px;
            box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
            cursor: pointer;
            box-sizing: content-box;
        }

        .switch-input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            box-sizing: content-box;
        }


        .switch-label {
            position: relative;
            display: block;
            height: inherit;
            font-size: 10px;
            text-transform: uppercase;
            background: #D22B2B;
            border-radius: inherit;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
            box-sizing: content-box;
        }

        .switch-label2 {
            position: relative;
            display: block;
            height: inherit;
            font-size: 10px;
            text-transform: uppercase;
            background: red;
            border-radius: inherit;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
            box-sizing: content-box;
        }

        .switch-label:before,
        .switch-label:after {
            position: absolute;
            top: 50%;
            margin-top: -.5em;
            line-height: 1;
            -webkit-transition: inherit;
            -moz-transition: inherit;
            -o-transition: inherit;
            transition: inherit;
            box-sizing: content-box;
        }

        .switch-label2:before,
        .switch-label2:after {
            position: absolute;
            top: 50%;
            margin-top: -.5em;
            line-height: 1;
            -webkit-transition: inherit;
            -moz-transition: inherit;
            -o-transition: inherit;
            transition: inherit;
            box-sizing: content-box;
        }

        .switch-label:before {
            content: attr(data-off);
            right: 11px;
            color: #FFFFFF;
            text-shadow: 0 1px rgba(255, 255, 255, 0.5);
        }

        .switch-label2:before {
            content: attr(data-off);
            right: 11px;
            color: #FFFFFF;
            text-shadow: 0 1px rgba(255, 255, 255, 0.5);
        }

        .switch-label:after {
            content: attr(data-on);
            left: 11px;
            color: #FFFFFF;
            text-shadow: 0 1px rgba(0, 0, 0, 0.2);
            opacity: 0;
        }

        .switch-label2:after {
            content: attr(data-on);
            left: 11px;
            color: #FFFFFF;
            text-shadow: 0 1px rgba(0, 0, 0, 0.2);
            opacity: 0;
        }

        .switch-input:checked~.switch-label {
            background: #22AB41;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .switch-input:checked~.switch-label:before {
            opacity: 0;
        }

        .switch-input:checked~.switch-label:after {
            opacity: 1;
        }

        .switch-input:checked~.switch-label2 {
            background: #22AB41;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
        }

        .switch-input:checked~.switch-label2:before {
            opacity: 0;
        }

        .switch-input:checked~.switch-label2:after {
            opacity: 1;
        }

        .switch-handle {
            position: absolute;
            top: 4px;
            left: 4px;
            width: 28px;
            height: 28px;
            background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
            background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
            border-radius: 100%;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
        }

        .switch-handle:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            margin: -6px 0 0 -6px;
            width: 12px;
            height: 12px;
            background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
            background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
            border-radius: 6px;
            box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
        }

        .switch-input:checked~.switch-handle {
            left: 74px;
            box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
        }

        /* Transition ========================== */
        .switch-label,
        .switch-handle {
            transition: All 0.3s ease;
            -webkit-transition: All 0.3s ease;
            -moz-transition: All 0.3s ease;
            -o-transition: All 0.3s ease;
        }

        .switch-label2,
        .switch-handle {
            transition: All 0.3s ease;
            -webkit-transition: All 0.3s ease;
            -moz-transition: All 0.3s ease;
            -o-transition: All 0.3s ease;
        }

    </style>
    <br> <br> <br> <br> <br> <br> <br> <br>

    <center>
        <a style="font-size:28px; text-align:center; color: black;font-weight:bold;">Switch Work Order</a>
        <br> <br> <br> <br> 
    </center>
    <div class="divCenter">
        <div class="title">
            <label class="form-label" style="font-weight:bold;font-size:20px">OPERATOR</label>
        </div>
        <div class="dropdown">
            <select id="operator" name="operator" class="form-control" style="width:250px">
                <option value="" selected disabled>SELECT OPERATOR</option>
              
                @foreach($list_op as $operator2)
                    @if($operator == $operator2->OPER_STAFF_ID)
                    <option value="{{$operator2->OPER_STAFF_ID}}" selected>{{$operator2->OPER_STAFF_ID}}-{{$operator2->OPER_NAME}}</option>
                    @else{
                        <option value="{{$operator2->OPER_STAFF_ID}}" >{{$operator2->OPER_STAFF_ID}}- {{$operator2->OPER_NAME}}</option>
                    }
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <script>
        document.getElementById('operator').onchange = function() {
        window.location = "{!! $my_var !!}?operator=" + this.value;
        };
        </script>
    <div id="tableContainer">
        
        <div>
        <form id="myForm">
        <table id="tableList" class ="table striped" style="width:auto;">
		<thead>
			<tr>
				<th>#</th>
                <th>#</th><!-- actual ordering no -->
                <th style="display:none;">ID</th>
                <th>WO ID</th>
                <th>SO & STOCK</th>
				<th>ZONE</th>
				<th>MACHINE</th>
                <th>CURRENT<br>SMALL BAG<brSEQ</th>
                <th>CURRENT<br>STD<br>BAG<brSEQ</th>
                <th>OPERATOR</th>
                <th>STATUS</th>
                <th>ACTION</th>
			</tr>
		</thead>
		<tbody>
        <?php $cnt =1; ?>
        @if($list_bypass)
		@foreach($list_bypass  as $key => $bypass)

        <tr>
         <td >{{$cnt++}}</td>
        <!--  <td >{{$key+1}}</td>-->
         <td>{{ $bypass->PRD_SEQ_BY_OPER }}</td><!-- HIDDEN COLUMN USE FOR REORDER -->
         <td style="display:none;">{{ $bypass->ID  }}</td>   
         <td style="width:13%;">{{$bypass->WO_ID}}</td>
         <td style="width:13%;">{{$bypass->SO_NO}}<br>{{$bypass->STK_CODE}}</td>
         <td style="width:8%;">{{$bypass->ZONE_NAME}}</td>
         <td style="width:12%;">{{$bypass->machineID}} :<br>{{$bypass->machineName}}</td>
         <td style="width:5%;">{{$bypass->CURRENT_SMALL_BAG}}</td>
         <td>{{$bypass->CURRENT_STD_BAG}}</td>
         <?php $user = User::where('staffid','=',$bypass->OPER_STAFF_ID)->first(); 
         if($bypass->PRD_STATUS =='A'){
            $status="ACTIVE"; $checked="checked";$actionUpdate="A"; } elseif($bypass->PRD_STATUS =='S') { $status="STOP";$checked="";$actionUpdate="S";} else {$status="N/A";$checked="";$actionUpdate="S";}; 
         ?>
         <td>{{strtoupper($user->fname)}}</td>
         <td>{{$status}}</td>
         @if($bypass->PRD_STATUS != 'C')
         @if(($bypass->PRD_STATUS =='S' && $bypass->EXCEPTION_STATUS =='0') || $bypass->PRD_STATUS =='A')
         <td>
            
                                            <label class="switch">
                                            <input class="switch-input toggle" id="toggle_{{$key+1}}"  data-id="{{$bypass->ID}}" data-wo_id="{{$bypass->WO_ID}}" name="BYPASS_CHK" type="checkbox" <?php echo $checked;?>/>
                                            <span class="switch-label" data-on="ACTIVE" data-off="STOP" id="BYPASS{{$key+1}}" name="BYPASS{{$key+1}}"></span>
                                            <span class="switch-handle"></span>
                                            <input type="hidden" id ="BYPASS_TRANSFER{{$key+1}}" name="BYPASS_TRANSFER" value="<?php echo $actionUpdate;?>" />
                                            </label>
        
        </td>
        @else
        <td>N/A</td>
        @endif
        @endif
        </tr>
        @endforeach
        @endif
		</tbody>
	</table>
         </form>
    </div>
        
       
        <div class="modal fade" id="actionUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ACTION</h4>
                                </div>
                                <div class="modal-body">
                                    <h5 id ="questions">Are you sure want ?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" autofocus>Close</button>
                                    <button type="submit" class="btn btn-danger" autofocus>Submit</button>
                                </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div><br>
    </div>

</body>

</html>
<script src="{{asset('js/bootstrap-maxlength.js')}}" type="text/javascript"></script>
<script src='https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js'></script>
<script>
$(document).ready(function() {  
    
            $('[data-toggle="tooltip"]').tooltip();

            var table = $('#tableList').DataTable({
                "responsive": true,
                "destroy": true,
                "paging": false,
                "processing": true,
                "order": [[1, 'asc']], // Order based on the second column (hidden)
                "rowReorder": {
                 "dataSrc": 1 //target data used for reorder row (the OPERATOR)

                },
                "columnDefs": [
                 {
                    "orderable": true,
                    "className": 'reorder',
                    "targets": [0] //show reorder icon in first column
                  },
                  { 
                    "visible": false, // Hide the second column at index 1,
                    "targets": 1
                 },
                  { 
                    "orderable": false,
                    "targets": [1, '_all'] 
                 }

                ],
            });

            let reorderData=[];

            table.off('row-reorder').on('row-reorder', function(e, diff, edit) {
                reorderData = []; //initialize each time do reorder
                //alert(diff.length);
                //reorderData = [];
                if (diff.length != 0) {
                $('#overlay').show();
                }
                
                var result = 'Reorder started on row: ' + edit.triggerRow.data()[1] + '<br>';
                //alert( result + " " +diff.length);

                for (var i = 0, ien = diff.length; i < ien; i++) {

                var current = i + 1;
                var total = diff.length;
                    
                var oldNode = diff[i].oldData;
                var newNode = diff[i].newData;
                var rowData = table.row(diff[i].node).data();

                result += rowData[0] + 'id' + rowData[1] + ' updated to be in position ' +
                    diff[i].newData + ' (was ' + diff[i].oldData + ')<br>';

            
                    // Rest of your code...
                //var seq = hiddenColumnValue;
                //var id = rowData[2];//id prd_trx
                //var wo_id = rowData[3]; //wo order id

                //alert("wo_id "+wo_id+" new seq "+seq+ " old seq "+" id "+id);
                //var seq = diff[i].newData;
                //var id = rowData[1];
                reorderData.push({
                        seq:  diff[i].newData,
                        id: rowData[2], // id prd_trx
                        wo_id: rowData[3], // wo order id
                });
                //}
               

                }

             console.log(reorderData);

             //console.log("reorder :",reorderData.length);
             if (reorderData.length > 0) {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                var count = 1;
                //alert("wo_id "+wo_id +" id : " +id+" seq :"+seq+ " "+$('#operator').val());
                var op_staffid= $('#operator').val();
                //return false;
               $.ajax({

                    url: "{{url('/switch_wo_seq')}}",
                    type: "POST",
                    cache: false,
                    data: {
                    "_token": "{{ csrf_token() }}",
                    //"seq": seq,
                    //"id": id,
                    "reorderData": reorderData,
                    "operator" : op_staffid,//operator staff id
                    },
                    success: function(dataResult) {
                    //dataResult = JSON.parse(dataResult);
                    console.log("Data result ",dataResult);
                    if (dataResult.type) {

                        var sessionValue = dataResult.message;
                        if (dataResult.type === 'success') {
                            
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'success',                               
                                html: sessionValue,
                                showConfirmButton: false,
                                timer: 5000
                            });
                           //reorderData = [];
                           setTimeout(function() {
                                location.reload();
                            }, 5000);
                           //reorderData = [];
                        } else if (dataResult.type === 'error') {
                           
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Whoops!',
                                html: sessionValue,
                                showConfirmButton: false,
                                timer: 5000
                            });
                            //reorderData = [];
                        }
                        
                        //alert("Success");
                    } else {
                        alert("Internal Server Error");
                        //$('#overlay').hide();
                        //reorderData = [];
                    }

                    }
                }); 
                }
            }); 

            
});

document.addEventListener('DOMContentLoaded', function () {

			var status = "{{ session('status') }}";
			
			
			if (status === 'success') {
				var sessionValue = '{!! Session::get("success") !!}';
				//alert(sessionValue);
				Swal.fire({
					position: 'center',
                    icon: 'success',
                    title: 'success',                               
					html: sessionValue,
					showConfirmButton: false,
					timer: 10000
				});
			} else if (status === 'error') {
				var sessionValue = '{!! Session::get("error") !!}';
				Swal.fire({
					position: 'center',
					icon: 'error',
                    title: 'Whoops!',
					html: sessionValue,
					showConfirmButton: false,
					timer: 10000
				});
			}

            const form = document.getElementById('myForm');
            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.dataset.initialValue = checkbox.checked;//keep original value first load
            });
});




$('#BYPASS_REMARKS').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "badge bg-success",
        limitReachedClass: "badge bg-danger",
});
$('.toggle').change(function() {

//    alert("here toogle");

//$("#actionUpdate").modal("show");
if ($(this).prop("checked") == true) {
    $statusWO = '<b>ACTIVE</b>'; 
    $upStatus="A";
    //$("#BYPASS_TRANSFER").val('A');

} else {
    $statusWO = '<b>STOP</b>'; 
    $upStatus="S";
    //$("#BYPASS_TRANSFER").val('S') ;
}

var wo_id = $(this).data("wo_id");
var id = $(this).data("id");

Swal.fire({
  title: "Do you want to save the changes?",
  html: 'This action will update production status <br>for<br><b>WORK ORDER :'+wo_id+ '</b><br> to <br>'+$statusWO,
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: "Save",
  denyButtonText: `Don't save`
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {

    $.ajax({

        url: "{{url('/activate_wo')}}",
        type: "POST",
        cache: false,
        data: {
        "_token": "{{ csrf_token() }}",
        'id':id,
        "status": $upStatus,
        },
        success: function(dataResult) {
                        //dataResult = JSON.parse(dataResult);
                        //console.log("Data result ",dataResult);
                        var sessionValue = dataResult.message;
                        if (dataResult.type === 'success') {
                            
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'success',                               
                                html: sessionValue,
                                showConfirmButton: false,
                                timer: 5000
                            });
                           //reorderData = [];
                           setTimeout(function() {
                                location.reload();
                            }, 5000);
                           //reorderData = [];
                        } else if (dataResult.type === 'error') {
                           
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Whoops!',
                                html: sessionValue,
                                showConfirmButton: false,
                                timer: 5000
                            });
                            //reorderData = [];
                        }

     

        }
        }); 

    //Swal.fire("Saved!", "", "success");
  } else if (result.isDenied) {
    const form = document.getElementById('myForm');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
      // Set the checkbox back to its initial value
      checkbox.checked = JSON.parse(checkbox.dataset.initialValue);//reset to orignal value
    });

    Swal.fire("Changes are not saved", "", "info");
  }else{

    const form = document.getElementById('myForm');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
      // Set the checkbox back to its initial value
      checkbox.checked = JSON.parse(checkbox.dataset.initialValue);
    });
  }
});

});


</script>