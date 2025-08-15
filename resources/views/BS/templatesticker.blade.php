<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>QR Monitoring and Tracking System</title>
    <!-- plugins:css -->
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <link rel="stylesheet" href="assets/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/assets/css/style.css">
    <!-- End layout styles -->
	
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
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
                    <div class="d-flex align-items-center h-100">
						<a href="/logout"><img src=/img/poly.png style="width:150px"></a>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown"
                            aria-expanded="false">
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
                            <a class="dropdown-item"  href="/logout">
                                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                        </div>
                    </li>
                   
                  
                  
                
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="">
                            <span class="menu-title">Template Sticker</span>
                            <i class="mdi mdi-barcode-scan menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item ">
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
                           
                        </div>
                    </div>
                    <div class="page-header">
                        <h3 class="page-title">
                            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                                <i class="mdi mdi-home"></i>
                            </span> QR Monitoring and Tracking System </h3>

                    </div>

					<a id="logourl"></a>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
								
                                <div class="card-body">
                                    <div class="container"
                                        style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5); padding:5px; width:11cm">
                                        <table class="page-break" align="center" border="0px"
                                            style="margin-top: 5px; width:10.5cm; height: 7cm; ">
                                            <tr>
												<td colspan="1"style="background-color:black; border: 5px solid white; color:white;  width:120px; font-size:40px; text-align:center;">
                                                    <b>MTA</b></td>
												
												  <td colspan="2" style="text-align:right;"><img style="height: 70px; width:90px; text-align:center;"
                                                        src="./img/barcodetemplate/logo/MTA.png" /></td>
												
                                               
                                               
                                               <td colspan="3"><img style="height: 50px; width:150px; text-align:center;visibility:hidden"
                                                        src="./img/barcodetemplate/logo/pen.png" id="penlogo"/></td>
                                             
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="border:0.5px black solid; margin: 1px">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-transform: uppercase; font-size:13px">
                                                    <b>PENGUIN SMART SERIES THREAD ADAPTOR 32MM X 1</b></td>
                                            </tr>
											
                                            <tr>

                                                <td colspan="2" style="text-transform: uppercase; font-size:13px"><b>QTY
                                                        :
                                                        200 NOS / BAG</b></td>
												     <td colspan="2" id="arstockcode" style="text-transform: uppercase; font-size:13px; visibility:hidden;"><b>21005</b></td>
          <td style="text-align:center; font-size:14px; text-align:right" colspan="2"><b>1/5</b></td>
		
                                            </tr>
											
									
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:1px; border:0.5px black solid">
                                                </td>
                                            </tr>
                                            <tr style="margin:0px;">
                                                <td colspan="2" style="font-size:10px"><b>S/O : SO19/00808</b></td>



                                                <td style="font-size:10px;text-align:center; text-align:right"
													colspan="4"><a id="sototalsequence" style="font-weight:bold; padding-right:30px; display:none;">1/26</a><b>S/M : A0021</b>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <hr style="margin:2px; border:0.5px black solid">
                                                </td>
                                            </tr>
                                            <tr style="margin:0">
                                                <td style="font-size:9px; text-transform: uppercase;'margin-top:0px"
                                                    colspan="2">
                                                    <b>11MTA-032G--7AK0K0</b><br>

                                                    <b> QC BY : 1234</b><br>
                                                    <b>DATE : 12/12/2019</b>
                                                </td>


                                                <td colspan="4" align="right">
                                                
                        <img style="height:35px;width:35px;visibility:hidden;" src="./img/barcodetemplate/qr.png" id="qrwebsiteimg"/>
                         <img style="height:35px;width:35px; display:none;" src="./img/barcodetemplate/logo/mly.png" id="buatanmy"/>
                          <img style="height:35px;width:60px; display:none;" src="./img/barcodetemplate/logo/intertek iso2001-2015.png" id="isoimg"/>
                                                    <?php $png = QrCode::format('png')->generate('testing');
        $png = base64_encode($png);
        echo "<img style=' width:30px; height:35px'src='data:image/png;base64," . $png . "'>";
        ?>
                                                </td>

                                            </tr>
                                            <tr style="margin:0">
                                                <td style="font-size:7px; text-align:center; margin:0" colspan="3">
                                                    <b>www.polyware.com.my</b></td>

                                            </tr>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
								   @if (session()->has('message'))
                            <div class="alert alert-dismissable alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                {!! session()->get('message') !!}

                            </div>
                            @endif
                                <div class="card-body">
                                    <p><b>Choose Shipping Mark</b>&nbsp;
                                        (Tick to show in the sticker)
                                        <?php $temp = DB::table('solist')->distinct()->select('shipmark')->get(); ?>
										 <form style="margin-top:30px" action="/editdesign" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <select class="ui dropdown" name='shipmark' id="shipmark">
											 <option selected disabled>Select Shipmark</option>
                                            @foreach ($temp as $temp)
                                            <option value="{{$temp->shipmark}}">{{$temp->shipmark}}</option>
                                            @endforeach
                                        </select></p><br>
									<b>Design Template</b>
									 <div class="form-check">
                                            <label class="form-check-label">
												
												<input type="radio" class="form-check-input radio" name="design"
													   value="default" id="default"> Default
												
										 </label>
									</div>
									 <div class="form-check">
                                            <label class="form-check-label">
												<input type="radio" class="form-check-input radio" name="design"
                                                    value="custom" id="custom"> Custom
												
										 </label>
									</div>
                                   
