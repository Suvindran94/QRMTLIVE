<!DOCTYPE html>
<html lang="en">
 
  
   <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR Monitoring and Tracking System</title>
	   <?php use Carbon\Carbon ?>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/assets/vendors/css/vendor.bundle.base.css">
	   <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/assets/css/style.css">
    <!-- End layout styles -->
   
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <br>
          <a>QR System</a>
        
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <div class="d-flex align-items-center h-100" >
				<a href="/logout"><img src=/img/poly.png style="width:150px"></a>
            </div>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                <img src="img/tracking/user.png" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                @if( auth()->check() )
                  <p class="mb-1 text-black">{{ auth()->user()->name }}</p>
                  @endif
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="img/tracking/user.png" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                @if( auth()->check() )
                  <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
                  @endif
                  <span class="text-secondary text-small">Admin</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/staff">
                <span class="menu-title">Staff</span>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/productivity">
                <span class="menu-title">Productivity</span>
                <i class="mdi mdi-chart-bar menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/template">
                <span class="menu-title">Template Sticker</span>
                <i class="mdi mdi-barcode-scan menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/tracking">
                <span class="menu-title">Tracking</span>
                <i class="mdi mdi-map-marker menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/device">
                <span class="menu-title">Device</span>
                <i class="mdi mdi-cellphone-link menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">
                <span class="menu-title">Setting</span>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
            </li>

            
            <li class="nav-item">
              <a class="nav-link" href="/telescope" target="_blank">
                <span class="menu-title">Telescope</span>
                <i class="mdi mdi-telescope menu-icon"></i>
              </a>
            </li>
         
            
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
                <span hidden>
                 
                  <a href="https://github.com/BootstrapDash/PurpleAdmin-Free-Admin-Template" target="_blank" class="btn ml-auto download-button" hidden>Download Free Version</a>
                  <a href="https://www.bootstrapdash.com/product/purple-bootstrap-4-admin-template/" target="_blank" class="btn purchase-button" hidden>Upgrade To Pro</a>
                  <i class="mdi mdi-close" id="bannerClose"></i>
                </span>
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> QR Monitoring and Tracking System </h3>
            </div>
            <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Manufacturing Department</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Role </th>
                            <th> Total hours </th>
                            <th> Target<br>(NOS) </th>
                            <th> Achieved<br>(NOS) </th>
                            <th> Productivity </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $user = DB::table('users')->where('dept', '=', '4')->orderByRaw("FIELD(role, '21', '16')")->paginate(10,['*'],'manufacturing');
                        $i = 1; 
                        ?>
                        @foreach ($user as $users)
                          <tr>
                                <?php 
                                  date_default_timezone_set("Asia/Kuala_Lumpur");
                                  $date = date('Y-m-d');
                                  $dt = Carbon::now();
                                  $time = $dt->toTimestring();
                                  $cur_date = carbon::now();
                                  $pro = DB::table('qrmaster')->where('asgnto','=', $users->StaffID)->where('dt_opscancomplete','LIKE', '%'.$date.'%')->get();
                                  $pro2 = DB::table('qrmaster')->distinct('dt_opasgn')->where('asgnto','=', $users->StaffID)->count('dt_opasgn');
                                  $try = DB::table('qrmaster')->distinct('opasgn')->where('asgnto','=', $users->StaffID)->where('dt_opscancomplete','LIKE', '%'.$date.'%')->get();

                                if($users->role == '21'){
                                    
                                }else{
                                  $sum2 = 0;
                                  foreach ($try as $trys){
                                  $pro3 = DB::table('stockcode_target')->where('stockcode','=', $trys->stockcode)->get();
                                  foreach ($pro3 as $pros3){
                                        $sum2+= $pros3->t_hr_nos;
                                    }
                                  }
                                  
                                  $total = DB::table('users_clockinout')->where('StaffID','=', $users->StaffID)->where('date', '=', $date)->get();
                                  ['$total'=>$total];
                                  $var = 0;
                                  foreach ($total as $totals){
                                     
                            $ttl = (new Carbon($time))->diff(new Carbon($totals->clock))->format('%h');
                                   $var = $ttl*$sum2;
                                  }
                                  
                                  
                                  $sum = 0;
                                  foreach ($pro as $pros){
                                        $sum+= $pros->pbag;
                                        }
                                   
                                    if ($var == 0){
                                        $var2 = 0;
                                    }else{
                                        $var3 = ((ceil($sum))/$var)*100;
                                        if ($var3 > 100){
                                            $var2 = 100;
                                        }else{
                                            $var2 = ((ceil($sum))/$var)*100;
                                        }
                                    }
                                }
                                  ?>
                            <td> {{$i++}}  </td>
                            <td> {{$users->name}} </td>
                            <td> {{$users->role}} </td>
                            <td> 
                            @if($users->role == '21')
                            <a style = 'color:grey'>Coming Soon</a>
                            @else
                            <?php $total2 = DB::table('users_clockinout')->where('StaffID','=', $users->StaffID)->where('date', '=', $date)->first();
                            if ($total2 == NUll){
                                echo '<span style = "background-color:grey; border-radius:20px; color:white; ">&nbsp;&nbsp;Not in shift&nbsp;&nbsp;</span>';
                            }else{
                                ?>
                            @foreach ($total as $totals)
                            @if ($loop->first)
                                <span style= "background-color:green; border-radius:20px; color:white; ">&nbsp;&nbsp;{{(new Carbon($time))->diff(new Carbon($totals->clock))->format('%h')}}&nbsp;&nbsp;</span>
                            @endif
                            @endforeach
                            <?php
                            }
                            
                            ?>

                            @endif
                            </td>
                            <td> 
                            <?php 
                            if($users->role == '21'){
                                echo '0';
                            }else{
                            echo $var;
                            }
                            ?> </td>
                            <td> <?php
                             if($users->role == '21'){
                                echo '0';
                            }else{
                            echo $sum2;
                            }
                            ?> </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: <?php 
                                if($users->role == '21'){
                                    echo '0';
                                }else{
                                    echo ceil($var2);
                                }
                                
                                ?>%; color:black; font-size:10px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                  <?php 
                                  if($users->role == '21'){
                                      echo '0';
                                  }else{
                                      echo ceil($var2);
                                  }
                                  ?>%
                                </div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table><br>
                      {{$user->appends(request()->input())->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> QA Department</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Role </th>
                            <th> Productivity </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $user2 = DB::table('users')->where('dept', '=', '6')->paginate(5); 
                        $i = 1; 
                        ?>
                        @foreach ($user2 as $users2)
                          <tr>
                            <td>{{$i++}}  </td>
                            <td> {{$users2->name}} </td>
                            <td> {{$users2->role}} </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table><br>
                      {{$user2->appends(request()->input())->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> Warehouse Department</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Role </th>
                            <th> Productivity </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $user3 = DB::table('users')->where('dept', '=', '3')->paginate(5); 
                        $i = 1; 
                        ?>
                        @foreach ($user3 as $users3)
                          <tr>
                            <td>{{$i++}}  </td>
                            <td> {{$users3->name}} </td>
                            <td> {{$users3->role}} </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table><br>
                      {{$user3->appends(request()->input())->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"> BIS Department</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> Name </th>
                            <th> Role </th>
                            <th> Productivity </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $user4 = DB::table('users')->where('dept', '=', '1')->paginate(5); 
                        $i = 1; 
                        ?>
                        @foreach ($user4 as $users4)
                          <tr>
                            <td>{{$i++}}  </td>
                            <td> {{$users4->name}} </td>
                            <td> {{$users4->role}} </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table><br>
                      {{$user4->appends(request()->input())->links('pagination::bootstrap-4')}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
          
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/assets/js/off-canvas.js"></script>
    <script src="assets/assets/js/hoverable-collapse.js"></script>
    <script src="assets/assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/assets/js/dashboard.js"></script>
    <script src="assets/assets/js/todolist.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>