<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>QR Monitoring and Tracking System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{!! asset('/img/ICONT.png') !!}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker3.standalone.min.css') }}">
</head>

@if (auth()->check())
    @include ('Navigation.' . auth()->user()->dept)
@endif

<link rel="stylesheet" href="{{ asset('css/style_dailytimesheet.css') }}">

<body>
    <br><br><br><br><br><br><br><br><br>
    <center>
        <a style="font-size:28px; text-align:center; color: white">DAILY TIMESHEET</a>
    </center>
    <br>
    <div class="container"
        style="padding: 30px; border-radius: 12px; background-color:white;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); min-width: 95%;">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="row">
            @if ($countRemaining === 0)
                <div class="col-md-6">
                    <div class="pd-20">
                        <b>All Operators have adjust the timesheet</b>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="pd-20">
                        <b>{{ $countRemaining }} out of {{ $countTotal }} Operators not yet adjust
                            timesheet, please add the remaining Operators
                        </b>
                        <br>
                        @if ($countRemainingOperatorDailyDate === 0)
                            <b>All Operators have updated to the latest daily date</b>
                        @else
                            <b>{{ $countRemainingOperatorDailyDate }} out of {{ $countCurrentTableTotalOperators }}
                                Operators not yet update to the latest Daily Date, please consider update</b>
                        @endif
                    </div>
                </div>
            @endif
            <div class="col-md-6">
                <div class="pd-20 text-md-right" style="text-align: center;">
                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#cloneTimeSheet"
                        style="padding: 5px 10px; font-size: 14px;" id="new_reallocate"><i class="fas fa-copy"></i>
                        Batch Update
                    </button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#generateReport"
                        style="padding: 5px 10px; font-size: 14px;" id="new_reallocate"><i class="fas fa-file-pdf"></i>
                        Generate Report
                    </button>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addNewEmpTimeSheet"
                        style="padding: 5px 10px; font-size: 14px;" id="new_reallocate"><i
                            class="fas fa-plus-circle"></i>
                        Add New
                    </button>
                    <button type="button" class="btn btn-info" id="btnRefresh"
                        style="padding: 5px 10px; font-size: 14px;">
                        <i class="fas fa-sync"></i>
                        Refresh List
                    </button>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="container" style="max-width: 100%;">
                <br>

                @php
                    $hasLocationMismatch = false;
                    foreach ($dts as $dtsData) {
                        if ($dtsData->location !== auth()->user()->location) {
                            $hasLocationMismatch = true;
                            break;
                        }
                    }
                @endphp
                <table id="datatable" class="table table-striped cell-border" style="width:100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Staff ID</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Daily Date</th>
                            <th>Start Work</th>
                            <th>Start Lunch</th>
                            <th>End Lunch</th>
                            <th>End Work</th>
                            <th>Start OT</th>
                            <th>End OT</th>
                            <th>On Leave</th>
                            <th>MC</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dts as $key => $dtsData)
                            @php
                                $highlightClass = ($dtsData->location !== auth()->user()->location) ? 'highlight-row' : '';
                            @endphp
                            <tr class="{{ $highlightClass }}">
                                <td>{{ ++$key }}</td>
                                <td>{{ $dtsData->staffid }}</td>
                                <td>{{ $dtsData->name }}</td>
                                @if ($dtsData->dept == '')
                                    <td>-</td>
                                @else
                                    <td>{{ $dtsData->dept }}</td>
                                @endif

                                @if ($dtsData->location == '')
                                    <td>-</td>
                                @else
                                    <td>{{ $dtsData->location }}</td>
                                @endif
                                <td
                                    data-daily-date="{{ $dtsData->daily_date ? Carbon\Carbon::parse($dtsData->daily_date)->format('Y-m-d') : 'N/A' }}">
                                    {{ $dtsData->daily_date ? Carbon\Carbon::parse($dtsData->daily_date)->formatLocalized('%d/%m/%Y') : 'N/A' }}
                                </td>

                                @if ($dtsData->start_work == '')
                                    <td>-</td>
                                @else
                                    <td>
                                        {{ $dtsData->start_work ? Carbon\Carbon::parse($dtsData->start_work)->format('h:i A') : 'N/A' }}
                                    </td>
                                @endif

                                @if ($dtsData->start_lunch == '')
                                    <td>-</td>
                                @else
                                    <td>
                                        {{ $dtsData->start_lunch ? Carbon\Carbon::parse($dtsData->start_lunch)->format('h:i A') : 'N/A' }}
                                    </td>
                                @endif

                                @if ($dtsData->end_lunch == '')
                                    <td>-</td>
                                @else
                                    <td>
                                        {{ $dtsData->end_lunch ? Carbon\Carbon::parse($dtsData->end_lunch)->format('h:i A') : 'N/A' }}
                                    </td>
                                @endif

                                @if ($dtsData->end_work == '')
                                    <td>-</td>
                                @else
                                    <td>
                                        {{ $dtsData->end_work ? Carbon\Carbon::parse($dtsData->end_work)->format('h:i A') : 'N/A' }}
                                    </td>
                                @endif

                                @if ($dtsData->start_ot == '')
                                    <td>-</td>
                                @else
                                    <td>
                                        {{ $dtsData->start_ot ? Carbon\Carbon::parse($dtsData->start_ot)->format('h:i A') : 'N/A' }}
                                    </td>
                                @endif

                                @if ($dtsData->end_ot == '')
                                    <td>-</td>
                                @else
                                    <td>
                                        {{ $dtsData->end_ot ? Carbon\Carbon::parse($dtsData->end_ot)->format('h:i A') : 'N/A' }}
                                    </td>
                                @endif

                                <td>
                                    @if ($dtsData->onleave == 'N')
                                        <span>No</span>
                                    @elseif ($dtsData->onleave == 'Y')
                                        <span>Yes</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($dtsData->mc == 'N')
                                        <span>No</span>
                                    @elseif ($dtsData->mc == 'Y')
                                        <span>Yes</span>
                                    @endif
                                </td>
                                <td style="display: flex; flex-direction: column; align-items: center;">
                                    <button class="btn btn-outline-danger btn-circle" title="Update New Record"
                                        data-toggle="modal" data-target="#editCurrentEmp" data-delay='{"show":"2000"}'
                                        id="editEmp"
                                        data-emp-dailydate="{{ $dtsData->daily_date ? Carbon\Carbon::parse($dtsData->daily_date)->formatLocalized('%d/%m/%Y') : 'N/A' }}"
                                        data-general-data="{{ json_encode($dtsData) }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-info" role="alert">
                                <strong>Whoops!</strong> No Match Found !!
                            </div>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            @if ($hasLocationMismatch)
                                <td colspan="6" style="font-size: 13px; font-style:italic;">
                                    *The current operator has relocated to a new plant location and the current viewing is for the old location. Please consider updating the existing record.
                                </td>
                            @else
                                <td colspan="6" style="font-size: 13px; font-style:italic;"></td>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    @include('BS.DailyTimesheet.Modal.generate_report_modal')
    @include('BS.DailyTimesheet.Modal.add_new_operator_timesheet_modal')
    @include('BS.DailyTimesheet.Modal.edit_current_operator_timesheet_modal')
    @include('BS.DailyTimesheet.Modal.clone_timesheet_modal')

    <br>
</body>

<script>
    window.currentUserRole = parseInt(@json(auth()->user()->role));
    window.currentUserLocation = @json(auth()->user()->location);
</script>

<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('js/bootstrap4-toggle.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/DailyTimesheetJS/main_index.js') }}?random=<?php echo uniqid(); ?>"></script>
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

</html>
