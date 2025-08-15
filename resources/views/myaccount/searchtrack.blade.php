<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	 <title>SO Tracking</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<?php use Carbon\Carbon;?>
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

p {
    text-transform: uppercase;
}

li1 {
    width: 60px;
    height: 60px;
    line-height: 26px;
    font-size: 12px;
    font-family: arial, calibri, sans-serif;
    font-weight: bold;
    text-align: center;
    border-radius: 50%;
    background: green;
    display: inline-block;
    color: white;
    position: relative;
    margin: 0px 10px;

}

li1::before {
    content: '';
    position: absolute;
    top: 50%;
    left: -100%;
    width: 100%;
    height: 1px;
    background: dodgerblue;
    z-index: -1;
}

li1:first-child::before {
    display: none;
}

li1:after {}

.active {
    background: green;
}

.active~li1 {
    background: lightblue;
}

.active~li1::before {
    background: lightblue;
}

li1>span {
    position: absolute;
    top: 25px;
    left: -4;
    font-size: 10.5px;
    line-height: 100%;
    content: attr(data-step);
    color: white;
}

li1>p {
    position: absolute;
    top: 25px;
    left: 0;
    font-size: 11px;
    line-height: 100%;
    content: attr(data-step);
    color: black;
}
span1 {
  color: green;
  display: block;
  float: right;
  text-align: right;
}
#sticky {
  padding: 0.5ex;
 
  border-radius: 0.5ex;
}

#sticky.stick {
  position: fixed;
  margin-left: 260px;
  top: 5px;
  z-index: 10000;
  border-radius: 5px;
  background-color:white;
  border: 1px black solid;
  width:46%;
}

</style>

<body>
    <br><br>
    <div class="container">
    <?php
							if (Auth::check())
                            $name = auth()->user()->dept;
                            $name2 = auth()->user()->role;
                            if($name === "Manufacturing" && $name2 === "Supervisor"){
                                echo '<a href="/BShomesu" class="btn btn-success" style="width:100px;">Home</a>';
                            }elseif($name === "BIS"){
                            echo '<a href="/admin" class="btn btn-success" style="width:100px;">Home</a>';
                            }else{
                                echo '<a href=/BShome'.$name.' class="btn btn-success" style="width:100px;">Home</a>';
                            }
							

    ?>
        
      
        <div class="row">
            <div class="col-sm-12">
               
                <h1 style="color:white;"><b>{{$soshipmark->shipmark}}&nbsp;{{$so}}</b></h1><br>
				
			
                <script>
                function sticky_relocate() {
  var window_top = $(window).scrollTop();
  var div_top = $('#sticky-anchor').offset().top;
  if (window_top > div_top) {
    $('#sticky').addClass('stick');
  } else {
    $('#sticky').removeClass('stick');
  }
}

$(function() {
  $(window).scroll(sticky_relocate);
  sticky_relocate();
});
                </script>
                <div id="sticky-anchor"></div>
                <center>
                <div id="sticky">
                    <ul1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/socreate.png" /><a
                                style="color:black">SO Created</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/assign.png" /><a
                                style="color:black">Operator Assigned</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/printer.png" /><a
                                style="color:black">Print Completed</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/scan1.png" /><a
                                style="color:black">Operator Scan</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/receive.png" /><a
                                style="color:black">SV Received</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/checked.png" /><a
                                style="color:black">QA Checked</a></li1>
                        <li1><img style="height: 60px; width:60px" src="/img/tracking/warehouse.png" /><a
                                style="color:black">Warehouse Received</a></li1>
                    </ul1>
                    </div>
                </center>
            </div>
        </div>
    </div><br><br>
    <div class="container">
   <form action="/searchtracking" method="GET">
           <table>
			   <tr>
				   <td>
            <div class="input-group">
            
            <input type="text" class="form-control" name="sonum" value="{{$so}}" hidden> 
           		
                <select class="form-control" name="stockcode" id="stockcode" required>
					<option value="" selected disabled>Select Products</option>
					<option value="All">Show All</option>
					@foreach($stockcodes as $stk)
					<option value="{{$stk->stockcode}}">{{$stk->stockcode}} - {{$stk->particular}}&nbsp;{{$stk->particular2}}</option>
					@endforeach
				</select>
				  </div>
				   </td>
				   <td>
	  
				<center>
                    <button type="submit" class="btn btn-success" value="Search" >
                      Search
                    </button>
				</center>
				   </td>
			   </tr>
	   </table>
               
          
        </form>
</div>
		 <div class="container">
        @if (Session::has('message'))
                <div class="alert alert-dismissable alert-warning">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                   <strong>Whoops!</strong>  {!! Session::pull('message') !!}

                </div>
                @endif
		     </div>
   
   <script>
	   $(document).ready(function() {
    $('#stockcode').select2();
});
	</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 
    <br> <br> <br> <br>
</body>

</html>