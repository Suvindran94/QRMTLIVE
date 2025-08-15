<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
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
                            if($name === "4" && $name2 === "21"){
                                echo '<a href="/BShomesu" class="btn btn-success" style="width:100px; margin-left:110px">Home</a>';
                            }elseif($name === "1"){
                            echo '<a href="/admin" class="btn btn-success" style="width:100px; margin-left:110px">Home</a>';
                            }else{
                                echo '<a href=/BShome'.$name.' class="btn btn-success" style="width:100px; margin-left:110px">Home</a>';
                            }
							

    ?>
        <a href="{{ URL::previous() }}" class="btn btn-warning" style="width:100px;">Back</a>
      
        <div class="row">
            <div class="col-sm-12">
                @foreach($pallet as $pallets)
                <h1 style="margin-left:100px; color:black"><b>{{$pallets->sonum}}</b></h1><br>
                @endforeach
     
              
            </div>
        </div>
    </div><br><br>
    <div class="container">
    <form action="/searchtrack" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
          
            <input type="text" class="form-control" name="sonum" value="" hidden> 
           
                <input type="text" class="form-control" name="stockcode"
                    placeholder="Search Pallet" style="border-radius:5px; width:101%" > <span class="input-group-btn">
                    <button type="submit" class="btn btn-success" hidden>
                      
                    </button>
                </span>
            </div>
        </form>
</div>
<?php $pallet2 = DB::table('qrmaster')
               ->distinct()
               ->select(['pallet','sonum'])
                ->where('sonum','=', $pallets->sonum)
                ->where('dt_opscancomplete','!=', NULL)
                ->get();?>
@foreach($pallet2 as $pallets2)
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading"
                    style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                    <h4 class="panel-title">
                   
                <a data-toggle="collapse" href="#{{$pallets2->pallet}}">
               {{$pallets2->pallet}}
                    </h4>
                </div>
               
                <div id="{{$pallets2->pallet}}" class="panel-collapse collapse">
                    <?php $layer = DB::table('qrmaster')
                  ->distinct()
                 ->select(['layer'])
                ->where('sonum','=', $pallets->sonum)
                ->where('dt_opscancomplete','!=', NULL)
                ->get();?>
                 <div class="container">
                 <br>
                 <a href="/printpallet/{{$pallets2->sonum}}/{{$pallets2->pallet}}"><button class="btn btn-success" style="width:100px; margin-left:53px">Print</button></a>
                 </div>
                    @foreach($layer as $layers)
                    <br>
                    <p style="margin-left:80px"><b>{{$layers->layer}}</b></p>
                    <center>
                    <?php 
                $layer2 = DB::table('qrmaster')
                ->distinct()
                ->select(['qrcode','stockcode','seq','layer','pallet','sonum','dt_spvscanrev'])
                ->where('sonum','=', $pallets->sonum)
                ->where('layer','=', $layers->layer)
                ->where('pallet','=', $pallets2->pallet)
                ->where('dt_opscancomplete','!=', NULL)
                ->get();?>
                
                @foreach($layer2 as $layers2)
                <div class="container">
              
                    <table style="width: 90%">
                  
                   <tr>
                   <td>{{$layers2->seq}}</td>
                   <td>{{$layers2->sonum}}</td>
                   <td>{{$layers2->stockcode}}</td>
                   <td>{{$layers2->dt_spvscanrev}}</td>
                   <td> 
        <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(80)->generate($layers2->qrcode)) }} ">
        </td>
                   </tr>
                   
                    </table>
                    </div>
                    @endforeach<br>
                    </center>
                    @endforeach<br>
                   
                </div>
            </div>
        </div>
    </div>
    @endforeach
    </div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <br> <br> <br> <br>
</body>

</html>