@extends('master')
@section('title', 'Online Bookings')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title font-weight-bold">Search Doctor's Online Bookings</h4>
                    </div>
                </div>

                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Date</label>
                            <div class="cal-icon">
                                <input class="form-control floating" type="text" id="check_date">
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="doc" id="doc" value="{{$doctor->id}}">
                    <div class="col-sm-6 col-md-3">
                        <button class="btn btn-success btn-block" onclick="myat()">Search Booking List</button>
                    </div>
                </div>

                <div class="row" id="doc_info">
                    <div class="col-sm-4 col-3 text-center">
                        <h5 class="page-title font-weight-bold text-info">Total Booking Count</h5>
                        <span class="custom-badge  status-blue" id="book_count">{{$booking_count}}</span>
                    </div>
                    <div class="col-sm-4 col-3 text-center">
                        <h5 class="page-title font-weight-bold text-info">Total Check-In Count</h5>
                        <span class="custom-badge  status-blue" id="checkin_count">{{$chechincount}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="row" id="booking_list">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="card-body">
                        <div class="btn btn-primary float-right">Print</div>
                    
                        <select class="form-control col-3 form-control-sm" id="myselect">
                            <option value="6">All</option>
                            <option value="1">Comfirm</option>
                            <option value="4">Check-in</option>
                            <option value="0">Pending</option>
                            <option value="3">Revise</option>
                            <option value="2">Cancle</option>
                            <option value="5">Finish</option>
                        </select>
                        <div class="row">
                            <div class="col-sm-4 col-3">
                                <h4 class="page-title" id="title"></h4>
                            </div>
                        </div>

                        <div class="row">

                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Token Number</th>
                                        <th>Patient's Name</th>
                                        <th>Patient's Age</th>
                                        <th>Patient's Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">

                                    @php
                                    $j=1;
                                @endphp
                                @foreach ($manualbookings as $booking_list)
                                @php
                            $pendingbtn ='
                            <a class="btn btn-warning" title="Edit booking" onclick="editTown('."'$booking_list->id'".','."'$booking_list->name'".','."'$booking_list->age'".','."'$booking_list->phone'".','."'nodate'".')"><i class="fa fa-edit text-white"></i></a>
                            ';

                            $confirmbtn ='<a class="btn btn-warning" title="Edit booking" onclick="editTown('."'$booking_list->id'".','."'$booking_list->name'".','."'$booking_list->age'".','."'$booking_list->phone'".','."'nodate'".')"><i class="fa fa-edit text-white"></i></a>
                            <a style="padding:2px;" class="btn btn-info text-white doctor_book_done_btn" data-id='."$booking_list->id".' data-dateorno="nodate">Done</a>                                       
                                      ';
    
                             $revisebtn =
                             '<a class="btn btn-warning" title="Edit booking" onclick="editTown('."'$booking_list->id'".','."'$booking_list->name'".','."'$booking_list->age'".','."'$booking_list->phone'".','."'nodate'".')"><i class="fa fa-edit text-white"></i></a>';
                             $button ='<a class="btn btn-warning" title="Edit booking" onclick="editTown('."'$booking_list->id'".','."'$booking_list->name'".','."'$booking_list->age'".','."'$booking_list->phone'".','."'nodate'".')"><i class="fa fa-edit text-white"></i></a>';
    
                                @endphp
            
                                <tr>
                                    <td>{{$j++}}.</td>
                                    <td>{{$booking_list->token_number}}</td>
                                    <td>{{$booking_list->name}}</td>
                                    <td>{{$booking_list->age}}</td>
                                    <td>{{$booking_list->phone}}</td>
       
                                        <?php
                                            switch ($booking_list->status) {
                                                case '0':
                                                    echo '<td> Pending </td>';
                                                    echo "<td> $pendingbtn </td>";
                                                break;
                                                case '1':
                                                if ($booking_list->booking_status==2) {
                                                    echo '<td class="text-primary"> Reserved Booking </td>';
                                                    echo "<td> $confirmbtn </td>";
                                                }
                                                else {
                                                    echo '<td class="text-primary"> Confirmed </td>';
                                                    echo "<td> $confirmbtn </td>";
                                            
                                                }
                                                 
                                                break;
    
                                                case '2':
                                                echo '<td class="text-danger"> Cancled </td>';
                                                echo "<td> $button </td>";
    
                                                break; 
    
                                                case '3':
                                                echo '<td class="text-secondary"> Cancled </td>';
                                                echo "<td> $button </td>";
    
                                            
                                                break;
    
                                                case '4':
                                                echo '<td class="text-success"> Check-in </td>';
                                                echo "<td> $confirmbtn </td>";
    
                                                break;
    
                                                default:
                                                echo '<td class="text-bold"> Finished </td>';
                                                echo "<td> $button </td>";
                                                    break;
                                            }
                                        ?>
    
                                </tr>
                                 
                                @endforeach

                                </tbody>
                            </table>

                            <div id="edit_booking_record" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <h3>Edit Booking Info!</h3>
                                            <hr>
                                            <form action="{{ route('edit_booking_record') }}" method="POST">
                                                @csrf


                                                <div class="form-group">
                                                    <input type="hidden" name="booking_id" id="booking_id"></input>
                                                </div>

                                                <div class="form-group">
                                                    <label>Patient's Name</label>
                                                    <input class="form-control" type="text" name="name" id="booking_name">
                                                </div>

                                                <div class="form-group">
                                                    <label>Patient's Age</label>
                                                    <input class="form-control" type="text" name="age" id="booking_age">
                                                </div>

                                                <div class="form-group">
                                                    <label>Patient's Phone</label>
                                                    <input class="form-control" type="text" name="phone" id="booking_phone">
                                                </div>
                                                <input type="hidden" id="withdateOrnodate">


                                                <div class="m-t-20">
                                                    <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                                    <button type="submit" class="btn btn-primary" id="ajaxSubmitUpdate">Update Booking Info</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="done_booking_record" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <h3>Record Booking Info!</h3>
                                            <hr>
                                            <form method="POST" enctype="multipart/form-data" id="my_form">
                                            <div class="form-group">
                                                <input type="hidden" name="booking_id" id="done_booking_id"></input>
                                            </div>

                                            <div class="form-group">
                                                <label>Description</label>
                                                <input class="form-control" type="text" id="add_description">
                                            </div>

                                            <div class="form-group">
                                                <label>Diagnosis</label>
                                                <input class="form-control" type="text" id="diagnosis">
                                            </div>
                                            <div class="form-group">
                                                <label>Attach Document</label>
                                                <input class="form-control" type="file" id="patienthistory" name="patienthistory" multiple="">
                                            </div>
                                            <div class="form-group">
                                                <label>Remark Booking Date</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control" id="check_date2" name="remark_date">
                                                </div>
                                            </div>

                                            <input type="hidden" name="donedateOrnodate" id="donedateOrnodate">


                                            <div class="m-t-20">
                                                <a href="#" class="btn btn-danger ml-3" data-dismiss="modal">Close</a>
                                                <button type="submit" class="btn btn-primary" >Submit</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endsection

    @section('js')

        <script>
            $(document).ready(function() {
                $(".select2").select2();
                $("#check_date").datetimepicker({
                    format: 'YYYY-MM-DD'
                });

                $("#check_date2").datetimepicker({
                    format: 'YYYY-MM-DD'
                });


                // $('#booking_list').hide();

                // $('#doc_info').hide();
                //comfirm btn from admin bookinglist
                $("#table_body").on('click', '.book_comfirm_btn', function() {
                    let booking_id = $(this).data("id");

                    $.ajax({

                        type: 'POST',

                        url: 'AdminConfirmBooking',

                        data: {
                            "_token": "{{ csrf_token() }}",
                            "booking_id": booking_id,

                        },
                        success: function(data) {
                            if (data) {
                                console.log(data);
                                swal({
                                    title: "Success",
                                    text: "Successfully Changed!",
                                    icon: "info",
                                    timer: 10000,
                                });
                                $("#table_body").empty();
                                myat();
                            }
                        }
                    });
                });

                //Cancle btn from booking list
                $("#table_body").on('click', '.book_cancle_btn', function() {

                    swal({
                            title: "Are You Sure?",
                            icon: 'warning',
                            buttons: ["No", "Yes"]
                        })

                        .then((isConfirm) => {

                            if (isConfirm) {

                                let booking_id = $(this).data("id");

                                $.ajax({

                                    type: 'POST',

                                    url: 'AdminCancleBooking',

                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                        "booking_id": booking_id,

                                    },
                                    success: function(data) {
                                        if (data) {
                                            console.log(data);
                                            swal({
                                                title: "Success",
                                                text: "Successfully Changed!",
                                                icon: "info",
                                                timer: 3000,
                                            });
                                            $("#table_body").empty();
                                            myat();
                                        }
                                    }
                                });
                            }
                        });
                })


                //doctor_book_done_btn master
                //my_form master
            
                $("#ajaxSubmitUpdate").click(function(e) {
                    e.preventDefault();
                    let booking_id = $("#booking_id").val();
                    let name = $("#booking_name").val();
                    let age = $("#booking_age").val();
                    let phone = $("#booking_phone").val();

                    $.ajax({

                        type: 'POST',

                        url: '{{ route('edit_booking_record') }}',

                        data: {
                            "_token": "{{ csrf_token() }}",
                            "booking_id": booking_id,
                            "name": name,
                            "age": age,
                            "phone": phone,

                        },
                        success: function(data) {
                            if (data) {
                                swal({
                                    title: "Success",
                                    text: "Successfully Changed!",
                                    icon: "info",
                                    timer: 3000,
                                });
                                $('#edit_booking_record').modal('hide');

                                $("#table_body").empty();
                                myat();
                            }
                        }
                    });
                }); //ajaxsubmitupdate

                //option change to see
                $("#myselect").change(function() {
                    let status = $("#myselect option:selected").val();
                    $("#table_body").empty();
                    myat();
                });

                //checkall
                $('.checkall').click(function() {

                    $(".form-check-input").prop("checked", true);
                });
            }); //jquery end











            function qrSearch() {

                document.getElementById("qr_code").focus();

            }

            function QRcodeTest(value) {

                $.ajax({

                    type: 'POST',

                    url: 'AjaxTokenCheckIn',

                    data: {
                        "_token": "{{ csrf_token() }}",
                        "token_number": value,
                    },

                    success: function(data) {

                        $("#token_num").text(data.booking.token_number);
                        $("#name").text(data.booking.name);
                        $("#age").text(data.booking.age);
                        $("#phone").text(data.booking.phone);
                        $("#address").text(data.booking.address);

                        $("#token_info").modal('show');

                        $('#booking_list').show();

                        $("#qr_code").val("");

                        $.each(data.booking_lists, function(i, value) {

                            var status = value.status;

                            switch (status) {
                                case 1:
                                    $('#table_body').append($('<tr>')).append($('<td>').text(value
                                            .token_number)).append($('<td>').text(value.name)).append($(
                                            '<td>').text(value.age)).append($('<td>').text(value.phone))
                                        .append($('<td>').text("Confirm"));
                                    break;

                                case 2:
                                    $('#table_body').append($('<tr>')).append($('<td>').text(value
                                            .token_number)).append($('<td>').text(value.name)).append($(
                                            '<td>').text(value.age)).append($('<td>').text(value.phone))
                                        .append($('<td>').text("Cancel "));
                                    break;

                                case 3:
                                    $('#table_body').append($('<tr>')).append($('<td>').text(value
                                            .token_number)).append($('<td>').text(value.name)).append($(
                                            '<td>').text(value.age)).append($('<td>').text(value.phone))
                                        .append($('<td>').text("Revised "));
                                    break;

                                case 4:
                                    $('#table_body').append($('<tr>')).append($('<td>').text(value
                                            .token_number)).append($('<td>').text(value.name)).append($(
                                            '<td>').text(value.age)).append($('<td>').text(value.phone))
                                        .append($('<td>').text("Check-in "));
                                    break;

                                case 5:
                                    $('#table_body').append($('<tr>')).append($('<td>').text(value
                                            .token_number)).append($('<td>').text(value.name)).append($(
                                            '<td>').text(value.age)).append($('<td>').text(value.phone))
                                        .append($('<td>').text("Finished "));
                                    break;

                                default:
                                    $('#table_body').append($('<tr>')).append($('<td>').text(value
                                            .token_number)).append($('<td>').text(value.name)).append($(
                                            '<td>').text(value.age)).append($('<td>').text(value.phone))
                                        .append($('<td>').text("Pending"));
                            }
                        });
                    },
                });
            }


            function myat(action) {
              
            if (action=='nodate'){
            window.location.reload();
            }
            else{
                $("#table_body").empty();


                let status = $("#myselect option:selected").val();

                var doc_id = $('#doc').val();

                var check_date = $('#check_date').val();

                if ($.trim(doc_id) == '' || $.trim(check_date) == '') {
                    swal({
                        title: "Failed!",
                        text: "Please select Date Field!",
                        icon: "info",
                        timer: 3000,
                    });

                } else {

                    $.ajax({

                        type: 'POST',

                        url: '{{ route('ajax_doc_manual_bookings') }}',

                        data: {
                            "_token": "{{ csrf_token() }}",
                            "doctor_id": doc_id,
                            "check_date": check_date,
                            "status": status,
                        },

                        success: function(data) {
                            if (data.booking_count == 0) {
                                if (data.status == 0) {
                                    var addstatus = `Pending List`;
                                } else if (data.status == 1) {
                                    var addstatus = `Comfirm List`;
                                } else if (data.status == 2) {
                                    var addstatus = `Cancle List`;
                                } else if (data.status == 3) {
                                    var addstatus = `Revised List`;
                                } else if (data.status == 4) {
                                    var addstatus = `Check-in List`;
                                } else if (data.status == 5) {
                                    var addstatus = `Finished`;
                                } else {
                                    var addstatus = `Booking List`;
                                }

                                swal({
                                    title: "Nothing Found!",
                                    text: addstatus + " is empty for this day!",
                                    icon: "error",
                                    timer: 20000,
                                });

                            } else {

                                $('#booking_list').show();

                                $('#doc_info').show();

                                $('#book_count').text(data.booking_count);

                                $('#checkin_count').text(data.checkin_count);

                                $('#doc_name').text(data.doctor.name);

                                $('#doc_dept').text(data.doctor.department.name);

                                var j = 1;
                                $.each(data.booking_lists, function(i, value) {

                                    var status = value.status;

                                    let pendingbtn =
                                        `<a class="btn btn-warning" onclick="editTown('${value.id}','${value.name}','${value.age}','${value.phone}')"><i class="fa fa-edit text-white"></i></a>
                                                <a class="btn btn-success book_comfirm_btn" data-id="${value.id}"><i class="fa fa-check text-white"></i></i></a>
                                                <a class="btn btn-danger book_cancle_btn" data-id="${value.id}"><i class="fa fa-times text-white"></i></a>`;


                                    let confirmbtn = `<a class="btn btn-warning" onclick="editTown('${value.id}','${value.name}','${value.age}','${value.phone}')"><i class="fa fa-edit text-white"></i></a>
                            <a style="padding:2px;" class="btn btn-info text-white doctor_book_done_btn" data-id="${value.id}" data-dateorno="withdate">Done</a>
                            `;
                                    // doctor_book_done_btn
                                    let revisebtn =
                                        `<a class="btn btn-warning" onclick="editTown('${value.id}','${value.name}','${value.age}','${value.phone}')"><i class="fa fa-edit text-white"></i></a>`;
                                    let button =
                                        `<a class="btn btn-warning" onclick="editTown('${value.id}','${value.name}','${value.age}','${value.phone}')"><i class="fa fa-edit text-white"></i></a>`;

                                    switch (status) {

                                        case 1:
                                         if(value.booking_status==2){
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number))
                                                .append($('<td>').text(value.name)).append($('<td>').text(value.age)).append($('<td>').text(value.phone)).append($('<td class="text-primary">').text("Reserved Booking ")).append($('<td>').html(confirmbtn));
                                         }
                                         else{
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number))
                                                .append($('<td>').text(value.name)).append($('<td>').text(value.age)).append($('<td>').text(value.phone)).append($('<td class="text-primary">').text("Comfirmed")).append($('<td>').html(confirmbtn));
                                         }
                                            break;

                                        case 2:
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number))
                                                .append($('<td>').text(value.name)).append($('<td>').text(value.age)).append($('<td>').text(value.phone)).append($('<td class="text-danger">').text("Cancel ")).append($('<td>').html(button));
                                            break;

                                        case 3:
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number)).append($('<td>').text(value.name)).append($('<td>').text(value.age)).append($('<td>').text(value.phone))
                                                .append($('<td class="text-secondary">').text("Revised ")).append($('<td>').html(button));
                                            break;

                                        case 4:
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number)).append($('<td>').text(value.name)).append($('<td>').text(value.age)).append($('<td>').text(value.phone))
                                                .append($('<td class="text-success">').text("Check-in ")).append($('<td>').html(confirmbtn));
                                            break;

                                        case 5:
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number)).append($('<td>').text(value.name)).append($('<td>').text(value.age)).append($('<td>').text(value.phone))
                                                .append($('<td>').text("Finished "))
                                                .append($('<td>').html(button));
                                            break;

                                        default:
                                            $('#table_body').append($('<tr>'))
                                                .append($('<td>').text(j))
                                                .append($('<td>').text(value.token_number))
                                                .append($('<td>').text(value.name)).append($('<td>')
                                                    .text(value.age)).append($('<td>').text(value.phone)).append($('<td class="text-warning">').text("Pending"))
                                                .append($('<td>').html(pendingbtn));
                                    }

                                    j++;
                                });

                            }

                        },
                    });


                }

            }
            }
            
        </script>


    @endsection
