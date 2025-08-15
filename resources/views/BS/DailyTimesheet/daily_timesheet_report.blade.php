<!DOCTYPE html>
<html>

<head>
    <title>Operator Daily Timesheet Report</title>
</head>

<style>
    .table1 {
        text-align: center;
        width: 100%;
    }

    h2 {
        font-family: arial, sans-serif;
    }

    .table2 {
        text-align: center;
        width: 100%;
        border-collapse: collapse;
    }

    .table2 th {
        background-color: #AEAAAA;
        border: 1px solid #000;
        padding: 8px;
    }

    .table2 td {
        border: 1px solid #000;
        padding: 8px;
    }

    .table2 th.table2-col1 {
        width: 3%;
        text-align: left;
    }

    .table2 th.table2-col2 {
        width: 7%;
        text-align: left;
    }

    .table2 th.table2-col3,
    .table2 th.table2-col4,
    .table2 th.table2-col5,
    .table2 th.table2-col6,
    .table2 th.table2-col7,
    .table2 th.table2-col8 {
        width: 10%;
    }

    .table2 th.table2-col9,
    .table2 th.table2-col10 {
        width: 7%;
    }

    .table2 td.table2-row1 {
        border-collapse: collapse;
    }

    .table3 {
        text-align: center;
        width: 100%;
        border-collapse: collapse;
    }

    .table3 td {
        border: 1px solid #000;
        padding: 8px;
    }

    .table3-col1 {
        text-align: left;
    }

    .table3-col3,
    .table3-col4,
    .table3-col5,
    .table3-col6,
    .table3-col7,
    .table3-col8 {
        width: 10%;
    }

    .table3-col9,
    .table3-col10 {
        width: 7%;
    }
</style>

<body>
    <table class="table1">
        <tr>
            <td>
                <h2>Operator Daily Timesheet Record from {{ $dateFrom }} to {{ $dateTo }}</h2>
            </td>
        </tr>
    </table>

    <br>

    @foreach ($dtsReport->groupBy('daily_date') as $date => $operatorData)
        <table class="table2">
            <thead>
                <tr>
                    <th class="table2-col1">Date:</th>
                    <th class="table2-col2">
                        {{ $date ? Carbon\Carbon::parse($date)->formatLocalized('%d/%m/%Y') : 'N/A' }}
                    </th>
                    <th class="table2-col3">SW</th>
                    <th class="table2-col4">SL</th>
                    <th class="table2-col5">EL</th>
                    <th class="table2-col6">EW</th>
                    <th class="table2-col7">SOT</th>
                    <th class="table2-col8">EOT</th>
                    <th class="table2-col9">L</th>
                    <th class="table2-col10">MC</th>
                </tr>
            </thead>
        </table>

        @foreach ($operatorData as $key => $dtsReportData)
            <table class="table3">
                <tr>
                    <td class="table3-col1">{{ $key + 1 }}) {{ $dtsReportData->name }} ({{ $dtsReportData->staffid }})</td>
                    <td class="table3-col3">
                        {{ $dtsReportData->start_work ? Carbon\Carbon::parse($dtsReportData->start_work)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="table3-col4">
                        {{ $dtsReportData->start_lunch ? Carbon\Carbon::parse($dtsReportData->start_lunch)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="table3-col5">
                        {{ $dtsReportData->end_lunch ? Carbon\Carbon::parse($dtsReportData->end_lunch)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="table3-col6">
                        {{ $dtsReportData->end_work ? Carbon\Carbon::parse($dtsReportData->end_work)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="table3-col7">
                        {{ $dtsReportData->start_ot ? Carbon\Carbon::parse($dtsReportData->start_ot)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="table3-col8">
                        {{ $dtsReportData->end_ot ? Carbon\Carbon::parse($dtsReportData->end_ot)->format('h:i A') : 'N/A' }}
                    </td>
                    <td class="table3-col9">
                        @if ($dtsReportData->onleave == 'N')
                            No
                        @elseif ($dtsReportData->onleave == 'Y')
                            Yes
                        @endif
                    </td>
                    <td class="table3-col10">
                        @if ($dtsReportData->mc == 'N')
                            No
                        @elseif ($dtsReportData->mc == 'Y')
                            Yes
                        @endif
                    </td>
                </tr>
            </table>
        @endforeach
    @endforeach

    {{-- <p>No data available for the following operators:</p>
    <ul>
        @foreach ($selectedOperators as $key => $operator)
            @php
                $operatorNames = explode(', ', $selectedOperatorsName[0]);
                $operatorName = $operatorNames[$key] ?? null;
            @endphp
            @if (!$dtsReport->where('staffid', $operator)->count())
                <li>
                    @if ($operatorName)
                        {{ $operatorName }} (ID: {{ $operator }})
                    @else
                        Operator with ID {{ $operator }} (Name not found)
                    @endif
                </li>
            @endif
        @endforeach
    </ul> --}}
</body>

</html>
