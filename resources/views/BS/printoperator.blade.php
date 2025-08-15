@foreach ($prints as $print)
<form action="/edit1/<?php echo $print->stockcode; ?>" method="post">
@endforeach
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
    <table>
        <tr>
            <td><input type='text' name='dt_printseal' value='<?php date_default_timezone_set("Asia/Kuala_Lumpur"); echo date('Y-m-d\TH:i'); ?>' hidden /></td>
            @if( auth()->check() )
            <td><input type='text' name='printseal_by' value="{{ auth()->user()->name }}" hidden></td>
            @endif
            <td><input type='text' name='status' value='hidden' hidden /> </td>
            <td><input type='text' name='status2' value='ps' hidden /> </td>
            @foreach ($prints as $print)
            <input type='text' name='asgnto' value='{{$print->asgnto}}' hidden /> 
            @endforeach
            <td><input type='submit' value="Print" onClick="myFunction()" /></td>
        </tr>
    </table>
</form>
<script>
function myFunction() {
    window.print();
}
</script>
<style>
    body {
        background-image: url('/img/back.jpg');
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-color: #464646;
    }
    @page { size:6.5cm 10cm landscape; }
    #divResize,
    #divResize1,
    #divResize2,
    #divResize3,
    #divResize4,
    #divResize5,
    #divResize6 {
        width: 120px;
        height: 120px;
        padding: 5px;
        margin: 5px;
        font: 13px Arial;
        cursor: move;
        background-color: white;
    }

    .card1 {}

    .card1:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.8);
    }

    table {
        font-family: arial, sans-serif;

    }

    a {
        text-transform: uppercase;
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
    </style>


    <center>
        <div id="html-content-holder">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                @foreach ($prints as $print)
                @foreach ($prints2 as $print2)
                <?php
                echo '<div class="card" style=" height: 6.5cm; width: 9.0cm">';
                echo '<div class="card-body" style="background-color: white">';
                echo '<table >';
                echo '<tr>';
                echo '<td width="50%"; >';
                echo '<span style="color:white; background-color: black; font-size:10px; margin-left:15px" ><b>'.substr($print->stockcode, 2,3).'</b></span>';
                echo '<p style="font-size:7px; margin-left:30px"><b>'.$print->stockcode.'</b></p>';
                echo '</td>';
                echo'<th width="5%"><img style="height: 70px; width:100px" src="/img/barcodetemplate/item.png" /></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="font-size:10px;color:black";><b>'.$print2->particular.'</b></td>';
                echo '<td rowspan="6">';
                echo '<a style="margin-left:110px"><b>'.$print->seq.'</b></a>';
                echo'<table>';
                echo'<tr>';
                echo'<td width="10%">';
                echo '<img style="height:40px;width:40px" src="/img/barcodetemplate/mly.png" />';
                echo'</td>';
                echo'<td width="10%">';
                $png = QrCode::format('png')->size(100)->generate($print->qrcode);
                $png = base64_encode($png);
                echo "<input type='image' name='qrcode' src='data:image/png;base64," . $png . "' hidden>";
                echo Form::hidden('_token',csrf_token());
                echo Form::close();
                echo "<img src='data:image/png;base64," . $png . "'>";
                echo '</td>';
                echo'</tr>';
                echo'</table>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo ' <td style="color:black">';
                echo '<a style="font-size:10px">S/O : '.$print->sonum.'</a>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="color:black">';
                echo '<a style="font-size:10px"> S/M : H2F</a>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="color:black">';
                echo '<a style="font-size:10px"><b>QTY :<b> '.$print2->pbag.' NOS</b></a>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="color:black">';
                echo '<a style="font-size:10px"> Q.C BY : '.$print->asgnto.'</a>';
                echo ' </td>';
                echo '</tr>';
                echo '<tr>';
                echo ' <td style="color:black;">';
                echo '<a style="font-size:10px">DATE : </a>';
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '<br>';
                ?>
                @endforeach
                @endforeach
                    </div>
                </div>
            </div>
        </div>
    </center>
    </div>
    
    <style>
    .button {
        background-color: #4CAF50;
        /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        -webkit-transition-duration: 0.4s;
        /* Safari */
        transition-duration: 0.4s;
        align: center;
    }

    body {
        margin: 0;
        font-family: "Arial";
    }

    .tab-wrapper {
        text-align: center;
        display: block;
        margin: auto;
        max-width: 500px;
    }

    .tabs {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
    }

    .tab-link {
        margin: 0 1%;
        list-style: none;
        padding: 10px 40px;
        color: #aaa;
        cursor: pointer;
        font-weight: 700;
        transition: all ease 0.5s;
        border-bottom: solid 3px rgba(255, 255, 255, 0);
        letter-spacing: 1px;
    }

    .tab-link:hover {
        color: #999;
        border-color: #999;
    }

    .tab-link.active {
        color: #333;
        border-color: #333;
    }

    .tab-link:nth-of-type(1).active {
        color: #EE6534;
        border-color: #EE6534;
    }

    .tab-link:nth-of-type(2).active {
        color: #1790D2;
        border-color: #1790D2;
    }

    .tab-link:nth-of-type(3).active {
        color: #EEC63B;
        border-color: #EEC63B;
    }

    .content-wrapper {
        padding: 40px 80px;
    }

    .tab-content {
        display: none;
        text-align: center;
        color: #888;
        font-weight: 300;
        font-size: 15px;
        opacity: 0;
        transform: translateY(15px);
        animation: fadeIn 0.5s ease 1 forwards;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        100% {
            opacity: 1;
            transform: none;
        }
    }
    </style>
    <script>
   