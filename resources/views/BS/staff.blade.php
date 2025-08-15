<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR Monitoring and Tracking System</title>
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
      <div class="container-fluid page-body-wrapper">
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="img/tracking/user.png" alt="profile">
                  <span class="login-status online"></span>
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
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  @if (session()->has('message'))
                    <div class="alert alert-dismissable alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        {!! session()->get('message') !!}

                    </div>
                    @endif
                    <h4 class="card-title"> Staff </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Name </th>
                            <th> Staff ID </th>
                            <th> Department </th>
                            <th> Role </th>
                            <th> Last Updated </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $user = DB::table('users')->paginate(5); ?>
                        @foreach ($user as $users)
                          <tr>
                            <td>{{$users->name}} </td>
                            <td> {{$users->StaffID}} </td>
                            <td>
                            <?php
                            if ($users->dept == 'BIS'){
                              echo '<label class="badge badge-gradient-success">'.$users->dept.' </label>';
                            }
                            elseif ($users->dept == 'QA'){
                              echo '<label class="badge badge-gradient-warning">'.$users->dept.' </label>';
                            }
                            elseif ($users->dept == 'Manufacturing'){
                              echo '<label class="badge badge-gradient-info">'.$users->dept.' </label>';
                            }
                            elseif ($users->dept == 'Warehouse'){
                              echo '<label class="badge badge-gradient-danger">'.$users->dept.' </label>';
                            }
                            else{
                              echo '<label class="badge badge-gradient-danger">'.$users->dept.' </label>';
                            }
                            ?>
                            </td>
                            <td> {{$users->role}}  </td>
                            <td> {{$users->updated_at}}  </td>
                            <td> 
                            <form action="/editstaff" method="get">
                                <input type='text' name='StaffID' value="{{$users->StaffID}}" hidden>
                                <input class="btn btn-gradient-success btn-rounded btn-fw" style="width:120px" type='submit' value="Edit" /> 
                                </form>
                              
                                <form action="/qr" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type='text' name='StaffID' value="{{$users->StaffID}}" hidden>
                                <input type='text' name='location' value="{{$users->location}}" hidden>
                                <input class="btn btn-gradient-danger btn-rounded btn-fw" style="width:120px" type='submit' value="Generate QR" /> 
                                </form>
                                <form action="/printqr/{{$users->StaffID}}" method="get">
                                <input type='text' name='StaffID' value="{{$users->StaffID}}" hidden>
                                <input class="btn btn-gradient-info btn-rounded btn-fw" style="width:120px" type='submit' value="Print QR" /> 
                                </form>
															<!--New Code Portion begin-->
							<form  target="_blank" action="/printqrP/{{$users->StaffID}}" method="get">
								<input type='text' name='StaffID' value="{{$users->StaffID}}" hidden>
								<input class="btn btn-gradient-info btn-rounded btn-fw" style="width:140px" type='submit' value="Password QR" /> 
							</form>
							<!--New Code Portion end-->
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
            </div>
          <footer class="footer">
          </footer>
        </div>
      </div>
    </div>
    <script src="assets/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/assets/js/off-canvas.js"></script>
    <script src="assets/assets/js/hoverable-collapse.js"></script>
    <script src="assets/assets/js/misc.js"></script>
    <script src="assets/assets/js/dashboard.js"></script>
    <script src="assets/assets/js/todolist.js"></script>
  </body>
</html>