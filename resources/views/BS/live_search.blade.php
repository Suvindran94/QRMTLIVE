<!DOCTYPE html>
<html>
<head>
    <title>QR Monitoring and Tracking System</title>
	<script src="{{asset('js/jquery2.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap2.min.css')}}">
	<script src="{{asset('js/bootstrap2.min.js')}}"></script>
    <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<style>
    body {
    background-image: url('/img/back.jpg');
    background-position: center center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-color: #464646;
    }
    .select2-selection__rendered {
        line-height: 50px !important;
        
    }

    span.select2-container {
        z-index: 1;
    }

    .select2-container .select2-selection--single {
        height: 50px !important;
        font-size:15px !important;
    }

    .select2-selection__arrow {
        height: 50px !important;
    }
    </style>

    <br/> <br/> <br/>

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

    <br/> <br/> <br/>

<form method='post' action='/print2'>
        {{csrf_field()}}
    <div class="container" style="text-align:center;">
        <label class="form-label" style="font-weight:bold;font-size:40px">SO NUMBER</label>
        <br>
        <select class="form-select form-select-lg"  name="sonum" id="sonum" required>
            <option value="" disabled selected>Select SO Number</option>
            @foreach ($so as $sonum)
            <option value="{{$sonum->sonum}}">{{$sonum->sonum}}</option>  
            @endforeach
        </select>
        
        <br><br><br><br><br>

        <label class="form-label" style="font-weight:bold;font-size:40px">STOCKCODE</label>
        <br>
        <select class="form-select form-select-lg" name="stockcode" id="stockcode" required>
            <option selected>Please Select SO Number</option>
            <option ></option>
        </select>

        <br><br><br><br>

        <button type="submit" name='reprint' value='std' class="btn btn-primary btn-lg">Reprint Standard Bag/Carton/Pallet Sticker</button>
        <button type="submit" name='reprint' value='smb' class="btn btn-success btn-lg">Reprint Small Bag Sticker</button> 
    </div>
</form>

</body>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</html>

<script>
    $(document).ready(function() {
        $('#sonum').select2({
        allowClear: true,
        width: '490px',
        
        });

        $('#stockcode').select2({
        allowClear: true,
        width: '490px',
        //height: '5000px',
        });

    });
</script>

<script>
    $('#sonum').on('change', function() {
        var so = jQuery("#sonum").val();
        $.ajax({
            type: "GET",
            url: "{{url('getstockcode')}}?sonum=" + so,
            success: function(res) {
                if (res) {
                    if (res.length != 0) {
                        $('#stockcode').empty('');
                        $("#stockcode").append();
                        $.each(res, function(key, value) {
                            $("#stockcode").append('<option value="' + value.stockcode +
                                '" name="' + value.stockcode + '" name2="' + value
                                .stockcode + '">' + value.stockcode + '</option>');
                        });
                    } else {
                        $('#stockcode').empty('');
                    }
                } else {
                    $('#stockcode').empty('');
                }
            }
        });
    });
    </script>