<br>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                               
                                                <input type="checkbox" class="form-check-input" name="penguinlogo"
                                                    id="penguinlogo" value="1"> Penguin Logo </label>                   
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                               <input type="checkbox" class="form-check-input" name="qrwebsite" id="qrwebsite" value="1"> QR Website </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                               
                                               <input type="checkbox" class="form-check-input" name="bmlogo" id="bmlogo" value="1">
                                                Buatan Malaysia Logo </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                              <input type="checkbox" class="form-check-input" name="isologo"
                                                    id="isologo" value="1"> ISO Logo </label>
                                        </div>
															<div class="form-check">
                                            <label class="form-check-label">
                                               
                                               <input type="checkbox" class="form-check-input" name="soTotalSeq"
                                                    id="soTotalSeq" value="1"> SO Total Sequence </label>
                                        </div>
																
										<div class="form-check">
                                            <label class="form-check-label">
                                               <input type="checkbox" class="form-check-input" name="custStkID"
                                                    id="custStkID" value="1"> Customer Stock ID </label>
                                        </div>
											
							<br>				
											<p class="image" style="display:none;"><b>Image Logo Custom</b></p>
      <input type="file" class="form-control image" name="image" placeholder="image" style="display:none;">
    
                                        <div class="form-check">
                         <input type="button" class="btn btn-success btn-md" value="Submit" id="submitdesign1">
											 <input type="submit" class="btn btn-success btn-md" value="Submit" id="submitdesign2" hidden>
                                        </div>

                                    </form>
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
								
							
		<script>
			$(document).ready(function() {
				$("#shipmark").change(function() {

					var id = $(this).find('option:selected').attr("value");
					var url = '{{ route("getShipmark", ":ID") }}';
					url = url.replace(':ID', id);
					$.ajax({
						type: 'get',
						url: url,
						dataType: 'json',
						success: function(response) {
							
							var logo = response.logo;
							$('#logourl').html(logo);
							
							
							if(logo != undefined){
							$('#penlogo').prop('src','./img/barcodetemplate/logo/custom/'+ logo);
							}
							else{
							$('#penlogo').prop('src','./img/barcodetemplate/logo/pen.png');
							}
							
							
							
							//design
							if(response.design == 'default'){
								$('#default').prop('checked', true); // Checks it
								$('#custom').prop('checked', false); // Unchecks it
								$('.image').hide(); // Hide image
							}
							else if(response.design == 'custom'){
								$('#default').prop('checked', false); // Checks it
								$('#custom').prop('checked', true); // Unchecks it
								$('.image').show(); // show image
							}
							else{
								$('#default').prop('checked', false); // Checks it
								$('#custom').prop('checked', false); // Unchecks it
								$('.image').hide(); // Hide image
							}

							//penguinlogo
							if(response.penguinlogo == '1'){
								$('#penguinlogo').prop('checked', true); // Checks it
								$('#penlogo').css('visibility', ''); // pen logo
							}
							else if(response.penguinlogo == '0'){
								$('#penguinlogo').prop('checked', false); // Checks it
								$('#penlogo').css('visibility', 'hidden'); // pen logo
							}
							else{
								$('#penguinlogo').prop('checked', false); // Checks it
								$('#penlogo').css('visibility', 'hidden'); // pen logo
							}





							//qrwebsite
							if(response.qrwebsite == '1'){
								$('#qrwebsiteimg').css('visibility', ''); // pen logo
								$('#qrwebsite').prop('checked', true); // Checks it
							}
							else if(response.qrwebsite == '0'){
								$('#qrwebsiteimg').css('visibility', 'hidden'); // pen logo
								$('#qrwebsite').prop('checked', false); // Checks it
								
							}
							else{
								$('#qrwebsiteimg').css('visibility', 'hidden'); // pen logo
								$('#qrwebsite').prop('checked', false); // Checks it
							}

							//bmlogo
							if(response.bmlogo == '1'){
								$('#bmlogo').prop('checked', true); // Checks it
								$('#buatanmy').show(); // buatanmy
							}
							else if(response.bmlogo == '0'){
								$('#bmlogo').prop('checked', false); // Checks it
								$('#buatanmy').hide(); // buatanmy
							}
							else{
								$('#bmlogo').prop('checked', false); // Checks it
								$('#buatanmy').hide(); // buatanmy
							}

							//isologo
							if(response.isologo == '1'){
								$('#isologo').prop('checked', true); // Checks it
								$('#isoimg').show(); // isoimg
							}
							else if(response.isologo == '0'){
								$('#isologo').prop('checked', false); // Checks it
								$('#isoimg').hide(); // isoimg
							}
							else{
								$('#isologo').prop('checked', false); // Checks it
								$('#isoimg').hide(); // isoimg
							}

							//soTotalSeq
							if(response.soTotalSeq == '1'){
								$('#soTotalSeq').prop('checked', true); // Checks it
								$('#sototalsequence').show(); // sototalseq
							}
							else if(response.soTotalSeq == '0'){
								$('#soTotalSeq').prop('checked', false); // Checks it
								$('#sototalsequence').hide(); // sototalseq

							}
							else{
								$('#soTotalSeq').prop('checked', false); // Checks it
								$('#sototalsequence').hide(); // sototalseq
							}

							//custStkID
							if(response.custStkID == '1'){
								$('#custStkID').prop('checked', true); // Checks it
								$('#arstockcode').css('visibility', ''); // arstkcode
							}
							else if(response.custStkID == '0'){
								$('#custStkID').prop('checked', false); // Checks it
								$('#arstockcode').css('visibility', 'hidden'); // arstkcode
							}
							else{
								$('#custStkID').prop('checked', false); // Checks it
								$('#arstockcode').css('visibility', 'hidden'); // arstkcode
							}

						}
					});

				});
			});
		</script>
		
		<script>
			$(document).ready(function() {
				//penguin logo
				$('#penguinlogo').click(function(){
					if($(this).prop('checked') == true){
						$('#penlogo').css('visibility', ''); // pen logo 
					}
					else {
						$('#penlogo').css('visibility', 'hidden'); // pen logo
					}
				});
				
				$('#qrwebsite').click(function(){
					if($(this).prop('checked') == true){
						
						$('#qrwebsiteimg').css('visibility', ''); // pen logo
					}
					else {
								$('#qrwebsiteimg').css('visibility', 'hidden'); // pen logo
					}
				});
				
				$('#bmlogo').click(function(){
					if($(this).prop('checked') == true){

						$('#buatanmy').show(); // buatanmy
					}
					else {
						$('#buatanmy').hide(); // buatanmy
					}
				});
				
					$('#isologo').click(function(){
					if($(this).prop('checked') == true){

						$('#isoimg').show(); // isoimg
					}
					else {
						$('#isoimg').hide(); // isoimg
					}
				});
				
					$('#soTotalSeq').click(function(){
					if($(this).prop('checked') == true){

					
					$('#sototalsequence').show(); // sototalseq
					}
					else {
					$('#sototalsequence').hide(); // sototalseq
					}
				});
				
				$('#custStkID').click(function(){
					if($(this).prop('checked') == true){
					
					$('#arstockcode').css('visibility', ''); // arstkcode
					}
					else {
					$('#arstockcode').css('visibility', 'hidden'); // arstkcode
					}
				});
				
		
				
       			$('.radio').click(function () {
				
				var button1 = document.getElementById("default");
				var button2 = document.getElementById("custom");
		
				if (button1.checked){
					$('.image').hide(); // show image
					
				}else if (button2.checked) {
					$('.image').show(); // show image
				}
				
					});
			});
		</script>
		
		<script>
    $(document).ready(function(){
      $("#submitdesign1").click(function() {
		 var shipmark = jQuery("#shipmark option:selected").attr("value");
		 var type =  $("input[name='design']:checked").val();
		  
		  if(shipmark == undefined && type == undefined){
		  alert('Please select Shipmark and Design Type !');
		  }
		  else if(shipmark == undefined){
			 alert('Please select Shipmark !');
		  }
		  else if(type == undefined){
			 alert('Please select Design Type !');
		  }
		  else{
			  $("#submitdesign1").prop('disabled',true);
			  $("#submitdesign1").val('Saving..');
			  $("#submitdesign2").trigger('click');
		  }
		  
		 
		});
			});
		</script>
							

								
		
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
									  <!-- Jquery JS-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
									<script>
							$(document).ready(function() {
           						 // Initialize select2
									$("#shipmark").select2({
										width:'300px',
										sorter: function(results) {
											var query = $('.select2-search__field').val().toLowerCase();
											return results.sort(function(a, b) {
												return a.text.toLowerCase().indexOf(query) -
													b.text.toLowerCase().indexOf(query);
											});
										}
									});
									});
								</script>
						
								
								
								
</body>

</html>