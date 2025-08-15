<div class="modal fade" id="cloneTimeSheet" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Batch Update TimeSheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('store-clonetimesheet') }}" method="POST" autocomplete="off"
                enctype="multipart/form-data" id="clonetimesheet-form">
                @csrf
                <div class="modal-body">
                    <center>
                        <h4 id="permissionTextBatch" style="color:red"></h4>
                    </center>
                    <div class="form-group">
                        <label>Select The Date From Daily Date<span class="asterikrequired">*</span></label>
                        <input class="form-control datepicker" id="dateFromInputBatch" name="dateFrom">
                    </div>

                    <div class="form-group">
                        <label>Select Operator(s):<span class="asterikrequired">*</span></label>
                        <div id="operatorCheckboxes">
                        </div>
                    </div>
                    <input type="hidden" id="operatorData" name="operatorData">
                </div>

                <div class="modal-footer">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-success" id="btnSubmitNewBatch">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
