<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  




	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
		<!-- Our Custom CSS -->
		<!-- Scrollbar Custom CSS -->
		<!-- Font Awesome JS -->
		
	
		
		<script src="{{asset('js/solid.js')}}"></script>
		<script src="{{asset('js/fontawesome.js')}}"></script>

</head>



<body>
    <style>
    body{
        background-image: url('/img/back.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
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
        margin-top:4px;
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
                    <a href="/BShome3"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/house.png') }}">&nbsp;&nbsp;Home</a>
                </li>

             
               
                <li hidden>
                    <a href="/scan"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/qr.png') }}">&nbsp;&nbsp;QA Scan</a>
                </li>
                <li >
                <a data-toggle="modal"
                            data-target="#myModal"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/qr.png') }}">&nbsp;&nbsp;Scan</a>
                </li>
                <li hidden>
                    <a href="/scan3"> <img style="height:35px; width:35px"
                            src="{{ asset('/img/BSicon/qr.png') }}">&nbsp;&nbsp;Driver Scan</a>
                </li>
                
                <li>
                    <a href="/report" > <img
                            style="height:35px; width:35px" src="{{ asset('/img/BSicon/report.png') }}">&nbsp;&nbsp;Report</a>
                  
                </li>
               
              
              
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light"
                style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="container-fluid">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                        <a href="/BShome3"> <img 
                            src="{{ asset('/img/poly.png') }}" style="width:150px;"></a></li>
                    </ul>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                   <li class="nav-item">
                   @if( auth()->check() )
                   <a class="nav-link" style="font-color:black"> Hi {{ auth()->user()->name }}!</a>
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

   <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/jquery.mCustomScrollbar.concat.min.js')}}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
     	/*
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });
		*/

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