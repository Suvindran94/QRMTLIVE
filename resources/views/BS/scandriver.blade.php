<!DOCTYPE html>
<html>

<head>
<title>QR Monitoring and Tracking System</title>
     <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style100.css">

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
    <div class="page-header">
        <center>
            <h1>QR Code Scanner</h1>
        </center>
    </div>
    <div id="QR-Code" class="container" style="width:100%">
        <div class="panel panel-primary">
            <div class="panel-heading" style="display: inline-block;width: 100%;">

                <div style="width:50%;float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                    <select id="cameraId" class="form-control" style="display: inline-block;width: auto;"></select>
                    <a href="/logout" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
                    <button id="play" data-toggle="tooltip" title="Play" type="button"
                        class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play"></span></button>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6" style="text-align: center;">
                    <div class="well" style="position: relative;display: inline-block;">
                        <canvas id="qr-canvas" width="320" height="240"></canvas>
                        <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                        <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                    </div>
                </div>
                <div class="col-md-6" style="text-align: center;">
                    <div id="result" class="thumbnail">
                        <div class="well" style="position: relative;display: inline-block;">
                            <img id="scanned-img" src="" width="320" height="240">
                        </div>
                        <div class="caption">
                            <h3>Scanned result</h3>
                            <h1 type="text" name="qrcode" id="scanned-QR" autofocus="autofocus"></h1>
                            <form method='post' action='/save3'>
                                <!-- Message -->
                                @if(Session::has('message'))
                                <p>{{ Session::get('message') }}</p>
                                @endif
                                <!-- Add/List records -->
                                <table align="center" style='border-collapse: collapse;'>
                                    <tr>
                                        <td colspan="4">{{ csrf_field() }}</td>
                                    </tr>
                                    <!-- Add -->
                                    <tr>
                                        <td><br><input type='text' name='sonum' placeholder="SO Number" required></td>
                                    </tr>
                                    <tr>
                                        <td><br><input type='text' name='drivername' placeholder="Name" required></td>
                                    </tr>
                                    <tr>
                                        <td><br><input type='text' name='driveric' placeholder="IC No" required></td>
                                        <td><br><input type='text' name='driverstatus' value="display" hidden></td>
                                        <td><br><input type='text' name='datetimedriver'
                                                value="<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>"
                                                hidden></td>
                                    </tr>
                                    <tr>
                                        <td><br><input type='text' name='lorryplate' placeholder="Plate No" required></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <br>
                                            <section class="signature-component">
                                                <canvas id="signature-pad" width="300" height="200"></canvas>
                                            </section>
                                            <!-- partial -->
                                            <script
                                                src='https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js'>
                                            </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><br>
                                            <input class="btn btn-success btn-lg" type='submit' value='Save' id="save"
                                                hidden>
                                            <input class="btn btn-success btn-lg" type='submit' name='submit'
                                                value='Comfirm'>
                                        </td>
                                    </tr>
                                </table>
                            </form> <br><button class="btn btn-warning btn-lg" id="clear" value="Clear">Clear</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="js/qrcodelib.js"></script>
<script type="text/javascript" src="js/WebCodeCam.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/scan.js"></script>


</html>