<div class="modal fade" id="editCurrentEmp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelUpdate">Update New Timesheet Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('store-updatedtimesheet') }}" method="POST" autocomplete="off"
                enctype="multipart/form-data" id="editCurrentEmpForm">
                @csrf
                <div class="modal-body">
                    <center>
                        <h4 id="permissionTextEdit" style="color:red"></h4>
                    </center>
                    <div class="form-group">
                        <label>Operator Name/ID</label>
                        <input type="text" id="empNameID" name="empNameID" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label style="margin-top: 3px;">Current Daily Date</label>
                                <input type="text" id="currentDailyDate" name="currentDailyDate" class="form-control"
                                    readonly>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <label style="margin-top: 2px;">Update New Daily Date<span class="asterikrequired">*</span></label>
                                    <button type="button" class="btn btn-info btn-sm2" id="setNowButton">
                                        Set Now
                                    </button>
                                </div>
                                <input type="text" id="newDailyDate" name="newDailyDate" class="form-control"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                <div class="col">
                                    <label>Current Start Work</label>
                                    <input type="text" id="currentStartWork" name="currentStartWork"
                                        class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label>Update New Start Work<span class="asterikrequired">*</span></label>
                                    <div class="input-group date" id="datetimepickerNewStartWork"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="newStartWorkInput" name="newStartWork"
                                            data-target="#datetimepickerNewStartWork">
                                        <div class="input-group-append" data-target="#datetimepickerNewStartWork"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                <div class="col">
                                    <label>Current Start Lunch</label>
                                    <input type="text" id="currentStartLunch" name="currentStartLunch"
                                        class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label>Update New Start Lunch<span class="asterikrequired">*</span></label>
                                    <div class="input-group date" id="datetimepickerNewStartLunch"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="newStartLunchInput" name="newStartLunch"
                                            data-target="#datetimepickerNewStartLunch">
                                        <div class="input-group-append" data-target="#datetimepickerNewStartLunch"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                <div class="col">
                                    <label>Current End Lunch</label>
                                    <input type="text" id="currentEndLunch" name="currentEndLunch"
                                        class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label>Update New End Lunch<span class="asterikrequired">*</span></label>
                                    <div class="input-group date" id="datetimepickerNewEndLunch"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="newEndLunchInput" name="newEndLunch"
                                            data-target="#datetimepickerNewEndLunch">
                                        <div class="input-group-append" data-target="#datetimepickerNewEndLunch"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                <div class="col">
                                    <label>Current End Work</label>
                                    <input type="text" id="currentEndWork" name="currentEndWork"
                                        class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label>Update New End Work<span class="asterikrequired">*</span></label>
                                    <div class="input-group date" id="datetimepickerNewEndWork"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="newEndWorkInput" name="newEndWork"
                                            data-target="#datetimepickerNewEndWork">
                                        <div class="input-group-append" data-target="#datetimepickerNewEndWork"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                <div class="col">
                                    <label>Current Start OT</label>
                                    <input type="text" id="currentStartOT" name="currentStartOT"
                                        class="form-control" readonly>
                                </div>
                                <div class="col">
                                    <label>Update New Start OT</label>
                                    <div class="input-group date" id="datetimepickerNewStarOT"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="newStarOTInput" name="newStarOT"
                                            data-target="#datetimepickerNewStarOT">
                                        <div class="input-group-append" data-target="#datetimepickerNewStarOT"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <div class="row" style="margin-left: -15px; margin-right: -15px;">
                                <div class="col">
                                    <label>Current End OT</label>
                                    <input type="text" id="currentEndOT" name="currentEndOT" class="form-control"
                                        readonly>
                                </div>
                                <div class="col">
                                    <label>Update New End OT</label>
                                    <div class="input-group date" id="datetimepickerNewEndOT"
                                        data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            id="newEndOTInput" name="newEndOT" data-target="#datetimepickerNewEndOT">
                                        <div class="input-group-append" data-target="#datetimepickerNewEndOT"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label>Current On Leave</label>
                                <input type="text" id="currentOnLeave" name="currentOnLeave" class="form-control"
                                    readonly>
                            </div>
                            <div class="col"
                                style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                                <label class="form-control-label" for="inputNewStatusLeave">Update New On Leave:
                                </label>
                                <input class="form-check-input" id="inputNewStatusLeave" name="inputNewStatusLeave"
                                    type="checkbox" data-onstyle="success" data-offstyle="danger" data-style="ios"
                                    checked>
                                <input type="hidden" id="staffStatusLeaveNew" name="staffStatusLeaveNew" value="N">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row" style="margin-left: -15px; margin-right: -15px;">
                            <div class="col">
                                <label>Current MC</label>
                                <input type="text" id="currentMC" name="currentMC" class="form-control" readonly>
                            </div>
                            <div class="col"
                                style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                                <label class="form-control-label" for="inputNewStatusMC">Update New MC: </label>
                                <input class="form-check-input" id="inputNewStatusMC" name="inputNewStatusMC"
                                    type="checkbox" data-onstyle="success" data-offstyle="danger" data-style="ios"
                                    checked>
                                <input type="hidden" id="staffStatusMCNew" name="staffStatusMCNew" value="N">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="hiddenEmpID" name="hiddenEmpID">
                    <input type="hidden" id="hiddenEmpName" name="hiddenEmpName">
                    <input type="hidden" id="hiddenEmpDept" name="hiddenEmpDept">
                    <input type="hidden" id="hiddenEmpLoc" name="hiddenEmpLoc">
                    <input type="hidden" id="hiddenEmpOnLeave" name="hiddenEmpOnLeave">
                    <input type="hidden" id="hiddenEmpMC" name="hiddenEmpMC">
                    <input type="hidden" id="hiddenEmpCreatedAt" name="hiddenEmpCreatedAt">
                    <input type="hidden" id="hiddenEmpCreatedBy" name="hiddenEmpCreatedBy">
                </div>

                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success" id="btnSubmitUpdate">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
