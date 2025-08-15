

function updateTime() {
    var dateInfo = new Date();

    var hr,
        _min = (dateInfo.getMinutes() < 10) ? "0" + dateInfo.getMinutes() : dateInfo.getMinutes(),
        sec = (dateInfo.getSeconds() < 10) ? "0" + dateInfo.getSeconds() : dateInfo.getSeconds(),
        ampm = (dateInfo.getHours() >= 12) ? "PM" : "AM";

    if (dateInfo.getHours() == 0) {
        hr = 12;
    } else if (dateInfo.getHours() > 12) {
        hr = dateInfo.getHours() - 12;
    } else {
        hr = dateInfo.getHours();
    }

    var h = hr;
    var m = _min;
    var s = sec;

    document.getElementsByClassName("h")[0].innerHTML = h;
    document.getElementsByClassName("m")[0].innerHTML = m;
    document.getElementsByClassName("s")[0].innerHTML = s;
    document.getElementsByClassName("ampm")[0].innerHTML = ampm;

    var dow = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday"
    ],
        month = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ],
        day = dateInfo.getDate();

    var currentDate = dow[dateInfo.getDay()] + " " + day + " " + month[dateInfo.getMonth()] + " " + new Date()
        .getFullYear();

    document.getElementsByClassName("date")[0].innerHTML = currentDate;
};

updateTime();
setInterval(function () {
    updateTime()
}, 1000);




