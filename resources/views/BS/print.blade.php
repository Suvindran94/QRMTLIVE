<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{!! asset('/img/ICONT.png') !!}" />
</head>
@if( auth()->check() )
@include ('Navigation.'.auth()->user()->dept)
@endif
<style>
* {
    box-sizing: border-box;
}

}

body {
    background-image: url('/img/back.jpg');
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-color: #464646;
}

/* Float four columns side by side */
.columns {
    float: left;
    width: 25%;
    padding: 0 10px;
}

/* Remove extra left and right margins, due to padding */
.rows {
    margin: 0 -5px;
}

/* Clear floats after the columns */
.rows:after {
    content: "";
    display: table;
    clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
    .columns {
        width: 100%;
        display: block;
        margin-bottom: 20px;
    }
}

/* Style the counter cards */
.cards {
    box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.4);
    padding: 16px;
    text-align: center;
    background-color: white;
    border-radius: 10px;
}

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

#content {
    width: 100%;
    padding: 20px;

    transition: all 0.3s;
    position: absolute;
    top: 0;
    right: 0;
}
</style>

<body>
    <br><br><br><br><br>
    <div class="container">
        <div class="rows">
            @foreach ($sticker as $stickers)
			
			<?php
   
            $checkcontrolpoint = DB::table('moresolist')
            ->where('stockcode','=', $stickers->stockcode)
            ->where('sonum','=',  $stickers->sonum)
			->where('scan_control','N')
            ->count();
			
			?>

            <div class="columns">
					@if($checkcontrolpoint > 0)
                <div class="cards">
					@else
					 <div class="cards" style="background-color:#d4d4d4;">
					@endif
                    <img style="margin-top: 10%" src="{{ asset('/img/code.jpg') }}" alt="">
                    <p>{{$stickers->stockcode}}</p>
                    <p>{{$stickers->sonum}}</p>
                    <form action="/dynamic_pdf" method="get">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type='text' name='sonum' value='{{$stickers->sonum}}' hidden />
                        <input type='text' name='stockcode' value='{{$stickers->stockcode}}' hidden />
						
						@if($checkcontrolpoint > 0)
                        <input type='submit' value="View" style="width:130px" class="btn btn-primary" />
						@else
						      <input type='button' value="View" style="width:130px" title="This action has been disabled! Please proceed with New QRMT Control Point" class="btn btn-primary" disabled/>
						@endif
                    </form>
                    <a>
                        <form action="dynamic_pdf/pdf/{{$stickers->stockcode}}" method="post">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type='text' name='dt_printseal'
                                value='<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>'
                                hidden />
                            @if( auth()->check() )
                            <input type='text' name='printseal_by' value="{{ auth()->user()->name }}" hidden>
                            @endif
                            <input type='text' name='sonum' value='{{$stickers->sonum}}' hidden />
                            <input type='text' name='stockcode' value='{{$stickers->stockcode}}' hidden />
                            <input type='text' name='status' value='hidden' hidden />
                            <input type='text' name='status2' value='ps' hidden />
                            <input type='text' name='asgnto' value='{{$stickers->asgnto}}' hidden />
                            <!--<input type='submit' value="Print" style="width:130px" class="btn btn-warning" />-->
                            <?php 
                            $sonum = substr( $stickers->sonum,5,5);
                            $stockcode = $stickers->stockcode;
  							$stk = str_replace(".", "", $sonum.''.$stockcode);
                            ?>
							
							@if($checkcontrolpoint > 0)
                            <input type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#<?php echo $stk ?>" value="Print " style="width:130px" />
							@else
							 <input type="button" class="btn btn-warning" title="This action has been disabled! Please proceed with New QRMT Control Point" value="Print " style="width:130px" disabled/>
							@endif
                        </form>
                    </a>
                </div>
                <br>
            </div>

            @endforeach
        </div>
        <br><br>

        <div class="rows">
            @foreach ($sticker2 as $stickers)

            <?php
   
            $checkpallet = DB::table('moresolist')
            ->where('stockcode','=', $stickers->stockcode)
            ->where('sonum','=',  $stickers->sonum)
            ->first();

            $checkcomplete = DB::table('qrmastersmb')
            ->where('asgnto', '=', auth()->user()->StaffID)
            ->where('dt_printseal', '=', NULL)
            ->where('stockcode','=', $stickers->stockcode)
            ->where('sonum','=',  $stickers->sonum)
            ->count();

            ?>

            @if($checkpallet->uom2 == 'PALLET' &&  $checkcomplete > 0)
            <div class="columns">
        
                <div class="cards" style='background:#F9B09F; border-color:#F5856C;border-style: solid;'>
                    <img style="margin-top: 10%" src="{{ asset('/img/code.jpg') }}" alt="">
                    <p>{{$stickers->stockcode}}</p>
                    <p>{{$stickers->sonum}}</p>
                    <form action="/dynamic_pdf" method="get">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <input type='text' name='sonum' value='{{$stickers->sonum}}' hidden />
                        <input type='text' name='stockcode' value='{{$stickers->stockcode}}' hidden />
                        <input type='submit' value="View" style="width:130px" class="btn btn-primary" />
                    </form>
                    <a>
                        <form action="dynamic_pdf/pdf/{{$stickers->stockcode}}" method="post">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type='text' name='dt_printseal'
                                value='<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>'
                                hidden />
                            @if( auth()->check() )
                            <input type='text' name='printseal_by' value="{{ auth()->user()->name }}" hidden>
                            @endif
                            <input type='text' name='sonum' value='{{$stickers->sonum}}' hidden />
                            <input type='text' name='stockcode' value='{{$stickers->stockcode}}' hidden />
                            <input type='text' name='status' value='hidden' hidden />
                            <!--<input type='text' name='status2' value='ps' hidden />-->
                            <input type='text' name='asgnto' value='{{$stickers->asgnto}}' hidden />
                            <!--<input type='submit' value="Print" style="width:130px" class="btn btn-warning" />-->
                            <?php 
                            $sonum = substr( $stickers->sonum,5,5);
                            $stockcode = $stickers->stockcode;
  							$stk = str_replace(".", "", $sonum.''.$stockcode);
                            ?>
                            <input type="button" class="btn btn-warning" data-toggle="modal"
                                data-target="#<?php echo $stk ?>-smb" value="Print Small Pallet Sticker" style="width:auto" />
                        </form>
                    </a>
                </div>
            </div>

            @endif


            @endforeach
        </div>
        <br><br>
    </div>
    @foreach ($sticker as $stickers)
    <?php
        $name = auth()->user()->StaffID;
								   $ttl = DB::table('moresolist')
									   ->where('stockcode','=', $stickers->stockcode)
									   ->where('sonum','=',  $stickers->sonum)
									   ->get();
             ?>
    @foreach ($ttl as $ttl)
    <form action="/dynamic_pdf/pdf" method="post" target="_blank">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <?php 
                            $sonum = substr( $stickers->sonum,5,5);
                            $stockcode = $stickers->stockcode;
     						$stk = str_replace(".", "", $sonum.''.$stockcode);
                            ?>

        <div class="modal fade" id="<?php echo $stk ?>" tabindex="-1" role="dialog"
            aria-labelledby="favoritesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php
                            $name = auth()->user()->StaffID;
                            $prints = DB::table('qrmaster')
                                ->where('stockcode','=', $stickers->stockcode)
                                ->where('asgnto','=',  $name)
                                ->where('sonum','=',  $stickers->sonum)->count();
                            $prints2 = DB::table('qrmaster')
                                ->where('stockcode','=', $stickers->stockcode)
                                ->where('asgnto','=',  $name)
                                ->where('sonum','=',  $stickers->sonum)
                                ->where('dt_printseal','!=',  NULL)
                                ->count();
                        ?>
                        <input type='text' name='status' value='hidden' hidden />
                        <h4 class="modal-title" id="favoritesModalLabel">Standard Bag Printed
                            <?php echo $prints2?>/<?php echo $prints?></h4>
                        <input type='text' name='dt_printseal'
                            value='<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>'
                            hidden />
                        @if( auth()->check() )
                        <input type='text' name='printseal_by' value="{{ auth()->user()->name }}" hidden>
                        @endif
                        <input type='text' name='status2' value='ps' hidden />
                        <input type='text' name='sonum' value='{{$stickers->sonum}}' hidden />
                        <input type='text' name='stockcode' value='{{$stickers->stockcode}}' hidden />
                        <input type='text' name='asgnto' value="<?php echo $name ?>" hidden />
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button><br>
                    </div>
                    <div class="modal-body">
                        <p>
                            <?php
                                $name = auth()->user()->StaffID;
                                $prints3 = DB::table('qrmaster')
                                ->where('stockcode','=', $stickers->stockcode)
                                ->where('asgnto','=',  $name)
                                ->where('sonum','=',  $stickers->sonum)
                                ->where('dt_printseal','!=',  NULL)
                                ->count();

                                $prints4 = DB::table('qrmaster')
                                ->where('stockcode','=', $stickers->stockcode)
                                ->where('asgnto','=',  $name)
                                ->where('sonum','=',  $stickers->sonum)->count();
                                $var = $prints3 + 1;
                            ?>

                            Sequence from
                            <input id='first' type="number" style="width:50px" name="quantity1"
                                value="<?php echo $var?>" min="1" readonly> to
                            <input id='second' type="number" style="width:50px" name="quantity2" min="<?php echo $var?>"
                                max="<?php echo $prints4?>" required>
                        </p>

                        <input type="text" style="width:50px" name="ttlpsmb" value="{{$ttl->ttlpsmb}}" hidden>

                        </p>
                        Total Sticker : <span id="total_expenses1"></span><br>
                        <?php  ?>

                        <p style="color:red">
                            <i>
                                <?php $totalsmb = DB::table('qrmastersmb')
                                ->where('stockcode','=', $stickers->stockcode)
                                ->where('asgnto','=',  $name)
                                ->where('sonum','=',  $stickers->sonum)
                                ->count(); 
                                ?>

                                <script>
                                $('input').keyup(function() { // run anytime the value changes
                                    var firstValue = Number($('#first').val()); // get value of field
                                    var secondValue = Number($('#second').val()); // convert it to a float
                                    $('#total_expenses1').html(({
                                        {
                                            $ttl - > ttlpsmb
                                        }
                                    }*((secondValue - firstValue) + 1)) + (
                                        secondValue - firstValue) + 1); // add them and output it
                                });
                                </script>
                                *Note : Has <?php echo $totalsmb; ?> small bag sticker.<br>
                                *Note : 1 standard bag has {{$ttl->ttlpsmb}} small bag.<br>
                                *Note : Not more than 100 sticker allow to print at the same time.<br>
                                Example: 1 to 100 &#10004;<br>
                                Example: 1 to 101 &#10008;
                            </i>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <span class="pull-right">
                            <input type='submit' value="Print" class="btn btn-primary" onclick="
								if(this.form.checkValidity()) {
								this.disabled=true;
								this.value='Printing...';
								this.form.submit();
								setTimeout(function() { window.location=window.location;},5000);
                                } else {
								alert(document.getElementById('example').validationMessage);}" />
                        </span>
    </form>
    @endforeach
    </div>
    </div>
    </div>
    </div> 
    @endforeach


    @foreach ($sticker2 as $stickers2)
    
    <?php
       $name = auth()->user()->StaffID;
        $ttl = DB::table('moresolist')
            ->where('stockcode','=', $stickers2->stockcode)
            ->where('uom2','=','PALLET')
            ->where('sonum','=',  $stickers2->sonum)
            ->get();
         
             ?>
    @foreach ($ttl as $ttl)
    <form action="/smb_pdf/pdf" method="post" target="_blank">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <?php 
            $sonum = substr( $stickers2->sonum,5,5);
            $stockcode = $stickers2->stockcode;
     		$stk = str_replace(".", "", $sonum.''.$stockcode);
        ?>

        <!-- Small Bag Model-->
        <div class="modal fade" id="<?php echo $stk ?>-smb" tabindex="-1" role="dialog"
            aria-labelledby="favoritesModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <?php
                        $name = auth()->user()->StaffID;

                        $prints = DB::table('qrmastersmb')
                            ->where('stockcode','=', $stickers2->stockcode)
                            ->where('asgnto','=',auth()->user()->StaffID)
                            ->where('sonum','=',  $stickers2->sonum)
                            ->count();
              
                        $prints2 = DB::table('qrmastersmb')
                            ->where('stockcode','=', $stickers2->stockcode)
                            ->where('asgnto','=',  auth()->user()->StaffID)
                            ->where('sonum','=',  $stickers2->sonum)
                            ->where('dt_printseal','!=',  NULL)
                            ->count();
                            ?>

                        <input type='text' name='status' value='hidden' hidden />
                        <h4 class="modal-title" id="favoritesModalLabel">Small Bag Printed 45
                            <?php echo $prints2?>/<?php echo $prints?></h4>
                        <input type='text' name='dt_printseal'
                            value='<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>'
                            hidden />
                         
                        @if( auth()->check() )
                        <input type='text' name='printseal_by' value="{{ auth()->user()->name }}" hidden>
                        @endif
                        
                        <input type='text' name='sonum' value='{{$stickers2->sonum}}' hidden />
                        <input type='text' name='stockcode' value='{{$stickers2->stockcode}}' hidden />
                        <input type='text' name='asgnto' value="<?php echo $name ?>" hidden />
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <br>
                    </div>

                    <div class="modal-body">
                        <p>
                            <?php
                            $name = auth()->user()->StaffID;
                            $prints3 = DB::table('qrmastersmb')
                            ->where('stockcode','=', $stickers2->stockcode)
                            ->where('asgnto','=',  $name)
                            ->where('sonum','=',  $stickers2->sonum)
                            ->where('dt_printseal','!=',  NULL)
                            ->count();

                            $prints4 = DB::table('qrmastersmb')
                            ->where('stockcode','=', $stickers2->stockcode)
                            ->where('asgnto','=',  $name)
                            ->where('sonum','=',  $stickers2->sonum)->count();
                            
                            $var = $prints3 + 1;

                            ?>
                            Sequence from
                            <input id='first1' type="number" style="width:50px" name="quantity1"  value="<?php echo $var?>" min="1" readonly> to
                            <input id='second1' type="number" style="width:50px" name="quantity2"  min="<?php echo $var?>" max="<?php echo $prints4?>" required>
                        </p>

                        <input type="text" style="width:50px" name="ttlpsmb" value="{{$ttl->ttlpsmb}}" hidden>

                        </p>
                        Total Sticker : <span id="total_expenses1"></span><br>
                        

                        <p style="color:red">
                            <i>
                                <?php $totalsmb = DB::table('qrmastersmb')
                                ->where('stockcode','=', $stickers2->stockcode)
                                ->where('asgnto','=',  $name)
                                ->where('sonum','=',  $stickers->sonum)
                                ->count(); 
                                ?>

                                <script>
                                $('input').keyup(function() { // run anytime the value changes
                                    var firstValue = Number($('#first1').val()); // get value of field
                                    var secondValue = Number($('#second1').val()); // convert it to a float
                                    $('#total_expenses1').html(({
                                        {
                                            $ttl - > ttlpsmb
                                        }
                                    }*((secondValue - firstValue) + 1)) + (
                                        secondValue - firstValue) + 1); // add them and output it
                                });
                                </script>
                                *Note : Has <?php echo $totalsmb; ?> small bag sticker.<br>
                                *Note : 1 standard bag has {{$ttl->ttlpsmb}} small bag.<br>
                                *Note : Not more than 100 sticker allow to print at the same time.<br>
                                Example: 1 to 100 &#10004;<br>
                                Example: 1 to 101 &#10008;
                            </i>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <span class="pull-right">
                            <input type='submit' value="Print" class="btn btn-primary" onclick="

                            var quantity1 = $('#first1').val();
                            var quantity2 = $('#second1').val();
                            var total = quantity2 - quantity1 + 1;

                            console.log(total);
                            if(total > 50){
                                alert('Maximum print only 50 sticker');
                                event.preventDefault();
                            }
							else if(this.form.checkValidity()) {
								this.disabled=true;
								this.value='Printing...';
								this.form.submit();
								setTimeout(function() { window.location=window.location;},5000);
                                } else {
								alert(document.getElementById('example').validationMessage);}" />
                        </span>
                    </form>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <!-- Small Bag Model-->
</body>

</html>