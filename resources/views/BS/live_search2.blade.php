<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>

    <script src="{{asset('js2/jquery.min.js')}}"></script>

    <link rel="icon" href="{!! asset('/img/ICONT.png') !!}" />

    <script src="{{asset('js2/bootstrap2.min.js')}}"></script>
    <!DOCTYPE html>

    <html>

    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">




        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
        <!-- Our Custom CSS -->

        <!-- Scrollbar Custom CSS -->


        <script src="{{asset('js/solid.js')}}"></script>
        <script src="{{asset('js/fontawesome.js')}}"></script>


    </head>

    <?php 
                            use Carbon\Carbon;
                       
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
        background-image: url('/img/back.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
    }

    .tabbed>input {
        display: none;
    }

    .tabbed>label {
        display: block;
        float: left;
        padding: 12px 20px;
        margin-right: 5px;
        cursor: pointer;
        transition: background-color .3s;
    }

    .tabbed>label:hover,
    .tabbed>input:checked+label {

        /**background-color:#99ffcc;**/
    }

    .tabs {
        clear: both;
        perspective: 600px;
    }

    .tabs>div {
        width: 100%;
        position: absolute;

        background-color: white;
        line-height: 1.4em;
        opacity: 0;
        transform: rotateX(-20deg);
        transform-origin: top center;
        transition: opacity .3s, transform 1s;
        z-index: 0;
    }

    #tab-nav-1:checked~.tabs>div:nth-of-type(1),
    #tab-nav-2:checked~.tabs>div:nth-of-type(2),
    #tab-nav-3:checked~.tabs>div:nth-of-type(3),
    #tab-nav-4:checked~.tabs>div:nth-of-type(4) {
        transform: rotateX(0);
        opacity: 1;
        z-index: 1;
    }

    @media screen and (max-width: 700px) {
        .tabbed {
            width: 400px
        }

        .tabbed>label {
            display: none
        }

        .tabs>div {
            width: 400px;
            border: none;
            padding: 0;
            opacity: 1;
            position: relative;
            transform: none;
            margin-bottom: 60px;
        }

        .tabs>div h2 {
            border-bottom: 2px solid #4EC6DE;
            padding-bottom: .5em;
        }
    }
    </style>
    <br> <br> <br> <br> <br> <br> <br> <br>

    <center>
        <a style="font-size:28px; text-align:center; color: white">SALES ORDER LIST</a>
    </center>
    <br />
    <div class="container" style="height:800px;border-radius: 12px;  background-color:white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <br>
        <div class="container box" style="">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="form-group" style="padding-left:20px; padding-right:20px;">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Search" />
                    </div>
                    <div class="tabbed">
                        <!--<input type="radio" name="tabs" id="tab-nav-1" checked>-->
                        <input type="radio" name="tabs" id="tab-nav-1">
                        <label for="tab-nav-1" id="progress"> <img style="height: 30px; width:30px"
                                src="/img/tracking/progress.png" />&nbsp;Progress Job</label>
                        <input type="radio" name="tabs" id="tab-nav-2">
                        <label for="tab-nav-2"><img style="height: 30px; width:30px"
                                src="/img/tracking/fin.png" />&nbsp;Completed Assign</label>
                        <input type="radio" name="tabs" id="tab-nav-3" style="display:none;"><!-- FOR SEARCH RESULT -->
                        <div class="tabs">

                            <div >
                            <?php
                                                      $sql = DB::table('solist')
                            ->leftjoin('moresolist',DB::raw('solist.sonum COLLATE  utf8_general_ci'),'=',DB::raw('moresolist.sonum AND moresolist.trxstatus in ("A","C")'))
                            ->select('solist.sonum', DB::raw('refnum,shipmark,if(moresolist.sonum is not null,1 ,0) as totalAll,if(moresolist.sonum is not null and asgnto is not null and asgnto !="",1 ,0) as TotalAssgn'))->whereRaw('solist.trxstatus IN ("A","C")');

                            $dataResult = DB::table(DB::raw("({$sql->toSql()}) as sub "))->select(\DB::raw("sonum,refnum,shipmark,ifnull((sum(TotalAssgn)/sum(totalAll)) * 100,0) as percent"))
                            ->mergeBindings($sql)->orderBy('sonum', 'Desc')->groupBy('sonum')->get();//use for search coz below limit to current page only

                            $cntProgress = $dataResult->where('percent','<' ,100)->count();
                            $cntComplete = $dataResult->where('percent','=' ,100)->count();

                            $totalPages = ceil($cntProgress / 5);
                            $totalComplete = ceil($cntComplete / 5);
                            //echo "Total Page :". $totalPages;
                          
                            //simplepaginate support use subquery,load less time than use paginate 
                            //paginate not support use subquery 
                            $datas = DB::table(DB::raw("({$sql->toSql()}) as sub "))->select(['sonum', DB::raw('refnum,shipmark,ifnull((sum(TotalAssgn)/sum(totalAll)) * 100,0) as percent')])
                            ->mergeBindings($sql)->groupBy('sub.sonum')->havingRaw('percent < 100')->orderBy('sonum', 'Desc')->simplepaginate(5);

                            $datas2 = DB::table(DB::raw("({$sql->toSql()}) as sub "))->select(\DB::raw("sonum,refnum,shipmark,ifnull((sum(TotalAssgn)/sum(totalAll)) * 100,0) as percent"))
                                ->mergeBindings($sql)->groupBy('sonum')->havingRaw('percent = 100')->orderBy('sonum', 'Desc')->simplepaginate(5);//count in complete status

                            //$i =1;
                          
                            $i = ($datas->perPage() * ($datas->currentPage() - 1)) + 1;
                            $j = ($datas2->perPage() * ($datas->currentPage() - 1)) + 1;
                            $k=1;

                            ?>
                               
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="progress">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SO Number</th>
                                                <th>Ref No</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php 
                                        if($cntProgress >0)
                                        foreach ($datas as $row) {

                                                    $var2 = $row->percent;

                                                    $var3 = (int)$var2;
                                                        echo
                                                            '<tr>
                                                            <td style="width:10px">'.$i++.'</td>
                                                            <td>'.$row->sonum.'</td>
                                                            <td></td>
                                                            <td style="width:200px">  <div class="progress">
                                                            <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                                style="width:'.$var3.'%; color:black; background-color:yellow">'.$var3.'%
                                                            </div>
                                                            </div></td>
                                                            <td align="center"style="width:200px">
                                                            <a style="text-align:center" href=show/'.$row->sonum.'>
                                                                <button class="btn btn-info" style="width:130px"> View / Assign </button>
                                                            </a>
                                                            <br>
                                                            <a style="text-align:center" href=searchtrack/'.$row->sonum.'>
                                                            <button class="btn btn-danger" style="width:130px" >Tracking</button>
                                                            </a>
                                                            </td>
                                                            </tr>
                                                            ';
                                                  
                                        } else {

                                            echo '<tr>
                                                <td align="center" colspan="5">No Data Found</td>
                                                </tr>
                                                ';
                                        }?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="clearfix">
                                    <div class="hint-text">Showing <b>{{ $datas->firstItem() }} - {{ $datas->lastItem() }}</b> out of <b>{{ $cntProgress }}</b> entries</div>
                                    <ul class="pagination">
                                        <?php if($totalPages >1) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="/live_search2" rel="prev">&laquo; First </a>
                                        </li>
                                        <?php }?> 
                                        {{ $datas->links() }}

                                        <?php if($totalPages >1) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="/live_search2?page=<?php echo $totalPages?>" rel="End">Last &raquo</a>
                                        </li>
                                        <?php }?> 
                                    </ul>
                                </div>
                            </div>
                                        </center>
                            <div>
                                <div class="table-responsive" style="height:100%;background-color:white; ">
                                    <table class="table table-striped table-bordered" style="height:100%;background-color:white; " id="complete">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SO Number</th>
                                                <th>Ref No</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            <?php
                                                /** ORIGINAL */
                                                /*$data = DB::table('solist')->where('trxstatus','A')->orderBy('id')->get();
                                                    $i = 1;
                                                foreach($data as $row)
                                                {
                                                    
                                                    $prints = DB::table('moresolist')->where('sonum', '=',  $row->sonum)->where('trxstatus','A')->count();
                                                    $prints2 = DB::table('moresolist')->where('sonum', '=',  $row->sonum)->where('trxstatus','A')->whereNotNull('asgnto')->where('asgnto', '!=',  '')->count();
                                                    if($prints2 == 0){
                                                    $var3 = 0;
                                                    }else{
                                                    $var = ( $prints2/$prints );
                                                    $var2 = $var * 100;
                                                    $var3 = (int)$var2;
                                                    }
                                                    
                                                
                                                    if ($var3 != 100){
                                                    echo 
                                                        '<tr hidden>
                                                        <td style="width:10px" hidden>'.$i++.'</td>
                                                        <td hidden>'.$row->sonum.'</td>
                                                        <td hidden>'.$row->refnum.'</td>
                                                        <td style="width:200px" hidden>  <div class="progress" hidden>
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                            style="width:'.$var3.'%; color:red; background-color:yellow" hidden>'.$var3.'%
                                                        </div>
                                                        </div></td>
                                                        <td align="center"style="width:200px" hidden>
                                                        <a style="text-align:center" href=show/'.$row->sonum.' hidden>
                                                            <button class="btn btn-info" style="width:130px" hidden> View / Assign </button>
                                                        </a>
                                                        <br>
                                                        <a style="text-align:center" href=searchtrack/'.$row->sonum.' hidden>
                                                        <button class="btn btn-danger" style="width:130px" hidden>Tracking</button>
                                                        </a>
                                                        </td>
                                                        </tr>
                                                        ';
                                                    }else{
                                                    echo
                                                    '<tr>
                                                    <td style="width:10px">'.$i++.'</td>
                                                    <td>'.$row->sonum.'</td>
                                                    <td>'.$row->refnum.'</td>
                                                    <td style="width:200px">  <div class="progress">
                                                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                        style="width:'.$var3.'%; color:black; background-color:yellow">'.$var3.'%
                                                    </div>
                                                    </div></td>
                                                    <td align="center"style="width:200px">
                                                    <a style="text-align:center" href=show/'.$row->sonum.' >
                                                            <button class="btn btn-info" style="width:130px" > View / Assign0 </button>
                                                        </a>
                                                        <br>
                                                    
                                                    <a style="text-align:center" href=searchtrack/'.$row->sonum.'>
                                                    <button class="btn btn-danger" style="width:130px" >Tracking</button>
                                                    </a>
                                                    </td>
                                                    </tr>
                                                    ';
                                                    }
                                              } */
                                                /*** END ORIGINAL */

                                                if($cntComplete >0){

                                                    foreach ($datas2 as $row) {
                                                        
                                                        $var2 = $row->percent;
        
                                                        $var3 = (int)$var2;

                                                        echo
                                                        '<tr>
                                                        <td style="width:10px">'. $j++.'</td>
                                                        <td>'.$row->sonum.'</td>
                                                        <td>'.$row->refnum.'</td>
                                                        <td style="width:200px">  <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                            style="width:'.$var3.'%; color:black; background-color:yellow">'.$var3.'%
                                                        </div>
                                                        </div></td>
                                                        <td align="center"style="width:200px">
                                                        <a style="text-align:center" href=show/'.$row->sonum.' >
                                                                <button class="btn btn-info" style="width:130px" > View / Assign</button>
                                                            </a>
                                                            <br>
                                                        
                                                        <a style="text-align:center" href=searchtrack/'.$row->sonum.'>
                                                        <button class="btn btn-danger" style="width:130px" >Tracking</button>
                                                        </a>
                                                        </td>
                                                        </tr>
                                                        ';
                                                    }
                                                } else{
    
                                                    echo '<tr>
                                                    <td align="center" colspan="5">No Data Found</td>
                                                    </tr>
                                                    ';
                                                }
		  
                                            ?>
                                        </thead>

                                    </table>
                                </div>
                                <div class="clearfix">
                                    <div class="hint-text">Showing <b>{{ $datas2->firstItem() }} - {{ $datas2->lastItem() }}</b> out of <b>{{ $cntComplete }}</b> entries</div>
                                    <ul class="pagination">
                                        <?php if($totalComplete >1) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="/live_search2" rel="prev">&laquo; First </a>
                                        </li>
                                        <?php }?>
                                        {{ $datas2->links() }}

                                        <?php if($totalComplete >1) {?>
                                        <li class="page-item">
                                            <a class="page-link" href="/live_search2?page=<?php echo $totalComplete?>" rel="End">Last &raquo</a>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>

                            <div> <!-- result -->

                             <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="result">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>SO Number</th>
                                                <th>Ref No</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                           
                                        </thead>
                                        <tbody>
                                             <?php

                                              
                                                foreach ($dataResult as $row2) {
                                                    
                                                    $var4 =  $var =0;
                                                    $var = $row2->percent;
                                                    
                                                    $var4 = (int)$var;

                                                    //echo "sonum ".$row2->sonum."  ".$var ." var4 ".$var4." ";
                                                    $refnum ="";
                                                    if($var4 < 100){
                                                           
                                                        $refnum =""; 
                                                        
                                                        echo
                                                        '<tr>
                                                        <td style="width:10px">'. $k++.'</td>
                                                        <td>'.$row2->sonum.'</td>
                                                        <td></td>
                                                        <td style="width:200px">  <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                            style="width:'.$var4.'%; color:black; background-color:yellow">'.$var4.'%
                                                        </div>
                                                        </div></td>
                                                        <td align="center"style="width:200px">
                                                        <a style="text-align:center" href=show/'.$row2->sonum.'>
                                                            <button class="btn btn-info" style="width:130px"> View / Assign </button>
                                                        </a>
                                                        <br>
                                                        <a style="text-align:center" href=track/'.$row2->sonum.'>
                                                        <button class="btn btn-danger" style="width:130px" >Tracking</button>
                                                        </a>
                                                        </td>
                                                        <td hidden>'.$row2->refnum.'</td>
                                                        <td hidden>'.$row2->shipmark.'</td>
                                                        </tr>
                                                        ';
                                                     

                                                    }else{
                                                       

                                                        echo
                                                        '<tr>
                                                        <td style="width:10px">'.$k++.'</td>
                                                        <td>'.$row2->sonum.'</td>
                                                        <td>'.$row2->refnum.'</td>
                                                        <td style="width:200px">  <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                            style="width:'.$var3.'%; color:black; background-color:yellow">'.$var3.'%
                                                        </div>
                                                        </div></td>
                                                        <td align="center"style="width:200px">
                                                        <a style="text-align:center" href=show/'.$row2->sonum.' >
                                                                <button class="btn btn-info" style="width:130px" > View / Assign</button>
                                                            </a>
                                                            <br>
                                                        
                                                        <a style="text-align:center" href=searchtrack/'.$row2->sonum.'>
                                                        <button class="btn btn-danger" style="width:130px" >Tracking</button>
                                                        </a>
                                                        </td>
                                                        </tr>
                                                        ';
                                                    }
                                                    
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                    
                                </div>


                            </div>
                        </div>
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
<script>
$(document).ready(function() {
    
    //fetch_customer_data();//REMOVE USE AJAX

    var data = sessionStorage.getItem('data');//enhance to keep checkbox remain same when reload
    
    if(data !=null){

           if(JSON.parse(data).nav2 == 'checked'){
           document.getElementById("tab-nav-2").checked = true;
           }else{
               document.getElementById("tab-nav-1").checked = true;
           }
    }else{
           document.getElementById("tab-nav-1").checked = true;
    }
      

    function fetch_customer_data(query = '') {
        $.ajax({
            url: "{{ route('live_search2.action2') }}",
            method: 'GET',
            data: {
                query: query
            },
            dataType: 'json',
            success: function(data) {
                $('tbody').html(data.table_data);
                $('#total_records').text(data.total_data);
            }
        })
    }


    $(document).on('keyup', '#search', function() {

        $('#progress').click();
        var query = $(this).val();

        if(query !=''){ //search by table content already load (minimize load time)


            document.getElementById("tab-nav-3").checked = true;//display in result table
            document.getElementById("tab-nav-1").checked = false;
            document.getElementById("tab-nav-2").checked = false;
            var input, filter, found, table, tr, td, i, j;

            filter =query;
            table = document.getElementById("result");
            tr = table.getElementsByTagName("tr");
            var cnt =0;
            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;
                    cnt++;
                } else {
                    tr[i].style.display = "none";
                }
            }
            console.log("Found Result :"+cnt);


        }else{ //if empty default to in progress

            document.getElementById("tab-nav-1").checked = true;
            document.getElementById("tab-nav-2").checked = false;
            document.getElementById("tab-nav-3").checked = false;

        }
    });

    if(document.getElementById('tab-nav-2').checked) {
                    
                    document.getElementById("tab-nav-2").checked = true;
                    document.getElementById("tab-nav-1").checked = false;
                

        }else if(document.getElementById('tab-nav-1').checked) {
                   
                    document.getElementById("tab-nav-2").checked = false;
                    document.getElementById("tab-nav-1").checked = true;

        }
       
        document.getElementById('tab-nav-2').onclick = function() {
                               
       sessionStorage.setItem("data",JSON.stringify({"nav2":"checked"}));   
               
                <?php 
                                if (isset($_GET['page'])){ ?> 
                                    
                                    const url = new URL('{!! $datas2->url(1) !!}');

                                    document.getElementById("tab-nav-2").checked = true;
                                    document.getElementById("tab-nav-1").checked = false;
                                    document.getElementById("tab-nav-3").checked = false;
                                    
                                    window.location = url;//reload complete data
                <?php } ?>     
       };

       document.getElementById('tab-nav-1').onclick = function() {
                               
              sessionStorage.setItem("data",JSON.stringify({"nav2":"unchecked"})); 
       };
});
</script>