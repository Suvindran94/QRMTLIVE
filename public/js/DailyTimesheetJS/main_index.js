function enableButtonsBasedOnDate() {
    let todayDate = new Date().toISOString().split('T')[0];

    $('td[data-daily-date]').each(function () {
        let dailyDate = $(this).data('daily-date');
        let button = $(this).closest('tr').find('button');

        if (dailyDate !== 'N/A' && dailyDate < todayDate) {
            button.removeAttr('disabled');
            button.removeClass('enabled-button');
        } else if (dailyDate === todayDate) {
            button.removeAttr('disabled');
            button.addClass('enabled-button');
            button.attr('title', 'Update Existing Record');
        } else {
            button.attr('disabled', 'disabled');
            button.removeClass('enabled-button');
        }
    });
}

function formatDateTime(dateTime) {
    if (dateTime === null) {
        return '-';
    } else {
        return new Date(dateTime).toLocaleTimeString('en-US', { hour: "2-digit", minute: "2-digit" });
    }
}

$(document).ready(function () {
    $.fn.modal.Constructor.prototype._enforceFocus = function () { };
    $(".alert").slideDown(300).delay(5000).slideUp(300);

    let select2labelGenerateReport;
    $('#generateReport').on('shown.bs.modal', function (e) {
        $('#datetimepickerDateFrom, #datetimepickerDateTo').datetimepicker('destroy');

        $('#datetimepickerDateFrom').datetimepicker({
            format: 'DD/MM/YYYY',
            toolbarPlacement: 'bottom',
            buttons: {
                showClear: true,
            },
            icons: {
                clear: 'fas fa-trash fa-lg',
            },
        });
        $('#datetimepickerDateTo').datetimepicker({
            useCurrent: false,
            format: 'DD/MM/YYYY',
            toolbarPlacement: 'bottom',
            buttons: {
                showClear: true,
            },
            icons: {
                clear: 'fas fa-trash fa-lg',
            },
        });
        $("#datetimepickerDateFrom").on("change.datetimepicker", function (e) {
            $('#datetimepickerDateTo').datetimepicker('minDate', e.date);
        });
        $("#datetimepickerDateTo").on("change.datetimepicker", function (e) {
            $('#datetimepickerDateFrom').datetimepicker('maxDate', e.date);
        });

        $("#generateTimeSheetReport-form").validate({
            focusInvalid: false,
            errorPlacement: function (error, element) {
                if (element.hasClass('errorLabelGenerateReport')) {
                    error.insertAfter(element.parent()).addClass('text-danger');
                    select2labelGenerateReport = error
                } else {
                    error.insertAfter(element).addClass('text-danger');
                }
                if (element.attr("name") === "dateFrom" || element.attr("name") === "dateTo") {
                    error.insertAfter(element.closest(".input-group"));
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                "select_generate_operator[]": "required",
                dateFrom: "required",
                dateTo: "required",
            },
            messages: {
                "select_generate_operator[]": "This field is required",
                dateFromInput: "This field is required",
                dateToInput: "This field is required",
            },
        });

        $.fn.select2.amd.define('select2/selectAllAdapter', [
            'select2/utils',
            'select2/dropdown',
            'select2/dropdown/attachBody'
        ], function (Utils, Dropdown, AttachBody) {
            function SelectAll() { }

            SelectAll.prototype.render = function (decorated) {
                var $rendered = decorated.call(this);
                var self = this;

                var $selectAllContainer = $(
                    '<div class="select2-button-container" style="border-bottom: 1px solid #ced4da"></div>'
                );

                var $selectAll = $(
                    '<button type="button" class="btn btn-primary btn-sm" style="border-radius: 10px;">Select All</button>'
                );

                var $deselectAll = $(
                    '<button type="button" class="btn btn-danger btn-sm" style="border-radius: 10px;">Deselect All</button>'
                );

                var checkOptionsCount = function () {
                    var $results = self.$dropdown.find('.select2-results');
                    var count = $results.find('.select2-results__option[aria-selected=false]').length;
                };

                $rendered.on('select2:open', function () {
                    checkOptionsCount();
                });

                var $dropdown = $rendered.find('.select2-dropdown');

                $selectAllContainer.append($selectAll);
                $selectAllContainer.append($deselectAll);

                $dropdown.prepend($selectAllContainer);

                $selectAll.on('click', function (e) {
                    var $results = self.$dropdown.find('.select2-results');
                    var $options = $results.find('.select2-results__option[aria-selected=false]');

                    $options.each(function () {
                        var $option = $(this);

                        var data = $option.data('data');

                        self.trigger('select', {
                            data: data
                        });
                    });

                    self.trigger('close');
                });

                $deselectAll.on('click', function (e) {
                    var $selectedOptions = self.$element.find('option:selected');

                    $selectedOptions.prop('selected', false);

                    self.$element.trigger('change');
                    self.trigger('close');
                });

                return $rendered;
            };

            return Utils.Decorate(
                Utils.Decorate(
                    Dropdown,
                    AttachBody
                ),
                SelectAll
            );
        });

        let currentUserRole = window.currentUserRole;

        if (currentUserRole === 25) {
            $("#select_generate_operator").select2({
                placeholder: "-- Search Operator ID/Name --",
                allowClear: true,
                ajax: {
                    url: "/generate_operator_report",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            location: currentUserLocation
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: $.map(response, function (item) {
                                return {
                                    text: item.name,
                                    id: item.staffid,
                                    location: item.location
                                }
                            })
                        };
                    },
                    cache: true,
                },
                templateResult: formatTextId,
                templateSelection: formatTextId,
                dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter')
            });
        } else {
            $("#permissionTextGenerate").text("You Do Not Have Permission To Proceed");
            $("#select_generate_operator").prop('disabled', true);
            $("#dateFromInput").prop('disabled', true);
            $("#dateToInput").prop('disabled', true);
            $("#btnSubmitGen").prop('disabled', true);
        }

        $('#select_generate_operator').on('select2:select', function (event) {
            let selectedOperators = $(this).val();
            let selectedOperatorsName = [];

            if (selectedOperators && selectedOperators.length > 0) {
                for (let i = 0; i < selectedOperators.length; i++) {
                    selectedOperatorsName.push($("#select_generate_operator option[value='" + selectedOperators[i] + "']").text());
                }
            }

            let formattedNames = selectedOperatorsName.join(', ');

            $('#select_generate_operator_name').val(formattedNames).trigger('change');

            $(this).select2('close');
        });

        $('#select_generate_operator').on('select2:unselect', function (event) {
            $(this).select2('close');
        });

        $('#select_generate_operator').on("change", function (e) {
            if (select2labelGenerateReport) {
                select2labelGenerateReport.remove();
            }
        });
    });

    $("#newTimeSheet-form").on("submit", function (event) {
        let startWorkValue = $("#startWorkInput").val();
        let endWorkValue = $("#endWorkInput").val();
        let startLunchValue = $("#startLunchInput").val();
        let endLunchValue = $("#endLunchInput").val();
        let startOTValue = $("#startOTInput").val();
        let endOTValue = $("#endOTInput").val();

        let startWork = moment(startWorkValue, "hh:mm A");
        let endWork = moment(endWorkValue, "hh:mm A");
        let startLunch = moment(startLunchValue, "hh:mm A");
        let endLunch = moment(endLunchValue, "hh:mm A");
        let startOT = moment(startOTValue, "hh:mm A");
        let endOT = moment(endOTValue, "hh:mm A");

        if (startWork.format("A") === "PM") {
            if (startLunch.format("A") === "AM" && endLunch.format("A") === "AM" && endWork.format("A") === "AM") {
            } else {
                if (startWork.isBefore(startLunch) || startLunch.isBefore(endLunch) || endLunch.isAfter(endWork)) {
                    alert("The times set are logically incorrect for the evening shift. Please re-select your time.");
                    event.preventDefault();
                    return;
                }

                if (endWork.isBefore(endLunch)) {
                    alert("End Work cannot be before End Lunch.");
                    event.preventDefault();
                    return;
                }

                if (startLunch.isBefore(startWork) || endLunch.isBefore(startLunch) || endWork.isBefore(startWork)) {
                    alert("The times set are logically incorrect for the evening shift. Please re-select your time.");
                    event.preventDefault();
                    return;
                }
            }
        }
        else if (startWork.format("A") === "AM") {
            if (
                endWork.isBefore(startWork) ||
                startLunch.isBefore(startWork) ||
                endLunch.isBefore(startLunch) ||
                endLunch.isAfter(endWork)
            ) {
                alert("The times set are logically incorrect for the morning shift. Please re-select your time.");
                event.preventDefault();
                return;
            }
        }

        if (startLunch.isValid() && endWork.isValid()) {
            let durationBetweenLunchAndEndWork = endWork.diff(startLunch, 'minutes');
            if (durationBetweenLunchAndEndWork < 60) {
                alert("Start Lunch must be at least 1 hour before End Work.");
                event.preventDefault();
                return;
            }
        }

        if (startLunch.isValid() && endLunch.isValid() && endLunch.isBefore(startLunch)) {
            alert("End Lunch cannot be before Start Lunch.");
            event.preventDefault();
            return;
        }

        if (endLunch.isValid() && endWork.isValid() && endLunch.isAfter(endWork)) {
            alert("End Lunch cannot be after End Work.");
            event.preventDefault();
            return;
        }

        if (startOTValue && !endOTValue) {
            alert("Please enter the End OT time.");
            event.preventDefault();
            return;
        }

        if (!startOTValue && !endOTValue) {
            return;
        }

        if (startOT.isBefore(endWork)) {
            alert("Start OT cannot be before End Work time.");
            event.preventDefault();
            return;
        }

        if (endOT.isBefore(startOT)) {
            endOT.add(1, 'days');
        }

        let durationInMinutes = endOT.diff(startOT, 'minutes');

        if (durationInMinutes > 720) {
            alert("The OT duration exceeds 12 hours. You cannot proceed.");

            event.preventDefault();
            return;
        } else if (durationInMinutes > 360) {
            let proceed = confirm("The OT duration exceeds 6 hours. Do you still want to proceed?");

            if (!proceed) {
                $("#endOTInput").val("");
                event.preventDefault();
                return;
            }
        }
    });

    $('#addNewEmpTimeSheet').on('shown.bs.modal', function (e) {
        $('#newTimeSheet-form input[name="staffName[]"]').remove();
        $('#newTimeSheet-form input[name="staffDept[]"]').remove();
        $('#newTimeSheet-form input[name="staffLoc[]"]').remove();

        $('#datetimepickerStartWork, #datetimepickerEndWork, #datetimepickerStartLunch, #datetimepickerEndLunch, #datetimepickerStartOT, #datetimepickerEndOT').datetimepicker('destroy');

        $('#datetimepickerStartWork, #datetimepickerEndWork, #datetimepickerStartLunch, #datetimepickerEndLunch, #datetimepickerStartOT, #datetimepickerEndOT').datetimepicker({
            format: "hh:mm A",
            useSeconds: true,
            toolbarPlacement: 'bottom',
            buttons: {
                showClose: true
            },
            icons: {
                close: 'fas fa-times-circle fa-lg'
            }
        });

        $("#newTimeSheet-form").validate({
            focusInvalid: false,
            errorPlacement: function (error, element) {
                if (element.hasClass('errorLabel')) {
                    error.insertAfter(element.parent()).addClass('text-danger');
                    select2label = error
                } else {
                    error.insertAfter(element).addClass('text-danger');
                }
                if (element.attr("name") === "startWork" || element.attr("name") === "endWork" || element.attr("name") === "startLunch" || element.attr("name") === "endLunch" || element.attr("name") === "startOT" || element.attr("name") === "endOT") {
                    error.insertAfter(element.closest(".input-group"));
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                "select_staffID[]": "required",
                startWork: "required",
                endWork: "required",
                startLunch: "required",
                endLunch: "required",
            },
            messages: {
                "select_staffID[]": "This field is required",
                startWorkInput: "This field is required",
                endWorkInput: "This field is required",
                startLunchInput: "This field is required",
                endLunchInput: "This field is required",
            },
        });

        $.fn.select2.amd.define('select2/selectAllAdapter', [
            'select2/utils',
            'select2/dropdown',
            'select2/dropdown/attachBody'
        ], function (Utils, Dropdown, AttachBody) {
            function SelectAll() { }

            SelectAll.prototype.render = function (decorated) {
                var $rendered = decorated.call(this);
                var self = this;

                var $selectAllContainer = $(
                    '<div class="select2-button-container" style="border-bottom: 1px solid #ced4da"></div>'
                );

                var $selectAll = $(
                    '<button type="button" class="btn btn-primary btn-sm" style="border-radius: 10px;">Select All</button>'
                );

                var $deselectAll = $(
                    '<button type="button" class="btn btn-danger btn-sm" style="border-radius: 10px;">Deselect All</button>'
                );

                var checkOptionsCount = function () {
                    var $results = self.$dropdown.find('.select2-results');
                    var count = $results.find('.select2-results__option[aria-selected=false]').length;
                };

                $rendered.on('select2:open', function () {
                    checkOptionsCount();
                });

                var $dropdown = $rendered.find('.select2-dropdown');

                $selectAllContainer.append($selectAll);
                $selectAllContainer.append($deselectAll);

                $dropdown.prepend($selectAllContainer);

                $selectAll.on('click', function (e) {
                    var $results = self.$dropdown.find('.select2-results');
                    var $options = $results.find('.select2-results__option[aria-selected=false]');

                    $options.each(function () {
                        var $option = $(this);

                        var data = $option.data('data');

                        self.trigger('select', {
                            data: data
                        });
                    });

                    self.trigger('close');
                });

                $deselectAll.on('click', function (e) {
                    $('#newTimeSheet-form input[name="staffName[]"]').remove();
                    $('#newTimeSheet-form input[name="staffDept[]"]').remove();
                    $('#newTimeSheet-form input[name="staffLoc[]"]').remove();
                    var $selectedOptions = self.$element.find('option:selected');

                    $selectedOptions.prop('selected', false);

                    self.$element.trigger('change');
                    self.trigger('close');
                });

                return $rendered;
            };

            return Utils.Decorate(
                Utils.Decorate(
                    Dropdown,
                    AttachBody
                ),
                SelectAll
            );
        });

        let currentUserLocation = window.currentUserLocation;

        if (currentUserRole === 25) {
            $("#select_staffID").select2({
                placeholder: "-- Search Operator ID/Name --",
                allowClear: true,
                ajax: {
                    url: "/getOperators",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term,
                            location: currentUserLocation
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: $.map(response, function (item) {
                                return {
                                    text: item.fname,
                                    id: item.StaffID,
                                    dept: item.dept,
                                    deptName: item.deptName,
                                    location: item.location
                                }
                            })
                        };
                    },
                    cache: true,
                },
                templateResult: formatTextId,
                templateSelection: formatTextId,
                dropdownAdapter: $.fn.select2.amd.require('select2/selectAllAdapter')
            });
        } else {
            $("#permissionTextAddNew").text("You Do Not Have Permission To Proceed");
            $("#select_staffID").prop('disabled', true);
            $("#startWorkInput").prop('disabled', true);
            $("#endWorkInput").prop('disabled', true);
            $("#startLunchInput").prop('disabled', true);
            $("#endLunchInput").prop('disabled', true);
            $("#startOTInput").prop('disabled', true);
            $("#endOTInput").prop('disabled', true);
            $("#inputEmpStatusLeave").prop('disabled', true);
            $("#inputEmpStatusMC").prop('disabled', true);
            $("#btnSubmitNew").prop('disabled', true);
        }

        $('#select_staffID').on('select2:select', function (event) {
            let selectedOption = event.params.data;

            if (selectedOption && selectedOption.text && selectedOption.deptName && selectedOption.location) {
                let staffName = selectedOption.text;
                let staffDept = selectedOption.deptName;
                let staffLoc = selectedOption.location;

                let existingNames = $('input[name="staffName[]"]').map(function () {
                    return $(this).val();
                }).get();

                if (!existingNames.includes(staffName)) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'staffName[]',
                        value: staffName
                    }).appendTo('#newTimeSheet-form');

                    $('<input>').attr({
                        type: 'hidden',
                        name: 'staffDept[]',
                        value: staffDept
                    }).appendTo('#newTimeSheet-form');

                    $('<input>').attr({
                        type: 'hidden',
                        name: 'staffLoc[]',
                        value: staffLoc
                    }).appendTo('#newTimeSheet-form');
                }
            }

            $(this).select2('close');
        });

        $('#select_staffID').on('select2:unselect', function (event) {
            // Remove the hidden inputs related to the unselected staff
            let unselectedStaffName = event.params.data.text;

            $('input[name="staffName[]"]').each(function () {
                if ($(this).val() === unselectedStaffName) {
                    $(this).remove();
                }
            });

            $('input[name="staffDept[]"]').each(function () {
                if ($(this).val() === unselectedStaffName) {
                    $(this).remove();
                }
            });

            $('input[name="staffLoc[]"]').each(function () {
                if ($(this).val() === unselectedStaffName) {
                    $(this).remove();
                }
            });

            $(this).select2('close');
        });

        $('#select_staffID').on("change", function (e) {
            if (select2label) {
                select2label.remove();
            }
        });

        let toggleElement = $('#inputEmpStatusLeave');
        let toggleElement2 = $('#inputEmpStatusMC');
        let statusInput = $('#staffStatusLeave');
        let statusInput2 = $('#staffStatusMC');

        $('#inputEmpStatusLeave').bootstrapToggle({
            on: 'Yes',
            off: 'No',
            onstyle: 'success',
            offstyle: 'danger',
            size: 'normal',
            width: '80px',
        });

        $('#inputEmpStatusMC').bootstrapToggle({
            on: 'Yes',
            off: 'No',
            onstyle: 'success',
            offstyle: 'danger',
            size: 'normal',
            width: '80px',
        });

        toggleElement.bootstrapToggle(statusInput.val() === 'Y' ? 'on' : 'off');
        toggleElement2.bootstrapToggle(statusInput.val() === 'Y' ? 'on' : 'off');

        toggleElement.change(function () {
            let state = toggleElement.prop('checked');
            statusInput.val(state ? 'Y' : 'N');
        });

        toggleElement2.change(function () {
            let state = toggleElement2.prop('checked');
            statusInput2.val(state ? 'Y' : 'N');
        });
    });

    let tables = $('#datatable').DataTable({
        language: {
            paginate: {
                next: '&#8594;', // or '→'
                previous: '&#8592;' // or '←'
            },
            searchPlaceholder: "Search...",
        },
        columnDefs: [
            { width: "5%", targets: 12 },
            { orderable: false, targets: 14 }
        ],
        scrollX: true,
    });

    $('#btnRefresh').click(function () {
        $('#datatable').DataTable().destroy();

        $('#datatable').DataTable({
            language: {
                paginate: {
                    next: '&#8594;', // or '→'
                    previous: '&#8592;' // or '←'
                },
                searchPlaceholder: "Search...",
            },
            columnDefs: [
                { width: "5%", targets: 12 },
                { orderable: false, targets: 14 }
            ],
            scrollX: true,
        });
    });

    function formatTextId(response) {
        if (response.loading) {
            return "Searching...";
        }
        return response.text + " (" + response.id + ")";
    }

    let select2label;

    enableButtonsBasedOnDate();
    tables.on('draw.dt', function () {
        enableButtonsBasedOnDate();
    });

    function formatDate(date) {
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();

        const formattedDay = day < 10 ? '0' + day : day;
        const formattedMonth = month < 10 ? '0' + month : month;

        return `${formattedDay}/${formattedMonth}/${year}`;
    }

    $("#editCurrentEmpForm").on("submit", function (event) {
        let newstartWorkValue = $("#newStartWorkInput").val();
        let newendWorkValue = $("#newEndWorkInput").val();
        let newstartLunchValue = $("#newStartLunchInput").val();
        let newendLunchValue = $("#newEndLunchInput").val();
        let newstartOTValue = $("#newStarOTInput").val();
        let newendOTValue = $("#newEndOTInput").val();

        let newStartWork = moment(newstartWorkValue, "hh:mm A");
        let newEndWork = moment(newendWorkValue, "hh:mm A");
        let newStartLunch = moment(newstartLunchValue, "hh:mm A");
        let newEndLunch = moment(newendLunchValue, "hh:mm A");
        let newStartOT = moment(newstartOTValue, "hh:mm A");
        let newEndOT = moment(newendOTValue, "hh:mm A");

        if (newStartWork.format("A") === "PM") {
            if (newStartLunch.format("A") === "AM" && newEndLunch.format("A") === "AM" && newEndWork.format("A") === "AM") {
            } else {
                if (newStartWork.isBefore(newStartLunch) || newStartLunch.isBefore(newEndLunch) || newEndLunch.isAfter(newEndWork)) {
                    alert("The times set are logically incorrect for the evening shift. Please re-select your time.");
                    event.preventDefault();
                    return;
                }

                if (newEndWork.isBefore(newEndLunch)) {
                    alert("End Work cannot be before End Lunch.");
                    event.preventDefault();
                    return;
                }

                if (newStartLunch.isBefore(newStartWork) || newEndLunch.isBefore(newStartLunch) || newEndWork.isBefore(newStartWork)) {
                    alert("The times set are logically incorrect for the evening shift. Please re-select your time.");
                    event.preventDefault();
                    return;
                }
            }
        }
        else if (newStartWork.format("A") === "AM") {
            if (
                newEndWork.isBefore(newStartWork) ||
                newStartLunch.isBefore(newStartWork) ||
                newEndLunch.isBefore(newStartLunch) ||
                newEndLunch.isAfter(newEndWork)
            ) {
                alert("The times set are logically incorrect for the morning shift. Please re-select your time.");
                event.preventDefault();
                return;
            }
        }

        if (newStartLunch.isValid() && newEndWork.isValid()) {
            let durationBetweenLunchAndEndWork = newEndWork.diff(newStartLunch, 'minutes');
            if (durationBetweenLunchAndEndWork < 60) {
                alert("Start Lunch must be at least 1 hour before End Work.");
                event.preventDefault();
                return;
            }
        }

        if (newStartLunch.isValid() && newEndLunch.isValid() && newEndLunch.isBefore(newStartLunch)) {
            alert("End Lunch cannot be before Start Lunch.");
            event.preventDefault();
            return;
        }

        if (newEndLunch.isValid() && newEndWork.isValid() && newEndLunch.isAfter(newEndWork)) {
            alert("End Lunch cannot be after End Work.");
            event.preventDefault();
            return;
        }

        if (newstartOTValue && !newendOTValue) {
            alert("Please enter the End OT time.");
            event.preventDefault();
            return;
        }

        if (!newstartOTValue && !newendOTValue) {
            return;
        }

        if (newStartOT.isBefore(newEndWork)) {
            alert("Start OT cannot be before End Work time.");
            event.preventDefault();
            return;
        }

        if (newEndOT.isBefore(newStartOT)) {
            newEndOT.add(1, 'days');
        }

        let durationInMinutes = newEndOT.diff(newStartOT, 'minutes');

        if (durationInMinutes > 720) {
            alert("The OT duration exceeds 12 hours. You cannot proceed.");

            event.preventDefault();
            return;
        } else if (durationInMinutes > 360) {
            let proceed = confirm("The OT duration exceeds 6 hours. Do you still want to proceed?");

            if (!proceed) {
                $("#newEndOTInput").val("");
                event.preventDefault();
                return;
            }
        }

        if (newendOTValue && !newstartOTValue) {
            alert("Please enter the Start OT time.");
            event.preventDefault();
            return;
        }
    });

    $('#editCurrentEmp').on('shown.bs.modal', function (event) {
        let currentUserRole = window.currentUserRole;

        if (currentUserRole != 25) {
            $("#permissionTextEdit").text("You Do Not Have Permission To Proceed");
            $("#setNowButton").prop('disabled', true);
            $("#newStartWorkInput").prop('disabled', true);
            $("#newStartLunchInput").prop('disabled', true);
            $("#newEndLunchInput").prop('disabled', true);
            $("#newEndWorkInput").prop('disabled', true);
            $("#newStarOTInput").prop('disabled', true);
            $("#newEndOTInput").prop('disabled', true);
            $("#inputNewStatusLeave").prop('disabled', true);
            $("#inputNewStatusMC").prop('disabled', true);
            $("#btnSubmitUpdate").prop('disabled', true);
        }

        $('#datetimepickerNewStartWork, #datetimepickerNewStartLunch, #datetimepickerNewEndLunch, #datetimepickerNewEndWork, #datetimepickerNewStarOT, #datetimepickerNewEndOT').datetimepicker('destroy');

        $('#datetimepickerNewStartWork, #datetimepickerNewStartLunch, #datetimepickerNewEndLunch, #datetimepickerNewEndWork, #datetimepickerNewStarOT, #datetimepickerNewEndOT').datetimepicker({
            format: "hh:mm A",
            useSeconds: true,
            toolbarPlacement: 'bottom',
            buttons: {
                showClose: true
            },
            icons: {
                close: 'fas fa-times-circle fa-lg'
            },
        });

        let todayDate = formatDate(new Date());

        let button = $(event.relatedTarget);
        let empDailyDate = button.data('emp-dailydate');
        let generalDataAttr = button.data('general-data');

        $('#empNameID').val(generalDataAttr.name + "/" + generalDataAttr.staffid);
        $('#currentDailyDate').val(empDailyDate);

        let modalTitle = $('#modalLabelUpdate');

        if (empDailyDate === todayDate) {
            modalTitle.text('Update Existing Timesheet Record');
        } else {
            modalTitle.text('Update New Timesheet Record');
        }

        let modal = $(this);

        modal.find('#newDailyDate').val('');
        modal.find('#setNowButton').click(function () {
            $('#newDailyDate-error').remove();
            $('#newStartWorkInput-error').remove();
            $('#newStartLunchInput-error').remove();
            $('#newEndLunchInput-error').remove();
            $('#newEndWorkInput-error').remove();
            $('#newStarOTInput-error').remove();
            $('#newEndOTInput-error').remove();

            let currentDate = new Date();

            let day = currentDate.getDate();
            let month = currentDate.getMonth() + 1;
            let year = currentDate.getFullYear();

            let formattedDate = (day < 10 ? '0' : '') + day + '/' +
                (month < 10 ? '0' : '') + month + '/' +
                year;

            modal.find('#newDailyDate').val(formattedDate);
            modal.find('#newStartWorkInput').val(formatDateTime(generalDataAttr.start_work));
            modal.find('#newStartLunchInput').val(formatDateTime(generalDataAttr.start_lunch));
            modal.find('#newEndLunchInput').val(formatDateTime(generalDataAttr.end_lunch));
            modal.find('#newEndWorkInput').val(formatDateTime(generalDataAttr.end_work));

            if (generalDataAttr.start_ot == null || generalDataAttr.start_ot === '') {
                modal.find('#newStarOTInput').val('');
            } else {
                modal.find('#newStarOTInput').val(formatDateTime(generalDataAttr.start_ot));
            }

            if (generalDataAttr.end_ot == null || generalDataAttr.end_ot === '') {
                modal.find('#newEndOTInput').val('');
            } else {
                modal.find('#newEndOTInput').val(formatDateTime(generalDataAttr.end_ot));
            }
        });

        $('#currentStartWork').val(formatDateTime(generalDataAttr.start_work));
        $('#currentStartLunch').val(formatDateTime(generalDataAttr.start_lunch));
        $('#currentEndLunch').val(formatDateTime(generalDataAttr.end_lunch));
        $('#currentEndWork').val(formatDateTime(generalDataAttr.end_work));
        $('#currentStartOT').val(formatDateTime(generalDataAttr.start_ot));
        $('#currentEndOT').val(formatDateTime(generalDataAttr.end_ot));

        if (generalDataAttr.onleave == 'N') {
            $('#currentOnLeave').val('No');
        } else {
            $('#currentOnLeave').val('Yes');
        }

        if (generalDataAttr.mc == 'N') {
            $('#currentMC').val('No');
        } else {
            $('#currentMC').val('Yes');
        }

        $('#hiddenEmpID').val(generalDataAttr.staffid);
        $('#hiddenEmpName').val(generalDataAttr.name);
        $('#hiddenEmpDept').val(generalDataAttr.dept);
        $('#hiddenEmpLoc').val(generalDataAttr.location);
        $('#hiddenEmpOnLeave').val(generalDataAttr.onleave);
        $('#hiddenEmpMC').val(generalDataAttr.mc);
        $('#hiddenEmpCreatedAt').val(generalDataAttr.created_at);
        $('#hiddenEmpCreatedBy').val(generalDataAttr.createdby);

        let toggleElement3 = $('#inputNewStatusLeave');
        let toggleElement4 = $('#inputNewStatusMC');
        let statusInput3 = $('#staffStatusLeaveNew');
        let statusInput4 = $('#staffStatusMCNew');

        $('#inputNewStatusLeave').bootstrapToggle({
            on: 'Yes',
            off: 'No',
            onstyle: 'success',
            offstyle: 'danger',
            size: 'normal',
            width: '80px',
        });

        $('#inputNewStatusMC').bootstrapToggle({
            on: 'Yes',
            off: 'No',
            onstyle: 'success',
            offstyle: 'danger',
            size: 'normal',
            width: '80px',
        });

        toggleElement3.bootstrapToggle(statusInput3.val() === 'Y' ? 'on' : 'off');
        toggleElement4.bootstrapToggle(statusInput4.val() === 'Y' ? 'on' : 'off');

        toggleElement3.change(function () {
            let state = toggleElement3.prop('checked');
            statusInput3.val(state ? 'Y' : 'N');
        });

        toggleElement4.change(function () {
            let state = toggleElement4.prop('checked');
            statusInput4.val(state ? 'Y' : 'N');
        });
    });

    $("#editCurrentEmpForm").validate({
        focusInvalid: false,
        errorPlacement: function (error, element) {
            if (element.attr("name") === "newDailyDate") {
                error.insertAfter(element.parent()).addClass('text-danger');
            } else {
                error.insertAfter(element).addClass('text-danger');
            }
            if (element.attr("name") === "newStartWork" || element.attr("name") === "newStartLunch" || element.attr("name") === "newEndLunch" || element.attr("name") === "newEndWork" || element.attr("name") === "newStarOT" || element.attr("name") === "newEndOT") {
                error.insertAfter(element.closest(".input-group")).addClass('text-danger');
            } else {
                error.insertAfter(element).addClass('text-danger');
            }
        },
        rules: {
            newDailyDate: "required",
            newStartWork: "required",
            newStartLunch: "required",
            newEndLunch: "required",
            newEndWork: "required",
        },
        messages: {
            newDailyDate: "This field is required",
            newStartWorkInput: "This field is required",
            newStartLunchInput: "This field is required",
            newEndLunchInput: "This field is required",
            newEndWorkInput: "This field is required",
        },
    });

    var operatorCountMap = {};

    function initializeDatepicker(highlightedDates, response) {
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true,
            clearBtn: true,
            // todayHighlight: true,
            beforeShowDay: function (date) {
                var formattedDate = moment(date).format('DD/MM/YYYY');
                if (highlightedDates.includes(formattedDate)) {
                    var operatorCount = countOperatorsForDate(formattedDate, response);
                    operatorCountMap[formattedDate] = operatorCount;

                    return {
                        classes: 'highlighted-date',
                        tooltip: 'This date contain ' + operatorCount + ' operators'
                    };
                }
            }
        });
    }

    function countOperatorsForDate(date, response) {
        var count = 0;
        $.each(response.highlight, function (index, obj) {
            if (moment(obj.daily_date).format('DD/MM/YYYY') === date) {
                count++;
            }
        });
        return count;
    }

    $('#cloneTimeSheet').on('shown.bs.modal', function (e) {
        let currentUserRole = window.currentUserRole;

        if (currentUserRole === 25) {
            $('.datepicker').datepicker('destroy');

            $('.datepicker').val('Loading...').addClass('loading').prop('disabled', true);
            $('.datepicker').prop('readonly', false);

            $.ajax({
                url: "highlight-operator-date",
                method: 'GET',
                beforeSend: function () {
                    $('.datepicker').val('Loading...').addClass('loading').prop('disabled', true);
                    $('.datepicker').prop('readonly', false);
                },
                success: function (response) {
                    if (response.highlight) {
                        var highlightedDates = response.highlight.map(function (obj) {
                            return moment(obj.daily_date).format('DD/MM/YYYY');
                        });
                        initializeDatepicker(highlightedDates, response);
                    }
                },
                complete: function () {
                    $('.datepicker').val('').removeClass('loading').prop('disabled', false);
                    $('.datepicker').prop('readonly', true);
                }
            });

            $('.datepicker').off('changeDate');

            $('.datepicker').on('changeDate', function (e) {
                var selectedDate = moment(e.date).format('YYYY-MM-DD');

                $.ajax({
                    url: "fetch-operators-by-date",
                    method: 'GET',
                    data: {
                        date: selectedDate
                    },
                    success: function (response) {
                        var operatorCheckboxes = $('#operatorCheckboxes');

                        operatorCheckboxes.empty();

                        if (response.operators.length > 0) {
                            var checkAllCheckbox = '<div class="form-check">' +
                                '<input class="form-check-input check-all" type="checkbox" id="checkAllOperators">' +
                                '<label class="form-check-label" for="checkAllOperators">Check All</label>' +
                                '</div>';
                            operatorCheckboxes.append(checkAllCheckbox);
                            $('#dateFromInput-error').remove();
                        }

                        $.each(response.operators, function (index, operator) {
                            var checkbox = '<div class="form-check">' +
                                '<input class="form-check-input" type="checkbox" value="' + operator.staffid + '" id="operatorCheckbox' + index + '">' +
                                '<label class="form-check-label" for="operatorCheckbox' + index + '">' + operator.name + '(' + operator.staffid + ')' + '</label>' +
                                '</div>';

                            checkbox += '<input type="hidden" name="operatorData[' + operator.staffid + '][name]" value="' + operator.name + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][dept]" value="' + operator.dept + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][location]" value="' + operator.location + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][start_work]" value="' + operator.start_work + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][start_lunch]" value="' + operator.start_lunch + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][end_lunch]" value="' + operator.end_lunch + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][end_work]" value="' + operator.end_work + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][start_ot]" value="' + operator.start_ot + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][end_ot]" value="' + operator.end_ot + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][onleave]" value="' + operator.onleave + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][mc]" value="' + operator.mc + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][status]" value="' + operator.status + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][created_at]" value="' + operator.created_at + '">' +
                                '<input type="hidden" name="operatorData[' + operator.staffid + '][createdby]" value="' + operator.createdby + '">';

                            operatorCheckboxes.append(checkbox);
                        });

                        if (response.operators.length === 0) {
                            $('.check-all').hide();
                        }

                        operatorCheckboxes.show();
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            $(document).on('change', '#checkAllOperators', function () {
                var isChecked = $(this).prop('checked');
                $('#operatorCheckboxes input[type="checkbox"]').prop('checked', isChecked);
            });

            $(document).on('change', '#operatorCheckboxes input[type="checkbox"]', function () {
                var totalCheckboxes = $('#operatorCheckboxes input[type="checkbox"]').length;
                var checkedCheckboxes = $('#operatorCheckboxes input[type="checkbox"]:checked').length;

                $('#checkAllOperators').prop('checked', totalCheckboxes === checkedCheckboxes);
            });

            $("#clonetimesheet-form").validate({
                focusInvalid: false,
                errorPlacement: function (error, element) {
                    if (element.attr("name") === "dateFrom") {
                        error.insertAfter(element).addClass('text-danger');
                        error.insertAfter(element.closest(".input-group"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                rules: {
                    dateFrom: "required",
                },
                messages: {
                    dateFromInput: "This field is required",
                },
            });
        } else {
            $("#permissionTextBatch").text("You Do Not Have Permission To Proceed");
            $("#dateFromInputBatch").prop('disabled', true);
            $("#btnSubmitNewBatch").prop('disabled', true);
        }
    });

    $('#cloneTimeSheet').submit(function (event) {
        event.preventDefault();

        var selectedOperators = [];
        $('#operatorCheckboxes input[type="checkbox"]:checked').each(function () {
            if (!$(this).hasClass('check-all')) {
                selectedOperators.push($(this).val());
            }
        });

        if (selectedOperators.length === 0) {
            alert('Please select at least one operator.');
            return;
        }

        $('#selectedOperators').val(JSON.stringify(selectedOperators));
        var operatorData = {};
        $.each(selectedOperators, function (index, staffid) {
            operatorData[staffid] = {
                name: $('[name="operatorData[' + staffid + '][name]"]').val(),
                dept: $('[name="operatorData[' + staffid + '][dept]"]').val(),
                location: $('[name="operatorData[' + staffid + '][location]"]').val(),
                start_work: $('[name="operatorData[' + staffid + '][start_work]"]').val(),
                start_lunch: $('[name="operatorData[' + staffid + '][start_lunch]"]').val(),
                end_lunch: $('[name="operatorData[' + staffid + '][end_lunch]"]').val(),
                end_work: $('[name="operatorData[' + staffid + '][end_work]"]').val(),
                start_ot: $('[name="operatorData[' + staffid + '][start_ot]"]').val(),
                end_ot: $('[name="operatorData[' + staffid + '][end_ot]"]').val(),
                onleave: $('[name="operatorData[' + staffid + '][onleave]"]').val(),
                mc: $('[name="operatorData[' + staffid + '][mc]"]').val(),
                status: $('[name="operatorData[' + staffid + '][status]"]').val(),
                created_at: $('[name="operatorData[' + staffid + '][created_at]"]').val(),
                createdby: $('[name="operatorData[' + staffid + '][createdby]"]').val()
            };
        });

        $('#operatorData').val(JSON.stringify(operatorData));

        $('#clonetimesheet-form').get(0).submit();
    });

    $('#generateReport').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');

        if (select2labelGenerateReport) {
            select2labelGenerateReport.remove();
        }

        $('#select_generate_operator').val(null).trigger("change");
        $('#dateFromInput-error').remove();
        $('#dateToInput-error').remove();
    });

    $('#addNewEmpTimeSheet').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');

        if (select2label) {
            select2label.remove();
        }

        $('#select_staffID').val(null).trigger("change");
        $('#staffName').val('');
        $('#staffDept').val('');
        $('#staffLoc').val('');
        $('#startWorkInput-error').remove();
        $('#endWorkInput-error').remove();
        $('#startLunchInput-error').remove();
        $('#endLunchInput-error').remove();
        $('#startOTInput-error').remove();
        $('#endOTInput-error').remove();
        $('#inputEmpStatusLeave').bootstrapToggle('off');
        $('#inputEmpStatusMC').bootstrapToggle('off');
    });

    $('#editCurrentEmp').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#newDailyDate-error').remove();
        $('#newStartWorkInput-error').remove();
        $('#newStartLunchInput-error').remove();
        $('#newEndLunchInput-error').remove();
        $('#newEndWorkInput-error').remove();
        $('#newStarOTInput-error').remove();
        $('#newEndOTInput-error').remove();
        $('#inputNewStatusLeave').bootstrapToggle('off');
        $('#inputNewStatusMC').bootstrapToggle('off');
    });

    $('#cloneTimeSheet').on('hidden.bs.modal', function () {
        $(this).find('form').trigger('reset');
        $('#operatorCheckboxes').hide();
        $('#dateFromInput-error').remove();
    });
});
