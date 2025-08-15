<div class="modal fade" id="addNewEmpTimeSheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Timesheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('store-newtimesheet') }}" method="POST" autocomplete="off"
                enctype="multipart/form-data" id="newTimeSheet-form">
                @csrf
                <div class="modal-body">
                    <center>
                        <h4 id="permissionTextAddNew" style="color:red"></h4>
                    </center>
                    <div class="form-group">
                        <label>Operator Name/ID<span class="asterikrequired">*</span></label>
                        <select class="errorLabel" id='select_staffID' name="select_staffID[]" style="width: 100%" multiple>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label>Start Work<span class="asterikrequired">*</span></label>
                                <div class="input-group date" id="datetimepickerStartWork" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="startWorkInput"
                                        name="startWork" data-target="#datetimepickerStartWork">
                                    <div class="input-group-append" data-target="#datetimepickerStartWork"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label>End Work<span class="asterikrequired">*</span></label>
                                <div class="input-group date" id="datetimepickerEndWork" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="endWorkInput"
                                        name="endWork" data-target="#datetimepickerEndWork">
                                    <div class="input-group-append" data-target="#datetimepickerEndWork"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label>Start Lunch<span class="asterikrequired">*</span></label>
                                <div class="input-group date" id="datetimepickerStartLunch" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="startLunchInput"
                                        name="startLunch" data-target="#datetimepickerStartLunch">
                                    <div class="input-group-append" data-target="#datetimepickerStartLunch"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label>End Lunch<span class="asterikrequired">*</span></label>
                                <div class="input-group date" id="datetimepickerEndLunch" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="endLunchInput"
                                        name="endLunch" data-target="#datetimepickerEndLunch">
                                    <div class="input-group-append" data-target="#datetimepickerEndLunch"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label>Start OT</label>
                                <div class="input-group date" id="datetimepickerStartOT" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="startOTInput"
                                        name="startOT" data-target="#datetimepickerStartOT">
                                    <div class="input-group-append" data-target="#datetimepickerStartOT"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label>End OT</label>
                                <div class="input-group date" id="datetimepickerEndOT" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="endOTInput"
                                        name="endOT" data-target="#datetimepickerEndOT">
                                    <div class="input-group-append" data-target="#datetimepickerEndOT"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label class="form-control-label" for="inputEmpStatusLeave">On Leave: </label>
                                <input class="form-check-input" id="inputEmpStatusLeave" name="inputEmpStatusLeave"
                                    type="checkbox" data-onstyle="success" data-offstyle="danger" data-style="ios"
                                    checked>
                                <input type="hidden" id="staffStatusLeave" name="staffStatusLeave" value="N">
                            </div>
                            <div class="col">
                                <label class="form-control-label" for="inputEmpStatusMC">MC: </label>
                                <input class="form-check-input" id="inputEmpStatusMC" name="inputEmpStatusMC"
                                    type="checkbox" data-onstyle="success" data-offstyle="danger" data-style="ios"
                                    checked>
                                <input type="hidden" id="staffStatusMC" name="staffStatusMC" value="N">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="staffName" name="staffName[]">
                    <input type="hidden" id="staffDept" name="staffDept[]">
                    <input type="hidden" id="staffLoc" name="staffLoc[]">
                </div>

                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success" id="btnSubmitNew">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
