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
						else if($name == "8")
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
                @if( auth()->check() && auth()->user()->dept == "4") <!-- PRODUCTION ONLY -->
                <?php $roles = DB::table('roles')->where('id',auth()->user()->role)->first(); ?>
                @if(auth()->user()->role == "32" || str_contains($roles->name, "Plant Manager" || auth()->user()->role == "25"))  <!-- production supervisor or plant manager P,Z,M -->
                <li>
                    <a href="/listbypass"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/skip.png') }}">&nbsp;&nbsp;Work Order Bypass</a>
                </li>
                <li>
                  <a href="/switch_wo"> <img style="height:35px; width:35px"
                          src="{{ asset('/img/BSicon/wo.png') }}">&nbsp;&nbsp;Switch Work Order</a>
                </li>
                @endif
                @endif
                <li>
                    <a href="/report"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/report.png') }}">&nbsp;&nbsp;Report</a>
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
    <div class="overlay"></div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->

    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
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
     
        .table-wrapper {
            padding: 20px 25px;
            margin: 30px auto;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            overflow:auto;
        }
        #tableContainer {
            width: 100%;
            display: flex;
            justify-content: center;
            padding-right: 20px;
            margin-right: auto;
            margin-left: auto; 
            overflow:auto;
            
        }
        #tableList {
            width: 100%;
            height: 100%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow:auto;
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
            font-weight: 500;
            /*font-size: 1.1em;  Increase font size on hover */
        }

        #tableList tbody td {
            position: relative;
        }

        #tableList tbody td:hover:before {
           /**  content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: -9999px;
            bottom: -9999px;
            background-color: rgba(255, 255, 255, 0.2) !important;
            z-index: -1;*/
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
        <a style="font-size:28px; text-align:center; color: black;font-weight:bold;">BYPASS REQUEST LIST</a>
    </center>
    <div id="tableContainer">
    <div class="table-wrapper" style="max-width:1200px; ">
        
        <div>
        <br><br>
        <table>
                            <tr>
                                <td>Status</td>
                                <td>:&nbsp;</td>
                                <td colspan="10">
                                    <form>
                                        <select id="status" name = "status" class="form-control" style="width:200px">
                                            <option value="" @if($status=="ANY" ) selected @endif>ANY</option>
                                            <option value="P" @if($status=='P' ) selected @endif>PENDING</option>
                                            <option value="R" @if($status=='R' ) selected @endif>REJECTED</option>		
                                            <option value="A" @if($status=='A' ) selected @endif>COMPLETED</option>										
                                        </select>
                                    </form>
                                </td>
                            </tr>
        </table>
        <br>
        <script>
        document.getElementById('status').onchange = function() {
        window.location = "{!! $my_var !!}?status=" + this.value;
        };
        </script>
        <table id="tableList" class ="table striped" style="width:auto;">
		<thead>
			<tr>
				<th>#</th>
                <th>SO & STOCK</th>
				<th>OPERATOR</th>
				<th>ZONE</th>
				<th>MACHINE</th>
                <th>WEIGHT</th>
                <th>UNIT</th>
                <th>CURRENT<br>SMALL BAG<brSEQ</th>
                <th>CURRENT<br>STD<br>BAG<brSEQ</th>
                <th>BYPASS TYPE</th>
                <th>BYPASS</th>
                <th>STATUS</th>
                <th>ACTION</th>
                
			</tr>
		</thead>
		<tbody>
		@foreach($list_bypass  as $key => $bypass)
        <tr>
         <td>{{$key+1}}</td>   
         <td style="width:13%;">{{$bypass->SO_NO}}<br>{{$bypass->STK_CODE}}</td>
         <?php $op = User::where('staffId','=',$bypass->OPER_STAFF_ID)->first(); ?>
         <td style="width:12%;color:black;"><font color="blue">{{$op->name  ?? 'N/A' }}</font><br>
         {{$bypass->CREATED_AT ? Carbon::parse($bypass->CREATED_AT)->formatLocalized('%d %b %Y %I:%M %p') : 'N/A'}}
        </td>
         <td style="width:8%;">{{$bypass->ZONE_NAME}}</td>
         <td style="width:12%;">{{$bypass->machineID}} :<br>{{$bypass->machineName}}</td>
         <td>{{$bypass->WEIGHT}}</td>
         <td>{{$bypass->UNIT}}</td>
         <td style="width:5%;">{{$bypass->CURRENT_SMALL_BAG}}</td>
         <td>{{$bypass->CURRENT_STD_BAG}}</td>
         <td >{{$bypass->EXCEPTION_TYPE}}</td>
        <?php $user = User::where('id','=',$bypass->BYPASSED_BY)->first(); ?>

        <td  style="width:15%;color:black;">
        @if(isset($user->name))
        <font color="#1B2F5D">
         {{ $user->name ?? 'N/A' }}</font><br>
         {{$bypass->BYPASSED_AT ? Carbon::parse($bypass->BYPASSED_AT)->formatLocalized('%d %b %Y %I:%M %p') : 'N/A'}}<br>
         Remarks :  {{$bypass->REMARKS}}
         @else
         N/A
        @endif
        </td>
         <td>@if($bypass->STATUS =='P') PENDING @elseif($bypass->STATUS =='R') REJECTED @else COMPLETED @endif</td>
         <td>
         @if($bypass->STATUS =='P') 
         <a href="#" style="float:right;" class="approveByPass2" data-id="{{$bypass->EXCEPTION_ID}}" data-sono="{{$bypass->SO_NO}}" data-order="{{$key+1}}" data-type="{{$bypass->EXCEPTION_TYPE}}" data-prid="{{$bypass->PRD_ID}}" data-stock="{{$bypass->STK_CODE}}">
         <i class="material-icons approved" style="color: green;" data-toggle="tooltip" data-placement="top" title="Click here to approve !">check_circle</i>
        </a>
        @else
        N/A
        @endif
        </td>
        </tr>
        @endforeach
		</tbody>
	</table>
        </div>
        
       
        <div class="modal fade" id="approveByPass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">BYPASS REQUEST APPROVAL</h4>
                                
                                </div>
                                <form id="approval" method="post" action="/bypassApproval" enctype="multipart/form-data">
                                @csrf <!-- {{ csrf_field() }} -->
                                <input type="hidden" id ="BYPASS_ID" name="BYPASS_ID" value="" />
                                <input type="hidden" id ="BYPASS_TYPE" name="BYPASS_TYPE" value="" />
                                <input type="hidden" id ="BYPASS_PRD_ID" name="BYPASS_PRD_ID" value="" />
                                   
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6" style="font-weight: bold;">
                                            
                                            <div class="d-flex">
                                            <h6>REQUEST NO : &nbsp;&nbsp;</h6>
                                            <h6 id="orderno" name="orderno"></h6>
                                            </div>
                                            <div class="d-flex">
                                                <h6 class="mr-2">PRODUCTION ID : &nbsp;&nbsp;</h6>
                                                <h6 id="PRD_ID" name="PRD_ID"></h6>
                                            </div>
                                            <div class="d-flex">
                                            <h6>SO NO : &nbsp;&nbsp;</h6>
                                            <h6 id="sono" name="sono"></h6>
                                            </div>
                                            <div class="d-flex">
                                            <h6>STOCKCODE : &nbsp;&nbsp;</h6>
                                            <h6 id="stock" name="stock"></h6>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                    <div class="col-sm-4">
                                            <br>
                                            <label class="switch">
                                            <input class="switch-input toggle" id="toggle"  name="BYPASS_CHK" type="checkbox"/>
                                            <span class="switch-label" data-on="APPROVE" data-off="REJECT" id="BYPASS" name="BYPASS"></span>
                                            <span class="switch-handle"></span>
                                            <input type="hidden" id ="BYPASS_TRANSFER" name="BYPASS_TRANSFER" value="R" />
                                            </label>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="col"><br>
                                    <b><label>Remarks</label></b>
                                    <textarea class="form-control" style="text-align:left;width:100%;" id="BYPASS_REMARKS" rows="5" columns="100" name="BYPASS_REMARKS"  maxlength="500"></textarea>
                                    </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" autofocus>Close</button>
                                    <button type="submit" class="btn btn-danger" autofocus>Submit</button>
                                </div>
                                </form>
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
<script>
$(document).ready(function() {  
    
            $('[data-toggle="tooltip"]').tooltip();

            $('#tableList').DataTable({
                pageLength: 5, // Set the default number of rows per page to 5
                lengthMenu: [5, 10, 25, 50], // Add the dropdown options
                select: true, // Enable DataTables Select extension
                columnDefs: [
                    {
                        targets: 12, // Assuming the status column is the 13th column (index 12)
                        type: 'select', // Use select filter type
                        searchOptions: {
                            empty: 'Select status', // Placeholder text for the dropdown
                        }
                    }
                ]
            });

            $(document).on('click', '.approveByPass2', function() {
           //$('.approveByPass2').on('click', function() {  
                var dataId = $(this).data("id");
                //alert(dataId);
                var dataType = $(this).data("type");
                var prd_id = $(this).data("prid");
                var sono = $(this).data("sono");
                var order = $(this).data("order");
                var stock = $(this).data("stock");
                //alert(dataId + " "+dataType +stock );

                
                document.getElementById("orderno").innerHTML  =   "#"+dataId;
                document.getElementById("PRD_ID").innerHTML  =   prd_id;
                document.getElementById("sono").innerHTML  =   sono;
                document.getElementById("stock").innerHTML  =   stock;


                $('#BYPASS_ID').val(dataId);
                $('#BYPASS_TYPE').val(dataType);
                $('#BYPASS_PRD_ID').val(prd_id);
                
                //if(dataType == 'SCAN STD TOLERANCE'){
                    //SET BY DEFAULT
                   // Manually set the checkbox as checked
                   /** ONLY CAN APPROVED */
                   $('.toggle').prop({
                    'checked': true,
                    'disabled': true
                    });

                    // Trigger the change event
                    $('.toggle').change();
                //}else{

                /**$('.toggle').prop({
                    'checked': false,
                    'disabled': false
                    });

                    $('.toggle').change();
                //} */    
                $('#approveByPass').modal('show');
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
					timer: 5000
				});
			} else if (status === 'error') {
				var sessionValue = '{!! Session::get("error") !!}';
				Swal.fire({
					position: 'center',
					icon: 'error',
                    title: 'Whoops!',
					html: sessionValue,
					showConfirmButton: false,
					timer: 5000
				});
			}
});




$('#BYPASS_REMARKS').maxlength({
        alwaysShow: true,
        threshold: 10,
        warningClass: "badge bg-success",
        limitReachedClass: "badge bg-danger",
});
$('.toggle').change(function() {

if ($(this).prop("checked") == true) {

    $("#BYPASS_TRANSFER").val('A');
    
} else {

    $("#BYPASS_TRANSFER").val('R');
}
});


</script>