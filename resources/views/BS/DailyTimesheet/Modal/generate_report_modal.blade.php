<div class="modal fade" id="generateReport" tabindex="-1" role="dialog" aria-labelledby="generateReportModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateReportModalLabel">Generate Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('generate_report') }}" method="POST" autocomplete="off"
                enctype="multipart/form-data" id="generateTimeSheetReport-form">
                @csrf
                <div class="modal-body">
                    <center>
                        <h4 id="permissionTextGenerate" style="color:red"></h4>
                    </center>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label>Date From:</label>
                                <div class="input-group date" id="datetimepickerDateFrom" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="dateFromInput"
                                        name="dateFrom" data-target="#datetimepickerDateFrom">
                                    <div class="input-group-append" data-target="#datetimepickerDateFrom"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label>Date To:</label>
                                <div class="input-group date" id="datetimepickerDateTo" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="dateToInput"
                                        name="dateTo" data-target="#datetimepickerDateTo">
                                    <div class="input-group-append" data-target="#datetimepickerDateTo"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Operator:</label>
                        <select class="errorLabelGenerateReport" id='select_generate_operator'
                            name="select_generate_operator[]" style="width: 100%" multiple="multiple">
                        </select>
                        <input type="hidden" id="select_generate_operator_name" name="select_generate_operator_name[]">
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success" id="btnSubmitGen">Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