$(document).ready(function () {

    var id = $('#id').val();

    var currentstat = '';
    var currentsteps = '';

    $.ajax({
        type: "GET",
        url: "/fetchDashboardData",
        async: false,
        data: {
            _token: $("#csrf").val(),
            id: id
        },
        success: function (data) {

            if (id != '-') {
                // Append Operators
                $.each(data[1], function (id, userName) {

                    var userHtml = '<div class="user-icon" id="' + id + '">' +
                        '<i class="fa-solid fa-user"></i>' +
                        '<span class="user-name">' + userName + '</span>' +
                        '</div>';

                    $('#user-container').append(userHtml);
                });

                //Set Values
                $('#' + data[0].ACTIVEOPR).removeClass('user-icon').addClass('user-icon-active');
                $('#DEVICE').text(data[0].DEVICE);
                $('#ZONE').text(data[0].ZONE);
                $('#WO').text(data[0].WO);
                $('#SO').text(data[0].SO);
                $('#STK').text(data[0].STK);
                $('#PMETHOD').text(data[0].PMETHOD);
                $('#CSTDB').text(data[0].CSTDB);
                $('#CSB').text(data[0].NUMBER+'/'+data[0].TOTAL_SMALL_BAG);
                $('#WOQTY').text(data[0].SCANNED_QTY + '/' + data[0].WOQTY);
                $('#step1').removeClass().addClass(data[0].STEP1);
                $('#step2').removeClass().addClass(data[0].STEP2);
                $('#step3').removeClass().addClass(data[0].STEP3);
                $('#step4').removeClass().addClass(data[0].STEP4);
                $('#step5').removeClass().addClass(data[0].STEP5);
                $('#step6').removeClass().addClass(data[0].STEP6);

                $('#output').append(data[2]);

                $('#CURRENTSTEP').val(data[0].CURRENTSTEP);
                $('#EXCEPTION_STATUS').val(data[0].EXCEPTION_STATUS);
                $('#EXCEPTION').val(data[0].EXCEPTION);
                $('#PRD_STATUS').val(data[0].PRD_STATUS);

                $('#CYCLE_TIME').text(data[0].CYCLE_TIME);
                $('#MOULD').text(data[0].MOULD);
                $('#CAVITY').text(data[0].CAVITY);
                $('#SHORT_NAME').text(data[0].SHORT_NAME);
                $('#STD_PACK').text(data[0].STD_PACK);
                $('#SMALL_PACK').text(data[0].SMALL_PACK);
				$('#NOS_PER_STD_BAG').text(data[0].NOS_PER_STD_BAG);
				

                currentstat = data[0].PRD_STATUS;
                currentsteps = data[0].CURRENTSTEP;

            } else {
                if (data.type == 'ERROR') {
                    Swal.fire({
                        title: 'Error!',
                        html: data.message,
                        icon: 'error',
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                } else {
                    $('#ZONE').text(data.ZONE);
                    $('#output').append(data.output);
                    $('#step1').removeClass().addClass('step-skip');
                    $('#step2').removeClass().addClass('step-skip');
                    $('#step3').removeClass().addClass('step-skip');
                    $('#step4').removeClass().addClass('step-skip');
                    $('#step5').removeClass().addClass('step-skip');
                    $('#step6').removeClass().addClass('step-skip');
                }

            }
        },
        error: function (data) {

            Swal.fire({
                title: 'Error!',
                html: data.responseJSON.message,
                icon: 'error',
                showConfirmButton: true,
                allowEscapeKey: false,
                allowOutsideClick: false
            });
        },

    });



    let errorAlert;


    function checkStatus() {
        $.ajax({
            type: "GET",
            url: "/checkWOstatus",
            async: false,
            global: false,
            data: {
                _token: $("#csrf").val(),
                id: id
            },
            success: function (data) {

                var statusprd = data.status;
                var exception = data.EXCEPTION;
             

                console.log(statusprd);
                console.log(currentstat);
                console.log(exception);
        

                if(statusprd != currentstat && statusprd == 'S' && exception == 0 && currentsteps != '9' && currentsteps != '7' || statusprd != currentstat && statusprd == 'A' && exception == 0 && currentsteps != '9' && currentsteps != '7'){
                    Swal.fire({
                        title: 'Info!',
                        html: 'Status Changed',
                        icon: 'info',
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    setTimeout(function () {
                        Swal.close();
                        location.reload();
                    }, 5000);
                }


                /*
                if (data.type == 'ERROR') {
                    if (!errorAlert) {
                        
                        errorAlert = Swal.fire({
                            title: 'Error!',
                            html: data.message,
                            icon: 'info',
                            showConfirmButton: false,
                            allowEscapeKey: false,
                            allowOutsideClick: false
                        });
                        location.reload();
                        
                    } else {
                        // If errorAlert already exists, update its content
                        errorAlert.update({
                            title: 'Error!',
                            html: data.message
                        });
                    }
                } else {
                    // If data.type is not 'ERROR', close the SweetAlert if it's open
                    if (errorAlert) {
                        errorAlert.close();
                        errorAlert = null; // Reset the errorAlert variable
                        location.reload();
                    }
                }
                */
            }
        });
    }

    if(id != '-' && currentsteps != '9'){
    setInterval(checkStatus, 5000);
    }



    $("body").keypress(function (e) {
        if (e.key === '+') {
            $('#switchuser').modal('show');
        }
    });

    var isAjaxInProgress = false;

    $('#qrcodeoper').keyup(function (e) {
        if (this.value.length == 18 && !isAjaxInProgress) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();

            var qrcodeoper = $('#qrcodeoper').val();

            isAjaxInProgress = true;

            $.ajax({
                type: "GET",
                url: "/switchUser",
                data: {
                    _token: $("#csrf").val(),
                    qrcode: qrcodeoper,
                },
                dataType: 'json',
                cache: false,
                success: function (res) {
                    if (res.type == 'ERROR') {
                        Swal.fire({
                            title: 'Error!',
                            html: res.message,
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 3500
                        });

                        $('#qrcodeoper').val('');
                        $('#qrcodeoper').focus();
                        $("#overlay").fadeOut(300);
                    } else {
                        $('#qrcodeoper').val('');
                        $('#qrcodeoper').focus();
                        window.location.replace(res.url);
                    }
                },
                error: function (res) {
                    swal({
                        position: 'center',
                        type: 'error',
                        html: res.message,
                        showConfirmButton: false,
                        timer: 3500
                    });
                    $('#qrcodeoper').val('');
                    $('#qrcodeoper').focus();
                    $("#overlay").fadeOut(300);
                },
                complete: function () {
                    // Set the flag back to false when the AJAX request is complete
                    isAjaxInProgress = false;
                }
            });
        }
    });


    $('#switchuser').on('show.bs.modal', function (event) {
        resetAndFocusInput('#qrcodeoper', 500);
    });

    $('#switchuser').on('hidden.bs.modal', function () {
        resetAndFocusInput('#weight-input1', 300);
    });

    function resetAndFocusInput(inputSelector, delay) {
        $(inputSelector).val('').removeAttr('autofocus');

        setTimeout(function () {
            $(inputSelector).focus();
        }, delay);
    }


    switch ($('#CURRENTSTEP').val()) {
        case '1':
            setTimeout(function () {
                $.ajax({
                    type: "GET",
                    url: "/printStdBagSticker",
                    async: true,
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                    },
                    success: function (data) {

                        if(data.code == 1){
                        setTimeout(function () {
                            $("#overlay").fadeOut(300);
                            location.reload();
                        }, 5000);
                        }
                        else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Whoops!',
                            html: data.message,
                            showConfirmButton: true
                        });  
                        }

                    }
                });
            }, 2000);
            break;

        case '2':
            $(document).on('click', function (e) {
                if (!$(e.target).is('#weight-input1')) {
                    $('#weight-input1').focus();
                }
            });

            $('#weight-input1').on("keydown", function (e) {
                if (e.which === 13) {
                    var textareaValue = $(this).val();
					

					
                    var valuesArray = textareaValue.split('\n');
                    valuesArray = valuesArray.filter(function (value) {
                        return value.trim() !== '';
                    });

                    var lastElement = valuesArray[valuesArray.length - 1];
                    var parts = lastElement.split(/\s+/);
                    var numericValue = parseFloat(parts[1]);
                    var unit = parts[2];

                    console.log(numericValue);

                    if(numericValue > 0.0060){
                    $('.outputweight').html(parseFloat(numericValue) + '<sub class="tinytext">' + unit + '</sub>');

                    $.ajax({
                        type: "GET",
                        url: "/weightsmallbag",
                        async: true,
                        data: {
                            _token: $("#csrf").val(),
                            id: id,
                            weight: numericValue,
                            unit: unit
                        },
                        success: function (data) {
							
							  switch (data.type) {
                                case "error":
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });


                                      setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        window.location.replace(data.url);
                                    }, 2000);
									  
									  
                                    break;

                                case "info":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        window.location.replace(data.url);
                                    }, 2000);
                                    break;

                                case "success":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 2000);
                                    break;

                                    case "info2":
                               
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Info!',
                                            html: data.message,
                                            showConfirmButton: true
                                        });
                                        setTimeout(function () {
                                            $("#overlay").fadeOut(300);
                                            location.reload();
                                        }, 2000);
                                        break;

                                default:
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: 'Something Wrong !'
                                    });

                           
                                    break;
                            }
                   
                           
                        }
                    });
                }
                else{
                    console.log('trigger');
                    Swal.fire({
                        icon: 'error',
                        title: 'Whoops!',
                        html: "Please lift up Small Bag and Weight Again!",
                        showConfirmButton: false,
                        timer: 2500
                    });
                 
                    setTimeout(function () {
                        $("#overlay").fadeOut(300);
                        location.reload();
                    }, 2500);
                }
                
                } else if (e.which == 52) {
   
                    //$(this).val('');
                }
            });
            break;

        case '3':
            $("body").keypress(function (e) {
                if (e.key === '{') {
                    $.ajax({
                        type: "GET",
                        url: "/printSmallBagSticker",
                        async: true,
                        data: {
                            _token: $("#csrf").val(),
                            id: id
                        },
                        success: function (data) {
                 
                            setTimeout(function () {
                                $("#overlay").fadeOut(300);
                                location.reload();
                            }, 500);
                        }
                    });
                }
            });
            break;

        case '4':
            $(document).on('click', function (e) {
                if (!$(e.target).is('#qrcode')) {
                    $('#qrcode').focus();
                }
            });

	
   $('#qrcode').on("keydown", function (e) {

    if (e.which === 13) {
                	       var qrcode = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "/scanSmallBag",
                        async: true,
                        data: {
                            _token: $("#csrf").val(),
                            id: id,
                            qrcode: qrcode
                        },
                        success: function (data) {
                            switch (data.type) {
                                case "error":
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    $('#qrcode').val('');

                                    $("#overlay").fadeOut(300, function () {
                                        return false;
                                    });
                                    break;

                                case "info":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        window.location.replace(data.url);
                                    }, 2000);
                                    break;

                                case "success":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 2000);
                                    break;

                                    case "info2":
                               
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Info!',
                                            html: data.message,
                                            showConfirmButton: true
                                        });
                                        setTimeout(function () {
                                            $("#overlay").fadeOut(300);
                                            location.reload();
                                        }, 2000);
                                        break;

                                default:
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: 'Something Wrong !'
                                    });

                                    $('#qrcode').val('');
                                    break;
                            }
                        }
                    });
                }
            });
            break;

        case '5':
            var debounceTimer;

            $("body").keypress(function (e) {
                if (e.key === '{') {
                    // Clear previous debounce timer
                    clearTimeout(debounceTimer);

                    debounceTimer = setTimeout(function () {
                        $.ajax({
                            type: "GET",
                            url: "/sealStdBag",
                            async: true,
                            data: {
                                _token: $("#csrf").val(),
                                id: id
                            },
                            success: function (data) {
                          
                                setTimeout(function () {
                                    $("#overlay").fadeOut(300);
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }, 1000); // Adjust the debounce time (in milliseconds) as needed
                }
            });
            break;

        case '6':
            $(document).on('click', function (e) {
                if (!$(e.target).is('#qrcode')) {
                    $('#qrcode').focus();
                }
            });

      $('#qrcode').on("keydown", function (e) {

    if (e.which === 13) {
		       var qrcode = $(this).val();
                    $.ajax({
                        type: "GET",
                        url: "/scanStdBag",
                        async: true,
                        data: {
                            _token: $("#csrf").val(),
                            id: id,
                            qrcode: qrcode
                        },
                        success: function (data) {
                            switch (data.type) {
                                case "error":
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    $('#qrcode').val('');

                                    $("#overlay").fadeOut(300, function () {
                                        return false;
                                    });
                                    break;

                                case "success":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 2000);
                                    break;
                                case "info":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        window.location.replace(data.url);
                                    }, 2000);
                                    break;

                                    case "info2":
                               
                                    Swal.fire({
                                        icon: 'info',
                                        title: 'Info!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 2000);
                                    break;

                                case "BALANCE":
                                    var myModal = new bootstrap.Modal(document.getElementById('generalmodal'));
                                    //myModal.show();
                                    myModal.show({ backdrop: 'static', keyboard: false });

                                    if ($.fn.DataTable.isDataTable('#mytable')) {
                                        $('#mytable').DataTable().destroy();
                                        $('#mytable tbody').empty();
                                    }

                                    $.each(data.message, function (i, data2) {
                                        var body = "<tr>";
                                        body += "<td>" + ++i + "</td>";
                                        body += "<td>" + data2.RAWSTKCODE + "</td>";
                                        body += "<td style='text-align:right;'>" + addCommas(data2.QTY) + "</td>";
                                        body += "</tr>";
                                        $("#mytable tbody").append(body);
                                    });

                                    $('#mytable').DataTable({
                                        "destroy": true,
                                        "lengthMenu": [
                                            [5, 10, 50, -1],
                                            [5, 10, 50, "All"]
                                        ]
                                    });
                                    $("#overlay").fadeOut(300);
                                    /*
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        myModal.hide();
                                    }, 10000);
                                    */
                                    break;

                                default:
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: 'Something Wrong !'
                                    });
                                    break;
                            }
                        }
                    });
                }
            });
            break;
        case '7':
            $("body").keypress(function (e) {

                if (e.key === '}') {
                    var debounceTimer2;

                    // Clear previous debounce timer
                    clearTimeout(debounceTimer2);

                    debounceTimer2 = setTimeout(function () {
                        $.ajax({
                            type: "GET",
                            url: "/requestSupervisor",
                            async: true,
                            data: {
                                _token: $("#csrf").val(),
                                id: id,
                                type: 1
                            },
                            success: function (data) {
                   
                                setTimeout(function () {
                                    $("#overlay").fadeOut(300);
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }, 1000); // Adjust the debounce time (in milliseconds) as needed

                }

            });

            if($('#EXCEPTION_STATUS').val() == '1'){
            function reloadWO() {
                $.ajax({
                    type: "GET",
                    url: "/reloadWO",
                    async: false,
                    global: false,
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                        type: 1
                    },
                    success: function (data) {
                        if (data.code == '1') {
                            switch (data.type) {

                              

                                case "error":
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    $('#qrcode').val('');

                                    $("#overlay").fadeOut(300, function () {
                                        return false;
                                    });
                                    break;

                                case "info":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        window.location.replace(data.url);
                                    }, 4000);
                                    break;

                                    
                           

                                case "success":
                               
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 4000);
                                    break;


                                default:
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: 'Something Wrong !'
                                    });

                                    $('#qrcode').val('');
                                    break;
                            }
                        }
                    }
                });
            }

               // Run the function every 5 seconds
               setInterval(reloadWO, 5000);
        }
        
         
            break;
        case '8':
            $("body").keypress(function (e) {

                if (e.key === '}') {
                    var debounceTimer2;

                    // Clear previous debounce timer
                    clearTimeout(debounceTimer2);

                    debounceTimer2 = setTimeout(function () {
                        $.ajax({
                            type: "GET",
                            url: "/requestSupervisor",
                            async: true,
                            data: {
                                _token: $("#csrf").val(),
                                id: id,
                                type: 2
                            },
                            success: function (data) {
                       
                                setTimeout(function () {
                                    $("#overlay").fadeOut(300);
                                    location.reload();
                                }, 2000);
                            }
                        });
                    }, 1000);

                }

            });

            function reloadWOS() {
                $.ajax({
                    type: "GET",
                    url: "/reloadWO",
                    async: false,
                    global: false,
                    data: {
                        _token: $("#csrf").val(),
                        id: id,
                        type: 2
                    },
                    success: function (data) {
                        if (data.code == '1') {
                            switch (data.type) {

                              

                                case "error":
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    $('#qrcode').val('');

                                    $("#overlay").fadeOut(300, function () {
                                        return false;
                                    });
                                    break;

                                case "info":
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });

                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        window.location.replace(data.url);
                                    }, 2000);
                                    break;

                                    
                           

                                case "success":
                               
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'success!',
                                        html: data.message,
                                        showConfirmButton: true
                                    });
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 2000);
                                    break;


                                default:
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Whoops!',
                                        html: 'Something Wrong !'
                                    });

                                    $('#qrcode').val('');
                                    break;
                            }
                        }
                    }
                });
            }
        
            // Run the function every 5 seconds
            setInterval(reloadWOS, 10000);
            break;

            case '9':
                $("body").keypress(function (e) {
    
                    if (e.key === '}') {
                        var debounceTimer3;
    
                        // Clear previous debounce timer
                        clearTimeout(debounceTimer3);
    
                        debounceTimer3 = setTimeout(function () {
                            $.ajax({
                                type: "GET",
                                url: "/requestSupervisor",
                                async: true,
                                data: {
                                    _token: $("#csrf").val(),
                                    id: id,
                                    type: 3
                                },
                                success: function (data) {
                    
                                    setTimeout(function () {
                                        $("#overlay").fadeOut(300);
                                        location.reload();
                                    }, 2000);
                                }
                            });
                        }, 1000);
    
                    }
    
                });
    
                function reloadWOSS() {
                    $.ajax({
                        type: "GET",
                        url: "/reloadWO",
                        async: false,
                        global: false,
                        data: {
                            _token: $("#csrf").val(),
                            id: id,
                            type: 3
                        },
                        success: function (data) {
                            if (data.code == '1') {
                                switch (data.type) {
    
                                  
    
                                    case "error":
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Whoops!',
                                            html: data.message,
                                            showConfirmButton: true
                                        });
    
                                        $('#qrcode').val('');
    
                                        $("#overlay").fadeOut(300, function () {
                                            return false;
                                        });
                                        break;
    
                                    case "info":
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'success!',
                                            html: data.message,
                                            showConfirmButton: true
                                        });
    
                                        setTimeout(function () {
                                            $("#overlay").fadeOut(300);
                                            window.location.replace(data.url);
                                        }, 4000);
                                        break;
    
                                        
                               
    
                                    case "success":
                                   
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'success!',
                                            html: data.message,
                                            showConfirmButton: true
                                        });
                                        setTimeout(function () {
                                            $("#overlay").fadeOut(300);
                                            location.reload();
                                        }, 4000);
                                        break;
    
    
                                    default:
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Whoops!',
                                            html: 'Something Wrong !'
                                        });
    
                                        $('#qrcode').val('');
                                        break;
                                }
                            }
                        }
                    });
                }
            
                // Run the function every 5 seconds
                setInterval(reloadWOSS, 5000);
                break;

        default:
            break;
    }

});


// COMMAS SPLIT
function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}



// LOADING WHEN AJAX RUNNING
jQuery(function ($) {
    $(document).ajaxSend(function () {
        $("#overlay").fadeIn(300);
    });
});


