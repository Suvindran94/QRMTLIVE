<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
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

<body><br>
    <div id="QR-Code" class="container" style="width:100%">

        <div class="panel panel-primary">

            <div class="panel-heading" style="display: inline-block;width: 100%;">

                <div style="float:right;margin-top: 5px;margin-bottom: 5px;text-align: right;">
                    <?php	if (Auth::check())
                            $name = auth()->user()->dept;
                            $name2 = auth()->user()->role;
                            if($name === "4" && $name2 === "21"){
                                echo '<a href="/BShomesu" class="btn btn-success btn-lg" style="width:100px; margin-left:110px">Home</a>';
                            }elseif($name === "1"){
                            echo '<a href="/admin" class="btn btn-success btn-lg" style="width:100px; margin-left:110px">Home</a>';
                            }else{
                                echo '<a href=/BShome'.$name.' class="btn btn-success btn-lg" style="width:100px; margin-left:110px">Home</a>';
                            }
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
                        <table style="border-collapse: collapse;
  width: 100%;  border: 1px solid black;">
                            <tr style="border: 1px solid black;font-weight: bold;">
                                <td style="border: 1px solid black;text-align: center;">Sequence</td>
                                <td style="border: 1px solid black;text-align: center;">Sonum</td>
                                <!--<td style="border: 1px solid black;text-align: center;">Layer</td>-->
                                <td style="border: 1px solid black;text-align: center;">Stockcode</td>
                                <td style="border: 1px solid black;text-align: center;">Operator Scanned Date</td>
                                 <!--<td style="border: 1px solid black;text-align: center;">Status</td>-->
                            </tr>
                            <?php 
                   
                    $user = DB::table('qrmaster')->orderByRaw('LENGTH(stockcode)', 'ASC')->orderBy('stockcode', 'ASC')
                    ->orderByRaw('LENGTH(seq)', 'ASC')->orderBy('seq', 'ASC')->where('dt_opscancomplete','!=', NULL)
                    ->where('dt_spvscanrev','=', NULL)->where('trx_status','=', 'A')
						->where('location', '=', auth()->user()->location)
						->get(); 
							
                    ?>
                            @foreach ($user as $users)
	
								 <tr style="border: 1px solid black; ">
                                <td style="border: 1px solid black;text-align: center;">{{$users->seq}}</td>
                                <td style="border: 1px solid black;text-align: center;">{{$users->sonum}}</td>
                                <!--<td style="border: 1px solid black;text-align: center;">{{$users->layer}}</td>-->
                                <td style="border: 1px solid black;text-align: center;">{{$users->stockcode}}</td>
                                <td style="border: 1px solid black;text-align: center;">{{$users->dt_opscancomplete}}</td>
							
                                <?php
                    /*if ($users->dt_spvscanrev != NULL){
                        echo '<td style="border: 1px solid black;text-align: center;"><img style="width:20px; height: 20px" src=/img/checked.png></td>';
                    }else{
                        echo '<td style="border: 1px solid black;text-align: center;" ><img style="width:20px; height: 20px" src=/img/cancel.png></td>';
                    }
					*/
                    ?>
								
                            </tr>
                            @endforeach
                        </table>
                    </center>
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
                          
    
                            <form method='post' action='/save2'>
                                <!-- Message -->

                                <!-- Add/List records -->
                                <table align="center" style='border-collapse: collapse;'>
                                    <tr>
                                        <td colspan="4">{{ csrf_field() }}</td>
                                    </tr>
                                    <!-- Add -->
                                    <tr>
                                    <td>
                                            <select  name="pallet" style="height:26px" id="pallet" >
                                                <option value="Pallet 1" {{ old('pallet') == "Pallet 1" ? 'selected' : ''}}>Pallet 1</option>
                                                <option value="Pallet 2" {{ old('pallet') == "Pallet 2" ? 'selected' : ''}}>Pallet 2</option>
                                                <option value="Pallet 3">Pallet 3</option>
                                                <option value="Pallet 4">Pallet 4</option>
                                                <option value="Pallet 5">Pallet 5</option>
                                                <option value="Pallet 6">Pallet 6</option>
                                                <option value="Pallet 7">Pallet 7</option>
                                                <option value="Pallet 8">Pallet 8</option>
                                                <option value="Pallet 9">Pallet 9</option>
                                                <option value="Pallet 10">Pallet 10</option>
                                                <option value="Pallet 11">Pallet 11</option>
                                                <option value="Pallet 12">Pallet 12</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select  id="layer" name="layer" style="height:26px">
                                                <option value="Layer 1" >Layer 1</option>
                                                <option value="Layer 2">Layer 2</option>
                                                <option value="Layer 3">Layer 3</option>
                                                <option value="Layer 4">Layer 4</option>
                                                <option value="Layer 5">Layer 5</option>
                                                <option value="Layer 6">Layer 6</option>
                                            </select>
                                        </td>
                                        <td>
                                            <p id="scanned-QR" onchange="update" hidden></p>
                                            <input type="text" name="qrcode" value="" placeholder="QR Code"
                                                autofocus="autofocus" required>
                                            <script type="text/javascript">
                                            setInterval(update, 1);

                                            function update() {
                                                var code_id_value = document.getElementById("scanned-QR").innerHTML;
                                                document.getElementById("code_id_value").value = code_id_value;

                                            }
                                            update();
                                            </script>
                                        </td>
                                        @if( auth()->check() )
                                        <input type='text' name='spvscanrev_by' value="{{ auth()->user()->name }}"
                                            hidden>
                                        @endif
                                        <input type='text' name='status' value="sr" hidden>
                                        <input type='text' name='dt_spvscanrev'
                                            value="<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>"
                                            hidden>
                                    </tr>
                                    <tr>
                                    </tr>
                         
                                </table>
                                <center>
                                    <br><input class="btn btn-success btn-lg" type='submit' name='submit'
                                        value='Confirm' onclick="reload()">
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
<script>
                function reload() {
 localStorage.setItem('selectedVal',$('#mySelect').val());
  location.reload(true);
}

$( document ).ready(function() {
    var selectedVal = localStorage.getItem('selectedVal');
    if (selectedVal){
       $('#mySelect').val(selectedVal)
    }
   
});
</script>
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