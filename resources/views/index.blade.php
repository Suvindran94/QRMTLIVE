<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Polyware | Your Complete PE Pipeline System Partner</title>
    @include('Navigation.navbar')

<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light fixed-top">
        <div class="navbar-header d-flex col">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('/img/poly.png') }}" alt="">
            </a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse"
                class="navbar-toggle navbar-toggler ml-auto">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Collection of nav links, forms, and other content for toggling -->
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
                <ul class="nav navbar-nav">
                    <li class="nav-item"><a href="#" class="nav-link">{{ trans('sentence.home')}}</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">{{ trans('sentence.about')}}</a></li>

                    <li class="nav-item dropdown">
                        <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">
                            {{ trans('sentence.language')}}<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            @php $locale = session()->get('locale'); @endphp
                            <li><a href="lang/en" class="dropdown-item">English</a></li>
                            <li><a href="lang/Bahasa" class="dropdown-item">Bahasa Melayu</a></li>
                            <li><a href="lang/Chinese" class="dropdown-item">Chinese</a></li>

                        </ul>
                    </li>

                </ul>
            </div>

            <ul class="nav navbar-nav navbar-right ml-auto">
                <li class="nav-item">
                
                <a style="margin-top:5px" data-toggle="dropdown" class="nav-link dropdown-toggle"  href="#">Scan
                        QR</a>
                    <ul class="dropdown-menu form-wrapper">
                        <li>
                            <form method="POST" action="/login2">
                                {{ csrf_field() }}
                                <p class="hint-text">Scan Your QR</p>
                

      <div class="form-group">
                                    <input name="qrcode" id="qrcode" type="password" class="form-control"
                                        placeholder="qrcode"  autofocus="autofocus" >
                                       
                                </div>
                                <script>
   function myFunction() {
     document.getElementById("qrcode").focus();
}
  </script>
      <input type="submit" class="btn btn-primary btn-block"
                                    value="{{ trans('sentence.login')}}">

                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a style="margin-top:5px" data-toggle="dropdown" class="nav-link dropdown-toggle"
                        href="#">{{ trans('sentence.login')}}</a>
                    <ul class="dropdown-menu form-wrapper">
                        <li>
                            <form method="POST" action="/login">
                                {{ csrf_field() }}
                                <p class="hint-text">{{ trans('sentence.signwithstaffid')}}</p>

                                <div class="form-group">
                                    <input name="StaffID" id="StaffID" type="text" class="form-control"
                                        placeholder="{{ trans('sentence.staffID')}}" required="required">
                                </div>
                                <div class="form-group">
                                    <input name="password" id="password" type="password" class="form-control"
                                        placeholder="{{ trans('sentence.password')}}" required="required">
                                </div>
                                <input type="submit" class="btn btn-primary btn-block"
                                    value="{{ trans('sentence.login')}}">
                                <div class="form-footer">
                                    <a href="#">{{ trans('sentence.forgotyourpassword')}}</a>
                                </div>

                            </form>
                        </li>
                    </ul>
                </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <li class="nav-item">
                    <a href="#" data-toggle="dropdown"
                        class="btn btn-primary dropdown-toggle get-started-btn mt-1 mb-1">{{ trans('sentence.signup')}}</a>
                    <ul class="dropdown-menu form-wrapper">
                        <li>
                            <form class="" method="post" action="{{URL::to('home2')}}">
                                @csrf
                                <p class="hint-text">Fill in this form to create your account!</p>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="name" value=""
                                        required="required">
                                </div>

                                <div class="form-group">
                                    <input name="StaffID" type="text" class="form-control" value=""
                                        placeholder="Staff ID" required="required">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" class="form-control" placeholder="Email" value=""
                                        required="required">
                                </div>

                                <div class="form-group" name="location">
                                    <script type="text/javascript">
                                    // Prevent dropdown menu from closing when click inside the form
                                    $('.dropdown-menu').on('click', function(e) {
                                        e.stopPropagation();
                                    });
                                    </script>
                                    <select class="form-control form-control-sm" name="location">
                                        <option name="location" value="" selected disabled>Select Location</option>
                                        <option name="location" value="Plant Z">Plant Z</option>
                                        <option name="location" value="Plant M">Plant M</option>
                                        <option name="location" value="Plant P">Plant P</option>
                                     
                                    </select>
                                </div>
                                <div class="form-group" name="dept">
                                    <script type="text/javascript">
                                    // Prevent dropdown menu from closing when click inside the form
                                    $('.dropdown-menu').on('click', function(e) {
                                        e.stopPropagation();
                                    });
                                    </script>
                                    <select class="form-control form-control-sm" name="dept">
                                        <option name="dept" value="" selected disabled>Select Department</option>
                                        <option name="dept" value="BIS">BIS</option>
                                        <option name="dept" value="QA">QA</option>
                                        <option name="dept" value="Planner">Planner</option>
                                        <option name="dept" value="Manufacturing">Manufacturing</option>
                                        <option name="dept" value="Warehouse">Warehouse</option>
                                        <option name="dept" value="Driver">Driver</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-sm" name="role">
                                        <option name="role" value="" selected disabled>Select Role</option>
                                        <option name="role" value="Top Manager">Top Manager</option>
                                        <option name="role" value="Manager">Manager</option>
                                        <option name="role" value="Supervisor">Supervisor</option>
                                        <option name="role" value="Operator">Operator</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" value=""
                                        placeholder="Password" required="required">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                </div>

                                <div class="form-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" placeholder="Confirm Password" required="required">
                                </div>


                                <div class="form-group">
                                    <label class="checkbox-inline"><input type="checkbox" required="required"> I accept
                                        the <a href="#">Terms &amp; Conditions</a></label>
                                </div>
                                <input type="submit" class="btn btn-primary btn-block" value="Sign up">
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</body>
<!-- Bootstrap core CSS -->
<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="css/modern-business.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox" style="text-align: center">
                <!-- Slide One - Set the background image for this slide in the line below -->
                <div class="carousel-item active">
                    <img src="{{ asset('/img/lands1.jpg') }}">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <!-- Slide Two - Set the background image for this slide in the line below -->
                <div class="carousel-item">
                    <img src="{{ asset('/img/lands2.jpg') }}">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
                <!-- Slide Three - Set the background image for this slide in the line below -->
                <div class="carousel-item">
                    <img src="{{ asset('/img/lands3.jpg') }}">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </header>
    <br>
    <!-- Page Content -->
    <div class="container">
        <h1 class="my-4" style="text-align:center">{{ trans('sentence.welcome')}}</h1>
        <!-- Marketing Icons Section -->
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header" style="background-color: #d1df2a">{{ trans('sentence.barcodesystem')}}</h4>
                    <div class="card-body">
                        <p class="card-text">{{ trans('sentence.descriptionbs')}}</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#myModal">{{ trans('sentence.viewmore')}}</button>
                        <!--<a href="scanop" class="btn btn-primary">{{ trans('sentence.viewmore')}}</a>-->
                    </div>

                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header" style="background-color: #d1df2a">{{ trans('sentence.carssystem')}}</h4>
                    <div class="card-body">
                        <p class="card-text">{{ trans('sentence.descriptioncars')}}</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">{{ trans('sentence.viewmore')}}</a>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    <h4 class="card-header" style="background-color: #d1df2a">{{ trans('sentence.ekanbansystem')}}</h4>
                    <div class="card-body">
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse
                            necessitatibus neque.</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">{{ trans('sentence.viewmore')}}</a>
                    </div>
                </div>
            </div>



        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title">Choose Device</h4>
                    </div>
                    <div class="modal-body">
                        <center>
                          
                                    <?php $device = DB::table('device')->get(); ?>
                                    <div class="row">
                                         @foreach ($device as $device)
                                        <div class="col-md-3">
                                            
                                    <form action="/scanop" method="get">
                                       
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <input type='text' name='deviceId' value="{{$device->deviceId}}" hidden>
                                            <?php 
										
                                            if($device->status == "online" && $device->deviceId != 'AZ2') {
                                            echo '<center><a><img style="width:100px; height:70px"
                                                        src=/img/device/mobile.png> </center> <center><input
                                                        class="btn btn-info" type="submit"
                                                        value="'.$device->deviceId.'"/><br>
                                                    <p style="color:green; font-size:12px"><span
                                                            class="dot"></span>&nbsp;'.$device->status.'</p>
                                            </center>';
                                            }else{
                                                echo '<center><a><img style="width:100px; height:70px"
                                                src=/img/device/mobile.png> </center> <center><input
                                                class="btn btn-info" type="submit"
                                                value="'.$device->deviceId.'" disabled/><br>
                                            <p style="color:grey; font-size:12px"><span
                                                    class="dot2"></span>&nbsp;'.$device->status.'</p>
                                    </center>';
                                            }
                                            ?>
                                        
                                    </form>
                                  
                                        </div>
                                          @endforeach
                                    </div>
                                   

                                
                        </center>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.row -->
        <!-- Portfolio Section -->
        <br><br>
        <style>
        .dot {
            height: 7px;
            width: 7px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
        }

        .dot2 {
            height: 7px;
            width: 7px;
            background-color: grey;
            border-radius: 50%;
            display: inline-block;
        }
        </style>
        <h2 style="text-align:center">{{ trans('sentence.ourdeveloper')}}</h2>
        <center>
            <div class="row">
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100" style="border:0px">
                        <a href="#"><img class="card-img-top"> <img height="150" width="150"
                                src="{{ asset('/img/icon6.png') }}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a>{{ trans('sentence.projectmanager')}}</a>
                            </h4>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100" style="border:0px">
                        <a href="#"><img class="card-img-top"><img height="150" width="150"
                                src="{{ asset('/img/icon4.png') }}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a>{{ trans('sentence.webdeveloper')}}</a>
                            </h4>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100" style="border:0px">
                        <a href="#"><img class="card-img-top"><img height="150" width="150"
                                src="{{ asset('/img/icon3.png') }}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a>{{ trans('sentence.webdeveloper')}}</a>
                            </h4>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100" style="border:0px">
                        <a href="#"><img class="card-img-top"><img height="150" width="150"
                                src="{{ asset('/img/icon2.png') }}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a>{{ trans('sentence.webdeveloper')}}</a>
                            </h4>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100" style="border:0px">
                        <a href="#"><img class="card-img-top"><img height="150" width="150"
                                src="{{ asset('/img/icon1.png') }}"></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a>{{ trans('sentence.webdeveloper')}}</a>
                            </h4>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </center>
        <!-- /.row -->
        <!-- Features Section -->
        <br>
        <div class="row">
            <div class="col-lg-6">
                <h2>{{ trans('sentence.productseries')}}</h2>
                <ul>
                    <li>{{ trans('sentence.productdes1')}}</li>
                    <li>{{ trans('sentence.productdes2')}}</li>
                    <li>{{ trans('sentence.productdes3')}}</li>
                    <li>{{ trans('sentence.productdes4')}}</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded" src="{{ asset('/img/Map.png') }}" alt="">
            </div>
        </div>
        <!-- /.row -->
        <hr>
        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
                <ul>
                    <li>{{ trans('sentence.officenumber')}}: +605 323 2788</li>
                    <li>{{ trans('sentence.faxnumber')}}: +605 323 9236 | 322 9237</li>
                    <li>{{ trans('sentence.email')}}: customerservice@polyware.com.my</li>
                </ul>
            </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-primary btn-block"
                    href="mailto:customerservice@polyware.com.my">{{ trans('sentence.email')}}</a>
            </div>
        </div>
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>



    <link rel="stylesheet" href="assets/css/Footer-with-button-logo.css">

    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>