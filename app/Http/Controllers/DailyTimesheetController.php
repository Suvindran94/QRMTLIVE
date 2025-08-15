<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\DailyTimesheet;
use App\AppraisalEmp;
use App\User;
use Illuminate\Support\Facades\View;

class DailyTimesheetController extends Controller
{
    public function dailyTimesheet()
    {
        $currentDate = Carbon::now()->toDateString();
        $authLocation = auth()->user()->location;

        $dts = DailyTimesheet::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('daily_timesheet')
                ->groupBy('staffid');
        })
            ->where(function ($query) use ($authLocation) {
                $query->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation])
                    ->orWhere(function ($query) use ($authLocation) {
                        $query->whereIn('staffid', function ($subQuery) use ($authLocation) {
                            $subQuery->selectRaw('staffid COLLATE utf8_general_ci')
                                ->from('users')
                                ->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation]);
                        });
                    });
            })
            ->orderby('id', 'desc')
            ->get();

        $existingStaffIDs = DailyTimesheet::pluck('staffid')->filter()->toArray();

        $users = User::leftJoin('department', 'department.id', '=', 'users.dept')
            ->select('users.name', 'users.fname', 'users.StaffID', 'users.dept', 'users.location', 'users.status', 'department.nameS as deptName')
            ->where('users.role', '=', 16)
            ->where('users.status', '=', 'A')
            ->where('users.location', '=', auth()->user()->location)
            // ->whereRaw('users.location COLLATE utf8_general_ci = ?', [auth()->user()->location])
            ->get();

        $countTotal = $users->count();

        $countRemainingOperatorDailyDate = $dts->filter(function ($dt) use ($currentDate) {
            return $dt->daily_date != $currentDate;
        })->count();

        $countCurrentTableTotalOperators = DailyTimesheet::whereIn('staffid', $users->pluck('StaffID'))
            ->distinct('staffid')
            ->count('staffid');

        $remainingOperators = $users->whereNotIn('StaffID', $existingStaffIDs);
        $countRemaining = $remainingOperators->count();

        return view('BS.DailyTimesheet.daily_timesheet', compact('dts', 'countRemaining', 'countTotal', 'countRemainingOperatorDailyDate', 'countCurrentTableTotalOperators'));
    }

    public function generateReportPDF(Request $request)
    {
        $dateFrom = Carbon::createFromFormat('d/m/Y', $request->dateFrom)->format('Y-m-d');
        $dateTo = Carbon::createFromFormat('d/m/Y', $request->dateTo)->format('Y-m-d');
        $selectedOperators = $request->input('select_generate_operator');
        $selectedOperatorsName = $request->input('select_generate_operator_name');
        $authLocation = auth()->user()->location;

        $dtsReport = DailyTimesheet::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('daily_timesheet')
                ->groupBy('daily_date', 'staffid');
        })
            ->whereIn('staffid', $selectedOperators)
            ->where(function ($query) use ($authLocation) {
                $query->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation])
                    ->orWhere(function ($query) use ($authLocation) {
                        $query->whereIn('staffid', function ($subQuery) use ($authLocation) {
                            $subQuery->selectRaw('staffid COLLATE utf8_general_ci')
                                ->from('users')
                                ->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation]);
                        });
                    });
            })
            ->whereBetween('daily_date', [$dateFrom, $dateTo])
            ->orderBy('daily_date')
            ->orderBy('staffid', 'asc')
            ->get();

        $mpdf = new \Mpdf\Mpdf([
            'default_font' => 'arial narrow',
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'setAutoTopMargin' => 'pad',
            'setAutoBottomMargin' => 'pad',
        ]);
        $mpdf->shrink_tables_to_fit = 1;
        $mpdf->keep_table_proportions = true;
        $mpdf->SetDisplayMode('fullwidth');
        $mpdf->SetProtection(array('print'));
        $mpdf->restrictColorSpace = 2;

        $mpdf->SetTitle('Operator Daily Timesheet');

        $data = [
            'dateFrom' => $request->dateFrom,
            'dateTo' => $request->dateTo,
            'dtsReport' => $dtsReport,
            'selectedOperators' => $selectedOperators,
            'selectedOperatorsName' => $selectedOperatorsName,
        ];

        $content = View::make('BS.DailyTimesheet.daily_timesheet_report', $data)->render();

        $name = auth()->user()->fname;
        $locationz = auth()->user()->location;

        $now = Carbon::now()->format('d/m/Y h:i:s');

        $mpdf->SetHTMLFooter('
        <table width="100%">
            <tr>
            <td width="33%" style="font-size: 10x; color: #767171; font-family: arial, sans-serif; font-weight: bold;">
                Legend: <br>
                SW: Start Work <br>
                SL: Start Lunch <br>
                EL: End Lunch <br>
                EW: End Work <br>
                SOT: Start Overtime <br>
                EOT: End Overtime
            </td>
            <td width="33%" style="font-size: 13px; color: #6495ed; text-align: right;"></td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="33%" style="font-size: 12px; color: #4472C4; font-family: arial, sans-serif;">PRINTED BY: ' . $name . '</td>
                <td width="33%" style="font-size: 12px; color: #4472C4; text-align: right; font-family: arial, sans-serif;">PRINTED DATE & TIME: ' . $now . '</td>
            </tr>
        </table>');

        $mpdf->WriteHTML($content);

        $filename = "Operator Daily Timesheet Record($request->dateFrom-$request->dateTo)($locationz).pdf";
        $mpdf->Output($filename, 'I');
    }

    public function dataGenerateOperatorList(Request $request)
    {
        $search = $request->search;
        $authLocation = auth()->user()->location;

        $dts = DailyTimesheet::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('daily_timesheet')
                ->groupBy('staffid');
        })
            ->where(function ($query) use ($authLocation) {
                $query->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation])
                    ->orWhere(function ($query) use ($authLocation) {
                        $query->whereIn('staffid', function ($subQuery) use ($authLocation) {
                            $subQuery->selectRaw('staffid COLLATE utf8_general_ci')
                                ->from('users')
                                ->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation]);
                        });
                    });
            })
            ->where(DB::raw('concat(staffid, " ", name)'), 'like', '%' . $search . '%')
            ->orderBy('id', 'desc')
            ->get();

        $response = array();
        foreach ($dts as $employee) {
            $response[] = array(
                "staffid" => $employee->staffid,
                "name" => $employee->name,
                "location" => $employee->location,
            );
        }

        return response()->json($response);
    }

    public function dataGetOperatorAjax(Request $request)
    {
        $search = $request->search;
        $location = $request->location;

        $existingStaffIDs = DailyTimesheet::pluck('staffid')->filter()->toArray();

        $employees = User::leftJoin('department', 'department.id', '=', 'users.dept')
            ->select('users.name', 'users.fname', 'users.StaffID', 'users.dept', 'users.location', 'users.status', 'department.nameS as deptName')
            ->where('users.role', '=', 16)
            ->where('users.status', '=', 'A')
            ->where('users.location', '=', $location)
            ->whereNotIn('users.StaffID', $existingStaffIDs)
            ->where(DB::raw('concat(StaffID, " ", fname)'), 'like', '%' . $search . '%')
            ->orderby('users.id', 'asc')
            ->get();

        $response = array();
        foreach ($employees as $employee) {
            $response[] = array(
                "StaffID" => $employee->StaffID,
                "fname" => $employee->fname,
                "dept" => $employee->dept,
                "deptName" => $employee->deptName,
                "location" => $employee->location,
            );
        }

        return response()->json($response);
    }

    public function storeNewTimeSheet(Request $request)
    {
        $dateFields = [
            'startWork' => 'start_work',
            'startLunch' => 'start_lunch',
            'endLunch' => 'end_lunch',
            'endWork' => 'end_work',
            'startOT' => 'start_ot',
            'endOT' => 'end_ot',
        ];

        $formattedDates = [];
        $startWorkDate = null;

        foreach ($dateFields as $inputField => $dbColumn) {
            $dateString = $request->input($inputField);
            $carbonDate = !empty($dateString) ? Carbon::createFromFormat('h:i A', $dateString) : null;

            if ($inputField === 'startWork' && $carbonDate) {
                $startWorkDate = Carbon::today()->setTimeFromTimeString($carbonDate->toTimeString());
                $formattedDates[$dbColumn] = $startWorkDate->format('Y-m-d H:i:s');
            } elseif ($carbonDate) {
                if ($startWorkDate) {
                    $comparisonDate = $startWorkDate->copy()->setDate($startWorkDate->year, $startWorkDate->month, $startWorkDate->day);

                    if ($carbonDate->isBefore($comparisonDate)) {
                        $formattedDates[$dbColumn] = $comparisonDate->copy()->addDay()->setTimeFromTimeString($carbonDate->toTimeString())->format('Y-m-d H:i:s');
                    } else {
                        $formattedDates[$dbColumn] = $comparisonDate->setTimeFromTimeString($carbonDate->toTimeString())->format('Y-m-d H:i:s');
                    }
                } else {
                    $formattedDates[$dbColumn] = null;
                }
            } else {
                $formattedDates[$dbColumn] = null;
            }
        }

        $staffIDs = $request->input('select_staffID');
        $staffNames = $request->input('staffName', []);
        $staffDept = $request->input('staffDept', []);
        $staffLoc = $request->input('staffLoc', []);

        $timesheetData = [
            'daily_date' => Carbon::today(),
            'onleave' => $request->input('staffStatusLeave'),
            'mc' => $request->input('staffStatusMC'),
            'status' => 'A',
            'createdby' => auth()->user()->id,
        ];

        foreach ($staffIDs as $index => $staffID) {
            $recordData = [
                'staffid' => $staffID,
                'name' => isset($staffNames[$index]) ? $staffNames[$index] : null,
                'dept' => isset($staffDept[$index]) ? $staffDept[$index] : null,
                'location' => isset($staffLoc[$index]) ? $staffLoc[$index] : null,
            ] + $timesheetData + $formattedDates;

            DailyTimesheet::create($recordData);
        }
        $staffNamesList = implode(', ', $staffNames);

        return redirect()->route('dailyTimesheet')->withStatus('Successfully created for: ' . $staffNamesList);
    }

    public function storeUpdatedTimeSheet(Request $request)
    {
        $dateFieldsEdit = [
            'newStartWork' => 'start_work',
            'newStartLunch' => 'start_lunch',
            'newEndLunch' => 'end_lunch',
            'newEndWork' => 'end_work',
            'newStarOT' => 'start_ot',
            'newEndOT' => 'end_ot',
        ];

        $formattedDatesEdit = [];
        $startWorkDateEdit = null;

        foreach ($dateFieldsEdit as $inputFieldEdit => $dbColumnEdit) {
            $dateStringEdit = $request->input($inputFieldEdit);
            $carbonDateEdit = !empty($dateStringEdit) ? Carbon::createFromFormat('H:i A', $dateStringEdit) : null;

            if ($inputFieldEdit === 'newStartWork' && $carbonDateEdit) {
                $startWorkDateEdit = Carbon::today()->setTimeFromTimeString($carbonDateEdit->toTimeString());
                $formattedDatesEdit[$dbColumnEdit] = $startWorkDateEdit->format('Y-m-d H:i:s');
            } elseif ($carbonDateEdit) {
                if ($startWorkDateEdit) {
                    $comparisonDateEdit = $startWorkDateEdit->copy()->setDate($startWorkDateEdit->year, $startWorkDateEdit->month, $startWorkDateEdit->day);

                    if ($carbonDateEdit->isBefore($comparisonDateEdit)) {
                        $formattedDatesEdit[$dbColumnEdit] = $comparisonDateEdit->copy()->addDay()->setTimeFromTimeString($carbonDateEdit->toTimeString())->format('Y-m-d H:i:s');
                    } else {
                        $formattedDatesEdit[$dbColumnEdit] = $comparisonDateEdit->setTimeFromTimeString($carbonDateEdit->toTimeString())->format('Y-m-d H:i:s');
                    }
                } else {
                    $formattedDatesEdit[$dbColumnEdit] = null;
                }
            } else {
                $formattedDatesEdit[$dbColumnEdit] = null;
            }
        }

        $dailyDate = Carbon::createFromFormat('d/m/Y', $request->input('newDailyDate'))->startOfDay();
        $staffid = $request->input('hiddenEmpID');

        $timesheetDataEdit = [
            'staffid' => $staffid,
            'name' => $request->input('hiddenEmpName'),
            'dept' => $request->input('hiddenEmpDept'),
            'location' => auth()->user()->location,
            'onleave' => $request->input('staffStatusLeaveNew'),
            'mc' => $request->input('staffStatusMCNew'),
            'status' => 'A',
            'created_at' => $request->input('hiddenEmpCreatedAt'),
            'createdby' => $request->input('hiddenEmpCreatedBy'),
            'updatedby' => auth()->user()->id,
        ];

        $recordDataEdit = $timesheetDataEdit + $formattedDatesEdit;
        $recordDataEdit['updated_at'] = now();
        $existingRecord = DailyTimesheet::where('daily_date', $dailyDate)
            ->where('staffid', $staffid)
            ->first();

        if ($existingRecord) {
            $existingRecord->update($recordDataEdit);
        } else {
            $recordDataEdit['daily_date'] = $dailyDate;
            DailyTimesheet::create($recordDataEdit);
        }

        return redirect()->route('dailyTimesheet')->withStatus($request->input('hiddenEmpName') . ' Successful Updated');
    }

    public function fetchOperatorsByDate(Request $request)
    {
        $selectedDate = $request->input('date');
        $authLocation = auth()->user()->location;

        $operators = DailyTimesheet::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('daily_timesheet')
                ->groupBy('staffid');
        })
            ->whereDate('daily_date', $selectedDate)
            ->where(function ($query) use ($authLocation) {
                $query->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation])
                    ->orWhere(function ($query) use ($authLocation) {
                        $query->whereIn('staffid', function ($subQuery) use ($authLocation) {
                            $subQuery->selectRaw('staffid COLLATE utf8_general_ci')
                                ->from('users')
                                ->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation]);
                        });
                    });
            })
            ->orderby('id', 'desc')
            ->get();

        return response()->json(['operators' => $operators]);
    }

    public function getHighlightOperatorsDate()
    {
        $authLocation = auth()->user()->location;

        $dts = DailyTimesheet::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('daily_timesheet')
                ->groupBy('staffid');
        })
            ->where(function ($query) use ($authLocation) {
                $query->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation])
                    ->orWhere(function ($query) use ($authLocation) {
                        $query->whereIn('staffid', function ($subQuery) use ($authLocation) {
                            $subQuery->selectRaw('staffid COLLATE utf8_general_ci')
                                ->from('users')
                                ->whereRaw('location COLLATE utf8_general_ci = ?', [$authLocation]);
                        });
                    });
            })
            ->orderby('id', 'desc')
            ->get();

        return response()->json(['highlight' => $dts]);
    }

    public function storeCloneTimeSheet(Request $request)
    {
        $operatorDataJson = $request->input('operatorData');
        $operatorData = json_decode($operatorDataJson, true);

        if (!$operatorData) {
            return response()->json(['error' => 'Operator data is missing or invalid']);
        }

        $newestDate = date('Y-m-d');
        $successfullyUpdatedStaffNames = [];

        try {
            foreach ($operatorData as $staffid => $data) {
                $existingRecord = DailyTimesheet::where('staffid', $staffid)
                    ->whereDate('daily_date', $newestDate)
                    ->first();

                if ($existingRecord) {
                    $existingRecord->update(['location' => auth()->user()->location, 'daily_date' => $newestDate, 'updated_at' => now(), 'updatedby' => auth()->user()->id]);
                    $successfullyUpdatedStaffNames[] = $existingRecord->name;
                } else {
                    $startTime = date('H:i:s', strtotime($data['start_work']));
                    $startLunch = date('H:i:s', strtotime($data['start_lunch']));
                    $endLunch = date('H:i:s', strtotime($data['end_lunch']));
                    $endWork = date('H:i:s', strtotime($data['end_work']));

                    $startOT = $data['start_ot'] !== 'null' && strtotime($data['start_ot']) !== false
                        ? $newestDate . ' ' . date('H:i:s', strtotime($data['start_ot']))
                        : null;

                    $endOT = $data['end_ot'] !== 'null' && strtotime($data['end_ot']) !== false
                        ? $newestDate . ' ' . date('H:i:s', strtotime($data['end_ot']))
                        : null;

                    $startDateTime = strtotime($newestDate . ' ' . $startTime);
                    $startLunchDateTime = strtotime($newestDate . ' ' . $startLunch);
                    $endLunchDateTime = strtotime($newestDate . ' ' . $endLunch);
                    $endWorkDateTime = strtotime($newestDate . ' ' . $endWork);

                    if ($startLunchDateTime < $startDateTime) {
                        $startLunchDateTime += 86400;
                    }
                    if ($endLunchDateTime < $startLunchDateTime) {
                        $endLunchDateTime += 86400;
                    }
                    if ($endWorkDateTime < $endLunchDateTime) {
                        $endWorkDateTime += 86400;
                    }

                    if ($startOT) {
                        $startOTTime = strtotime($startOT);
                        if ($startOTTime < $endWorkDateTime) {
                            $startOTTime += 86400;
                        }
                        $startOT = date('Y-m-d H:i:s', $startOTTime);
                    }

                    if ($endOT) {
                        $endOTTime = strtotime($endOT);
                        if ($endOTTime < $startOTTime) {
                            $endOTTime += 86400;
                        }
                        $endOT = date('Y-m-d H:i:s', $endOTTime);
                    }

                    DailyTimesheet::create([
                        'staffid' => $staffid,
                        'name' => $data['name'],
                        'dept' => $data['dept'],
                        'location' => auth()->user()->location,
                        'daily_date' => $newestDate,
                        'start_work' => $newestDate . ' ' . date('H:i:s', $startDateTime),
                        'start_lunch' => date('Y-m-d H:i:s', $startLunchDateTime),
                        'end_lunch' => date('Y-m-d H:i:s', $endLunchDateTime),
                        'end_work' => date('Y-m-d H:i:s', $endWorkDateTime),
                        'start_ot' => $startOT,
                        'end_ot' => $endOT,
                        'onleave' => $data['onleave'],
                        'mc' => $data['mc'],
                        'status' => $data['status'],
                        'created_at' => $data['created_at'],
                        'createdby' => $data['createdby'],
                        'updatedby' => auth()->user()->id,
                    ]);

                    $successfullyUpdatedStaffNames[] = $data['name'];
                }
            }

            $successMessage = 'Successful Updated for: ' . implode(', ', $successfullyUpdatedStaffNames);

            return redirect()->route('dailyTimesheet')->withStatus($successMessage);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
