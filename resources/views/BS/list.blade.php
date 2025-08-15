<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Monitoring and Tracking System</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <link rel="icon" href="{!! asset('/img/ICONT.png') !!}"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    @if( auth()->check() )
    @include ('Navigation.'.auth()->user()->dept)
    @endif
    <style type="text/css">
    body {

        background-image: url('/img/back.jpg');
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
        background-color: #464646;
    }

    .table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
        border-radius: 23px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #435d7d;
        color: #fff;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;

    }

    .table-title .btn-group {
        float: right;
        border-radius: 52px;
    }

    .table-title .btn {
        color: #fff;
        float: right;
        font-size: 13px;
        border: none;
        min-width: 50px;

        border: none;
        outline: none !important;
        margin-left: 10px;
        border-radius: 52px;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 100px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {

        margin: 0 5px;
        cursor: pointer;
    }

    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
        outline: none !important;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.edit {
        color: #FFC107;
    }

    table.table td a.delete {
        color: #F44336;
    }

    table.table td i {
        font-size: 19px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a,
    .pagination li.active a.page-link {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    /* Custom checkbox */
    .custom-checkbox {
        position: relative;
    }

    .custom-checkbox input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        margin: 5px 0 0 3px;
        z-index: 9;
    }

    .custom-checkbox label:before {
        width: 18px;
        height: 18px;
    }

    .custom-checkbox label:before {
        content: '';
        margin-right: 10px;
        display: inline-block;
        vertical-align: text-top;
        background: white;
        border: 1px solid #bbb;
        border-radius: 2px;
        box-sizing: border-box;
        z-index: 2;
    }

    .custom-checkbox input[type="checkbox"]:checked+label:after {
        content: '';
        position: absolute;
        left: 6px;
        top: 3px;
        width: 6px;
        height: 11px;
        border: solid #000;
        border-width: 0 3px 3px 0;
        transform: inherit;
        z-index: 3;
        transform: rotateZ(45deg);
    }

    .custom-checkbox input[type="checkbox"]:checked+label:before {
        border-color: #03A9F4;
        background: #03A9F4;
    }

    .custom-checkbox input[type="checkbox"]:checked+label:after {
        border-color: #fff;
    }

    .custom-checkbox input[type="checkbox"]:disabled+label:before {
        color: #b8b8b8;
        cursor: auto;
        box-shadow: none;
        background: #ddd;
    }

    /* Modal styles */

    .modal .modal-dialog {
        max-width: 900px;
    }

    .modal .modal-header,
    .modal .modal-body,
    .modal .modal-footer {
        padding: 20px 30px;
    }

    .modal .modal-content {
        border-radius: 3px;
    }

    .modal .modal-footer {
        background: #ecf0f1;
        border-radius: 0 0 3px 3px;
    }

    .modal .modal-title {
        display: inline-block;
    }

    .modal .form-control {
        border-radius: 2px;
        box-shadow: none;
        border-color: #dddddd;
    }

    .modal textarea.form-control {
        resize: vertical;
    }

    .modal .btn {
        border-radius: 52px;
        min-width: 100px;
    }

    .modal form label {
        font-weight: normal;
    }

    div.card {
        width: 100%;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        text-align: center;
        border-radius: 20px;
    }



    div.container {
        padding: 10px;
    }

    ul.timeline {
        list-style-type: none;
        position: relative;
    }

    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }

    ul.timeline>li {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li2 {
        margin: 20px 0;
        padding-left: 20px;
    }

    ul.timeline>li:before {
        content: ' ';
        background: #22c0e8;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

    ul.timeline>li2:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }

    #myInput {
        background-image: url('img/search2.png');
        background-position: 0px 1px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 13px;
        padding: 5px 16px 5px 36px;
        border: 1px solid #ddd;
        margin-top: 5px;
        border-radius: 20px;
    }

    .search-container button {
        float: none;
        text-align: left;
        margin-top: 5px;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function() {
            if (this.checked) {
                checkbox.each(function() {
                    this.checked = true;
                });
            } else {
                checkbox.each(function() {
                    this.checked = false;
                });
            }
        });
        checkbox.click(function() {
            if (!this.checked) {
                $("#selectAll").prop("checked", false);
            }
        });
    });
    </script>
</head>

<body>
    <br> <br> <br> <br> <br> <br><br>
    <center>
        <a style="font-size:28px; text-align:center; color: white">SALES ORDER LIST</a>
    </center>
    <div class="container" style="	border-radius: 12px; ">
        <div class="table-wrapper"
            style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="table-title"
                style="	border-radius: 12px; background-color:white; color: black; text-align:center">
                <div class="row" style="	border-radius: 12px;">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
            <div class="container">
                <form method="get" action="">
                    <div class="input-group stylish-input-group">
                        <input type="text" id="txtSearch" name="txtSearch" class="form-control"
                            placeholder="Search SO Number...">&nbsp;
                        <span class="input-group-addon">
                            <button class="btn btn-success" style="width:130px" type="submit">
                                <span class="glyphicon glyphicon-search">Search</span>
                            </button>
                        </span>
                    </div>
                </form>
                <div id="result"></div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Barcode</th>
                        <th>SO Number</th>
                        <th>Ref No</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lists as $list)
                    <tr>
                        <td>
                            <?php
                        $png = QrCode::format('png')->size(110)->generate($list->sonum);
                        $png = base64_encode($png);
                        echo "<img src='data:image/png;base64," . $png . "'>";
                        ?>
                        </td>
                        <td>{{ $list->sonum }}</td>
                        <td>{{ $list->refnum }}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped active" role="progressbar"
                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php 
                                       $prints = DB::table('moresolist')
                                       ->where('sonum', '=',  $list->sonum)
                                       ->count();
                                       $prints2 = DB::table('moresolist')
                                       ->where('sonum', '=',  $list->sonum)
                                       ->whereNotNull('asgnto')
                                       ->where('asgnto', '!=',  '')->count();
                                    $var = ( $prints2/$prints );
                                    $var2 = $var * 100;
                                    echo $var3 = (int)$var2.'%';?>">

                                    <?php 
                                       $prints = DB::table('moresolist')
                                       ->where('sonum', '=',  $list->sonum)
                                       ->count();
                                       $prints2 = DB::table('moresolist')
                                       ->where('sonum', '=',  $list->sonum)
                                       ->whereNotNull('asgnto')
                                       ->where('asgnto', '!=',  '')->count();
                                    $var = ( $prints2/$prints );
                                    $var2 = $var * 100;
                                    echo $var3 = (int)$var2.'%';?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a style="text-align:center" href='show/{{$list->sonum}}'>
                                <button class="btn btn-info" style="width:130px">
                                    View / Assign
                                </button>
                            </a>
                            <br>
                            <a style="text-align:center" href='track/{{$list->sonum}}'>
                                <button class="btn btn-danger" style="width:130px">
                                    Tracking
                                </button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                {{$lists->appends(request()->input())->links('pagination::bootstrap-4')}}
            </div>
        </div>
    </div>

    <br>
</body>

</html>