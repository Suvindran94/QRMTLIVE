<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title></title>
</head>

<style>
.select2-selection__rendered {
    line-height: 30px !important;

}


.select2-container .select2-selection--single {
    height: 30px !important;


}

.select2-selection__arrow {
    height: 30px !important;


}

.card {
    box-shadow: 0 8px 10px 0 rgba(0, 0, 0, 0.2);
    border-radius: 10px;
}
</style>


<body>
	
	@if (session()->has('message'))
							<div class="alert alert-dismissable alert-success">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>

								{!! session()->get('message') !!}

							</div>
							@endif
	
    <form method='post' action='/norepack'>
        {{csrf_field()}}
        <div class="card" style="width:90%;margin-left:auto;margin-right:auto;margin-top:20px;height:200%">
            <h5 class="card-header" style="background:#0099ff;color:white">Create Information List</h5>
            <div class="row">
                <input type="text" id="so2" name="so2" hidden>
                <input type="text" id="stockcode2" name="stockcode2" hidden>

                <div class="col-sm-6" style="text-align:center;margin-top:10px;">
                    <h4>Sales Order</h4>
                </div>
                <div class="col-sm-6" style="text-align:center;margin-top:10px;">
                    <h4>Stock Code</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" style="padding-left:90px;">
                    <select class="so form-group" id="so" name="so[]" style="width:500px;" multiple="multiple" required>
                        @foreach ($so as $so)
                        <option value='{{$so->sonum}}'>
                            {{$so->sonum}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6" style="padding-left:90px; padding-right:80px;">
                    <select class="form-group stockcode" id="stockcode" name="stockcode[]"
                        style="width:100%;text-align:center;margin-left:15%;margin-right:25%;" multiple="multiple"
                        required>
                    </select>
                </div>
            </div>
            <br>
            <div style="margin-bottom:10px">
                <input class="btn btn-success " type='submit' name='submit' value='Confirm' onclick="reload()"
                    style="margin-left:45%">
                <a href="/BShome3" class="btn btn-danger" style="margin-left:20px">Back</a>
            </div>
        </div>
    </form>

    <script>
    $(document).ready(function() {

        $("#so").select2({
            placeholder: "Select Sales Order",

        });

        $("#stockcode").select2({
            placeholder: "Select Stock Code",

        });




    });
    </script>

    <script>
    $('#so').on('change', function() {

        var so = jQuery("#so").val();

        $('#so2').val(so);

        $.ajax({
            type: "GET",
            url: "{{url('getstockcode')}}?sonum=" + so,
            success: function(res) {
                if (res) {
                    if (res.length != 0) {
                        $('#stockcode').empty('');
                        $("#stockcode").append(



                        );
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
    $('#stockcode').on('change', function() {
        var stk = jQuery("#stockcode").val();

        $('#stockcode2').val(stk);

    });
    </script>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</body>

</html>