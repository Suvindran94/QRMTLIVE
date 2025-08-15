<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Corrective Action Request System (CARS)</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style3.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>




    <div class="wrapper" >
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>

            <div class="sidebar-header">
                <h3>CAR System</h3>
            </div>
            
            <ul class="list-unstyled components">
       
            <li class="active">
                <a href="{{ url('/carhome') }}"><img src="img/myicon/home.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Home</a>
                </li>
                <li>
                <a href="{{ url('/internalaudit') }}"><img src="img/myicon/audit.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Internal Audit</a>
                </li>
                <li>
                    <a href="#homeSubmenu" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false"><img src="img/myicon/internal.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Internal CAR</a>
                   
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ url('/internacust') }}"><img src="img/internalcust.png" style="width:25px;height:25px">&nbsp;&nbsp;Internal Customer</a>
                        </li>
                        <li>
                            <a href="{{ url('/letsImprove') }}"><img src="img/letsimprove.png" style="width:25px;height:25px">&nbsp;&nbsp;Let's Improve</a>
                        </li>
                       
                    </ul>
                </li>
                <li>
        
                <a href="#pageSubmenu"  class="dropdown-toggle"  data-toggle="collapse" aria-expanded="false"><img src="img/myicon/external.png" style="width:30px;height:30px"  >&nbsp;&nbsp;External CAR</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{ url('/externalcust') }}"><img src="img/externalcust1.png" style="width:25px;height:25px">&nbsp;&nbsp;External Customer</a>
                        </li>
                        <li>
                            <a href="{{ url('/externalProvider') }}"><img src="img/externalprov.png" style="width:25px;height:25px">&nbsp;&nbsp;External Provider</a>
                        </li>
                    </ul>
                </li>

                <li>
               <a href="{{ url('/validateCars') }}"><img src="img/myicon/validate.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Validate CAR</a>
               </li>

                 <li>
                <a href="{{ url('/myCar') }}"><img src="img/myicon/mycar.png" style="width:30px;height:30px"  >&nbsp;&nbsp;My Car</a>
                </li>

                <li>
                <a href="{{ url('/carlist') }}"><img src="img/myicon/list.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Car List</a>
                </li>

               
                <li>

                    <a href="{{ url('/tracker') }}"><img src="img/myicon/tracking.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Track Car</a>
                </li>
                <li>
                    <a href="{{ url('pdfView') }}" target="_blank"><img src="img/myicon/contact.png" style="width:30px;height:30px"  >&nbsp;&nbsp;Contact</a>
                </li>
            </ul>  
        </nav>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                <a class="navbar-brand" href="/">
          <img src="{{ asset('/img/poly.png') }}" style="width:150px;" alt="">
        </a>
                   

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

               
                        <ul class="nav navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home2') }}">HOME</a>
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

            <button type="button" id="sidebarCollapse" class="btn btn-info" style="background:#00AEF0; z-index: 1;
    position:relative; ">
                        <i class="fas fa-align-left"></i>
                        <span>MENU</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                   
           
          
       

   </div>
        </div>
  
        
    </div>



    <div class="overlay"></div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $("#sidebar").mCustomScrollbar({
                theme: "minimal"
            });

            $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

            
   


            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').addClass('active');
                $('.overlay').addClass('active');
                $('.collapse.in').toggleClass('in');
                $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });

        

        
    </script>

    






</html>
