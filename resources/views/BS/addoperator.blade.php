<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- jQuery Modal -->
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
@if( auth()->check() )
@include ('Navigation.'.auth()->user()->dept)
@endif
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
</style>
<body>
    <br><br><br><br><br><br>
		
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card" style="margin-top:2em;">
                    <div class="card-header" style="background:#ebfcfc;border-radius:5px;color:black">
                        <!--@if(Session::has('message'))
                        <p>{{ Session::get('message') }}</p>
                        @endif-->
                        @if(Session::has('message'))
                        <script>
                            var sessionValue = '{!! Session::get("message") !!}';
                            
                            Swal.fire({
                                                    icon: 'success',
                                                    title: 'success',
                                                    html: sessionValue,
													showConfirmButton: false,
                                                    timer: 10000
                                                });
                        </script>
                        @endif
                        @if(Session::has('Error'))
                        <script>
                            var sessionValue = '{!! Session::get("Error") !!}';
                            
                            Swal.fire({
                                                    icon: 'error',
                                                    title: 'Whoops!',
                                                    html: sessionValue,
													showConfirmButton: false,
                                                    timer: 10000
                                                });
                        </script>
                        @endif
                        @if(Session::has('INFO'))
                        <script>
                            var sessionValue = '{!! Session::get("INFO") !!}';                               
                        Swal.fire({
                                                icon: 'info',
                                                title: 'Oops...',
                                                html: sessionValue,
                                                showConfirmButton: false,
                                                timer: 10000
                                                });
                                                </script>
                        @endif
                        @foreach ($lists2 as $list2)
                        <p><b>SO : {{$list2->sonum}}</b></p>
                        <p><b>STOCKCODE : {{$list2->stockcode}}</b></p>
                        <p><b>PARTICULAR : {{$list2->particular}}</b></p>
                        @endforeach
                    </div>
					@if($lists->count() > 0)
                    <div class="card-body" style="background:#fafafa">
                        <center>
                            <br>
                            <form action="/updaterange" method="post">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <a style="font-size:16px">
                                    @foreach ($lists as $list)
                                    <input  type="text" style="width:50px" name="sonum"
                                        value="{{$list->sonum}}" hidden>
                                    <input  type="text" style="width:50px" name="stockcode"
                                        value="{{$list->stockcode}}" hidden>
                                        <input  type="text" style="width:50px" name="deviceId"
                                        value="{{$list->deviceId}}" hidden>
                                    @endforeach
                                    From Sequence
                                    <input required id="first" type="number" style="width:50px" name="quantity1" id="num" value="" min="1"
                                        required>
                                    to
                                    <input required id="second" type="number" style="width:50px" name="quantity2" required> Operator
                                    <script>
                                    function setMin() {
                                        var first = document.getElementById("first");
                                        var second = document.getElementById("second");
                                        second.min = first.value;
                                        //second.max = <?php echo $lists->count() ?>;
                                        //first.max = <?php echo $lists->count() ?>;
                                    }
                                    var trigger = document.getElementById("first");
                                    trigger.addEventListener("change", setMin, false);
                                    </script>
                                    <select class="ui dropdown" name='asgnto' style='text-transform: uppercase' required>
                                        <option value=""></option>
                                        @foreach ($lists3 as $list3)
                                        <option value="{{$list3->StaffID}}">{{$list3->StaffID}} - {{$list3->name}}</option>
                                        @endforeach
                                    </select>
                                    <input class="btn btn-info" style="width:120px" type='submit' value="Save" />
                                </a>
                            </form>
                            <a style="font-size:16px">Current Sticker : </a>
						
                            @foreach ($lists as $list)
                            <?php 
                     $who = DB::table('qrmaster')->distinct()->get(['stockcode','sonum','asgnto'])->where('stockcode','=', $list->stockcode)->where('sonum','=', $list->sonum);
                     $who2 = DB::table('qrmaster')->where('stockcode','=', $list->stockcode)->where('sonum','=', $list->sonum)->where('asgnto','=', $list->asgnto)->count();
						
                    ?>
                            @endforeach
                            @foreach ($who as $who)
                            <?php $who3 = DB::table('users')->get(['name','StaffID'])->where('StaffID','=', $who->asgnto);?>
                            @foreach ($who3 as $who3)
                            <?php $who4 = DB::table('qrmaster')->where('stockcode','=', $list->stockcode)->where('sonum','=', $list->sonum)->where('asgnto','=', $who->asgnto)->count();
								$who22 = DB::table('qrmastersmb')->where('stockcode','=', $list->stockcode)->where('sonum','=', $list->sonum)->where('asgnto','=', $who->asgnto)->count(); ?>
                            <a style="font-size:16px"><span
                            style="background-color:yellow; border-radius:20px;text-transform: uppercase;">&nbsp;{{$who3->name}} =
                                    <!-- <?php echo $who4.'_';    echo $who22; ?>&nbsp;<span></a> -->
									<?php echo $who4.' PACK(S)'; ?>&nbsp;<span></a>
                            @endforeach
                            @endforeach
                        </center>
                        <br>
                        <table>
                            <tr style="background-color: #ebfcfc">
                                <th style="text-align:center">Sequence</th>
                                <th style="text-align:center">Operator</th>
                                <th style="text-align:center">Action</th>
                            </tr>
                            @foreach ($lists as $list)
                            <tr>
                                <td>{{$list->seq}}</td>
                                <td>
                                    <center>
                                        <form action="/moreoperator" method="post">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <select class="ui dropdown" name='asgnto' style='text-transform: uppercase'>
                                                <?php $user = DB::table('users')->get(['StaffID','name'])->where('StaffID','=', $list->asgnto); ?>
                                                @foreach ($user as $user)
                                                <option value="{{$user->StaffID}}">{{$user->StaffID}} - {{$user->name}}</option>
                                                @endforeach
                                                @foreach ($lists3 as $list3)
                                                <option value="{{$list3->StaffID}}">{{$list3->StaffID}} - {{$list3->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="qrcode" value="{{$list->qrcode}}" hidden />
											  <input type="text" name="seq" value="{{$list->seq}}" hidden />
											  <input type="text" name="sonum" value="{{$list->sonum}}" hidden />
											<input type="text" name="stockcode" value="{{$list->stockcode}}" hidden />
                                    </center>
                                </td>
                                <td style="text-align:center">
                                    <input class="btn btn-info" style="width:120px" type='submit' value="Save" />
                                    </form><br>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                        <br>
                        <div class="clearfix">
                            {{$lists->appends(request()->input())->links('pagination::bootstrap-4')}}
                        </div>
					@endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br> <br> <br> <br>
</body>
</html>