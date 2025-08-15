<!DOCTYPE html>
<html>

<head>
<title>QR Monitoring and Tracking System</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>
</head>
<style>
 body{
    background-image: url('/img/back.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    }
</style>
<body>
<div class="w3-display-middle">
    <div class="w3-panel w3-card" style="background-color:white">
    <header class="w3-panel w3-blue">
      <h1>Choose Operator</h1>
    </header>
        <form action="/editoperator/<?php echo $list2[0]->id; ?>" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <center>
            <table>
                <tr>
                    <td>Operator</td>
                    <td>
                        <select class="ui dropdown" name='name'>
                            @foreach ($list2 as $list)
                            <option value="{{$list->name}}">{{$list->name}}</option>
                            @endforeach
                            @foreach ($lists3 as $list3)
                            <option value="{{$list3->name}}">{{$list3->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input  style="margin-left:50px" type='submit' value="Save" />
                    </td>
                </tr>
            </table>
            <br>
            </center>
        </form>
    </div>
 </div>
</body>
</html>