<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QRMT - Operator Update Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js" defer></script>
    <link rel="stylesheet" href="{{ asset('css/controlpoint.css?v=1.2') }}" />
</head>
<body>
    @csrf
    <input type="hidden" name="CURRENTSTEP" id="CURRENTSTEP">
    <input type="hidden" name="EXCEPTION" id="EXCEPTION">
    <input type="hidden" name="EXCEPTION_STATUS" id="EXCEPTION_STATUS">
    <input type="hidden" name="PRD_STATUS" id="PRD_STATUS">
    <input type="hidden" name="id" id="id" value="{{ $id }}">
    <div class="container-fluid">
        <div class="row topdiv">
            <div class="col-md-6">
                <div class="grey-bg" id="user-container"></div>
            </div>
            <div class="col-md-6">
                <div class="grey-bg">
                    <div class="time">
                        <span class="h"></span>
                        <span class="point" id="point">:</span>
                        <span class="m"></span>
                        <span class="point" id="point">:</span>
                        <span class="s"></span>
                        <span class="ampm"></span></br>
                        <span class="date"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <table class="table tableinfo table-bordered">
                        <tbody>
                            <tr><th class="table-success" style="width:20%;">Device:</th><td class="table-info" id="DEVICE" style="width:30%;">-</td><th class="table-success" style="width:20%;">Mould:</th><td class="table-info" id="MOULD" style="width:30%;">-</td></tr>
                            <tr><th class="table-success" style="width:20%;">Cavity:</th><td class="table-info" id="CAVITY">-</td><th class="table-success" style="width:20%;">Cycle Time:</th><td class="table-info" id="CYCLE_TIME">-</td></tr>
							
<tr>
<th class="table-success">Zone:</th><td class="table-info" id="ZONE">-</td>
<th class="table-success">NOS PSBAG:</th><td class="table-info" id="NOS_PER_STD_BAG">-</td>
</tr>
							
							
							
                            <tr><th class="table-success">WO NO:</th><td class="table-info" id="WO">-</td><th class="table-success">SO NO:</th><td class="table-info" id="SO">-</td></tr>
							
                            <tr><th class="table-success">Stockcode:</th><td class="table-info" id="STK">-</td><td class="table-info" id="SHORT_NAME" colspan="2">-</td></tr>
                            <tr><th class="table-success">Current VS WO Qty:</th><td class="table-info" id="WOQTY">-</td><th class="table-success">Packing Method:</th><td class="table-info" id="PMETHOD">-</td></tr>
                            <tr><th class="table-success">Current STD Bag:</th><td class="table-info" id="CSTDB">-</td><th class="table-success">Standard Bag:</th><td class="table-info" id="STD_PACK">-</td></tr>
                            <tr><th class="table-success">Current Small Bag:</th><td class="table-info" id="CSB">-</td><th class="table-success">Small Bag:</th><td class="table-info" id="SMALL_PACK">-</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-7">
                    <ol id="progress-bar">
                        <li class="step-todo" id="step1">Print STD Bag Sticker</li>
                        <li class="step-todo" id="step2">Weight Scale Small Bag</li>
                        <li class="step-todo" id="step3">Seal & Print Small Bag</li>
                        <li class="step-todo" id="step4">Scan Small Bag</li>
                        <li class="step-todo" id="step5">Seal STD Bag</li>
                        <li class="step-todo" id="step6">Scan STD Bag</li>
                    </ol>
                </div>
            </div>
            <hr>
            <div id="output"></div>
        </div>
        <br>

    </div>
    <div id="overlay">
            <div class="cv-spinner">
                <span class="spinner"></span>
            </div>
        </div>
    <footer class="footer">
        <p>© 2024 PLW QRMT Control Point v1.</p>
    </footer>
    @include('QRMT-OPRUPD.Modal.balance')
    @include('QRMT-OPRUPD.Modal.checkin')
    <script src="{{ asset('js/controlpoint.js?v=1.13') }}" defer></script>
</body>
</html>