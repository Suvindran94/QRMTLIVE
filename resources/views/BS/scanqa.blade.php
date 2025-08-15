<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>
       <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style type="text/css">
    .scanner-laser {
        position: absolute;
        margin: 40px;
        height: 30px;
        width: 30px;
    }

    .laser-leftTop {
        top: 0;
        left: 0;
        border-top: solid red 5px;
        border-left: solid red 5px;
    }

    .laser-leftBottom {
        bottom: 0;
        left: 0;
        border-bottom: solid red 5px;
        border-left: solid red 5px;
    }

    .laser-rightTop {
        top: 0;
        right: 0;
        border-top: solid red 5px;
        border-right: solid red 5px;
    }

    .laser-rightBottom {
        bottom: 0;
        right: 0;
        border-bottom: solid red 5px;
        border-right: solid red 5px;
    }
    </style>
</head>

<body>

    <div id="QR-Code" class="container" style="width:100%">
        <div class="panel panel-primary">

            <div class="panel-heading" style="display: inline-block;width: 100%;">

                <div style="float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                    <?php
                    if (Auth::check())
                    $name = auth()->user()->dept;
                    
                
echo '<a href=/BShome'.$name.' class="btn btn-success btn-lg" style="width:100px; margin-left:110px">Home</a>';
?>
                    <script type="text/javascript">
                    document.getElementById("play").click();
                    </script>
                    <button id="play" data-toggle="tooltip" title="Play" type="button"
                        class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play"></span></button>

                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6" style="text-align: center;">
                    <center>
                        <legend>DATA</legend>
                        @if (session()->has('message'))
                            <div class="alert alert-dismissable alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                {!! session()->get('message') !!}

                            </div>
                            @endif
                            @if (session()->has('message2'))
                            <div class="alert alert-dismissable alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                {!! session()->get('message2') !!}

                            </div>
                            @endif
                            @if (session()->has('message3'))
                            <div class="alert alert-dismissable alert-warning">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                                {!! session()->get('message3') !!}

                            </div>
                            @endif
                    </center>
                    <center>
                        <table style="border-collapse: collapse; width: 100%;  border: 1px solid black;">
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;text-align: center;">Sequence</td>
                                <td style="border: 1px solid black;text-align: center;">Sonum</td>
                                <td style="border: 1px solid black;text-align: center;">Stockcode</td>
                                <td style="border: 1px solid black;text-align: center;">Date</td>
                                <td style="border: 1px solid black;text-align: center;">Status</td>
                            </tr>
                            @foreach ($data as $data)
                            <tr style="border: 1px solid black;">
                                <td style="border: 1px solid black;text-align: center;">{{$data->seq}}</td>
                                <td style="border: 1px solid black;text-align: center;">{{$data->sonum}}</td>
                                <td style="border: 1px solid black;text-align: center;">{{$data->stockcode}}</td>
                                <td style="border: 1px solid black;text-align: center;">{{$data->dt_printseal}}</td>
                                <?php
                    if ($data->dt_qacheck != NULL){
                        echo '<td style="border: 1px solid black;text-align: center;"><img style="width:20px; height: 20px" src=/img/checked.png></td>';
                    }else{
                        echo '<td style="border: 1px solid black;text-align: center;" ><img style="width:20px; height: 20px" src=/img/cancel.png></td>';
                    }
                    ?>
                            </tr>
                            @endforeach
                        </table>
                    </center>

                    <br>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <canvas id="qr-canvas" width="320" height="240"></canvas>
                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                        </div>
                        <div class="caption">
                            <h3>Scanned result</h3>
                            <form action="{{route('save3')}}" method='POST' >
                             
<input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                                <!-- Message -->
                                <table align="center" style='border-collapse: collapse;'>
                                   
                                    <tr>
                                         <td>
                                            <p id="scanned-QR" onchange="update" hidden></p>
                                            <input type="text" name="qrcode" value="" placeholder="QR Code"
                                                autofocus="autofocus" onblur="this.focus()" required>
                                            <script type="text/javascript">
                                            setInterval(update, 1);
                                            function update() {
                                                var code_id_value = document.getElementById("scanned-QR").innerHTML;
                                                document.getElementById("code_id_value").value = code_id_value;
                                                var res = code_id_value.substr(17, 9);
                                                document.getElementById("res").value = res;
                                            }
                                            update();
                                            </script>
                                        </td>
                                        <input type='text' name='status' value="qa" hidden>
                                        @if( auth()->check() )
                                        <input type='text' name='qacheck_by' value="{{ auth()->user()->name }}" hidden>
                                        @endif
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       
                                        <td ><br><input class="btn btn-success btn-lg" type='submit' name='submit'
                                                value='Confirm' hidden></td>
                                        <td><br><input type='text' name='dt_qacheck'
                                                value="<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>"
                                                hidden></td>
                                   
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/qrcodelib.js"></script>
<script type="text/javascript" src="js/WebCodeCam.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</html>