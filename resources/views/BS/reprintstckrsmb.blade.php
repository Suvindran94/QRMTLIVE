<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>QR Monitoring and Tracking System</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- jQuery Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
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
                           @if ($message = Session::get('message'))
        <div class="alert alert-success" id="success-alert">
            {{ session()->get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
        </div>
        @endif
                    <br>
                    <center>
                    <form action="/reprintrangesmb" method="get">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    @foreach ($prints2 as $print2)
                    @foreach ($prints as $print1)
                    <input type="text" name="stockcode" value="{{$print1->stockcode}}" hidden />
                    <input type="text" name="sonum" value="{{$print2->sonum}}" hidden />
                    @endforeach
                    @endforeach
                    Reprint From Sequence
                    <input required id="first" type="number" style="width:50px" name="quantity1" id="num" value="" min="1" required>&nbsp;to
                    <input required id="second" type="number" style="width:50px" name="quantity2" required> 
                    <input class="btn btn-info" style="width:120px" type='submit' value="Print" />
                </form>
                <script>
                                    function setMin() {
                                        var first = document.getElementById("first");
                                        var second = document.getElementById("second");
                                        second.min = first.value;
                                    }

                                    var trigger = document.getElementById("first");
                                    trigger.addEventListener("change", setMin, false);
                                    </script>
                </center>
                    <form action="/reprint" method="post">
                    <div class="card-body">
                        <table>
                            <tr style="background-color: #ebfcfc">
                            <th style="text-align:center">Sequence</th>
                                <th style="text-align:center">SO Number</th>
                                <th style="text-align:center">Stockcode</th>
                                <th style="text-align:center">Particular</th>
                                <th style="text-align:center">Operator</th>
                            </tr>
                            @foreach ($prints2 as $print2)
                            @foreach ($prints as $print1)
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <tr>
                                <td>
                                        {{$print1->number}}
                                    </td>
                                    <td> 
                                    {{$print2->sonum}}
                                        <input type="text" name="stockcode" value="{{$print1->stockcode}}" hidden />
                                        <input type="text" name="sonum" value="{{$print2->sonum}}" hidden />
                                    </td>
                                    <td>
                                        {{$print1->stockcode}}
                                    </td>
                                    <td>
                                        {{$print2->particular}}
                                    </td>
                                    <td>
                                        <?php $user = DB::table('users')
                                        ->get(['StaffID','name'])
                                        ->where('StaffID','=', $print1->asgnto); 
                                        ?>

                                       @foreach ($user as $user)
                                        {{$user->name}}
                                        @endforeach
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                            @endforeach
                        </table><br>
                        <div class="clearfix" >
                            {{$prints->appends(request()->input())->links('pagination::bootstrap-4')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br> <br> <br> <br>
</body>

</html>