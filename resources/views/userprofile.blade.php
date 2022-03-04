@extends('layouts.layout')

@section('title')
    UserProfile
@endsection

@section('content')
    <div class="container rounded mt-5 mb-5">
        <div class="card" style="background-color:#f8f9fa;">
            <div class="card-head m-3">
                <a href="javascript:;"><i class="la la-bus la-3x" style="color: #007bff;"></i></a>
                <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    data-bs-whatever="@mdo" style="float:right"><i class="la la-user"></i> Update Profile</button>

                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="modal-title" id="exampleModalLabel" style="color:chocolate;">PROFILE SETTING</h2>
                                    <i class=" btn-close fa fa-times-circle fa-2x" data-bs-dismiss="modal" type="button" aria-hidden="true"></i>
                                </div>
                                <div class="modal-body" style="line-height:40px">
                                    <h7><label for="inputlg" class="text-danger p-0">Leave as it is to use existing detail</label></h7>
                                    <form  action="{{ route('userprofile.update',$userdata->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input class="form-control input-lg" id="name" type="text" name="name" value="{{$userdata->name}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="contact">Contact</label>
                                                        <input class="form-control input-lg" id="contact" type="text" name="contact" value="{{$userdata->contact}}" required>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="age">Age</label>
                                                    <div class="form-label-group">
                                                        <input type="number" class="form-control" name="age" id="age" value="{{$userdata->age}}" required="required" pattern="^[A-Za-z]{2,25}">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select class="form-control searchselect" name="gender_id" id="gender">
                                                        <option disabled selected value="" style="font-weight:bold;">Gender</option>
                                                        @foreach($genders as $gender)
                                                            <option class="form-control" value="{{ $gender->id }}">{{ $gender->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Postal Code">District</label>
                                                        <input class="form-control input-lg" id="district" type="text" name="district" value="{{$userdata->district}}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="address">City</label>
                                                        <input class="form-control input-lg" id="city" type="text" name="city" value="{{$userdata->city}}" required>
                                                    </div>
                                                </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="email">Email address</label>
                                                    <input class="form-control input-lg" id="inputlg" type="text" name="email" value="{{$userdata->email}}" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input class="form-control input-lg" id="password" type="password" name="password" value="{{ $userdata->password }}" class="readonly">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password">Confirm Password</label>
                                                    <input class="form-control input-lg" id="confirm_password" type="password" name="confirm_password">
                                                    <div id="CheckPasswordMatch"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="updateinfo" class="text-danger text-center">Confirm Password to save changes!!</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" type="submit" id="updateuser"> Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-body m-3 py-5" style="background-color: #eee;">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                @if($userdata->gender_id == '2')
                                    <img src="{{ asset('images/female.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                @else
                                    <img src="{{ asset('images/male.jpg') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                @endif
                                <h5 class="my-3">{{$userdata->name}}</h5>
                                <p class="text-muted mb-1">{{$userdata->email}}</p>
                                <p class="text-muted mb-4">{{$userdata->district}}, {{$userdata->city}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Full Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$userdata->name}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$userdata->email}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Contact</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$userdata->contact}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Gender</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$user_gender}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Age</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$userdata->age}}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{$userdata->district}}, {{$userdata->city}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-center">Booked</h4>
                        </div>
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body" id="booking-details">
                                <table class="table table-bordered" id="bookings-details-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Travels</th>
                                            <th scope="col">Ticket No.</th>
                                            <th scope="col">Vechile</th>
                                            <th scope="col">From <br> To</th>
                                            <th scope="col">Boarding Point <br> Dropping Point</th>
                                            <th scope="col">Date</th>
                                            <th scope="col" style="width: 133.906px;">Seat</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($booking_details as $detail)
                                                @if($detail->status == 0)
                                                    <tr>
                                                        <td>{{ $detail->client_name }}</td>
                                                        <td>{{ $detail->ticket_number }}</td>
                                                        <td>{{ $detail->vehicle_name }}</td>
                                                        <td>{{ $detail->from_name }} <br> {{ $detail->to_name }}</td>
                                                        <td>{{ $detail->boarding_point }} <br> {{ $detail->dropping_point }}</td>
                                                        <td>{{ $detail->date }}</td>
                                                        <td>{{ $detail->seat }}</td>
                                                        <td>{{ $detail->price }}</td>
                                                        @if($detail->booked_difference == 1)
                                                            <td></td>
                                                        @else
                                                            <td><button class="btn btn-sm btn-danger" onclick="cancelTicket('<?= $detail->id?>')"><i class="la la-times"></i> Cancel</button></td>
                                                        @endif
                                                    </tr>
                                                @endif
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-center">Booking Cancelled</h4>
                        </div>
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body" id="booking-cancel">
                                <table class="table table-bordered" id="booking-cancel-details">
                                    <thead>
                                        <tr>
                                            <th scope="col">Travels</th>
                                            <th scope="col">Ticket No.</th>
                                            <th scope="col">Vechile</th>
                                            <th scope="col">From <br> To</th>
                                            <th scope="col">Boarding Point <br> Dropping Point</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Seat</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($booking_details as $detail)
                                            @if($detail->status == 1)
                                                <tr>
                                                    <td>{{ $detail->client_name }}</td>
                                                    <td>{{ $detail->ticket_number }}</td>
                                                    <td>{{ $detail->vehicle_name }}</td>
                                                    <td>{{ $detail->from_name }} <br> {{ $detail->to_name }}</td>
                                                    <td>{{ $detail->boarding_point }} <br> {{ $detail->dropping_point }}</td>
                                                    <td>{{ $detail->date }}</td>
                                                    <td>{{ $detail->seat }}</td>
                                                    <td>{{ $detail->price }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card{
            border:solid 3px white;
            border-radius: 10px;
        }
    </style>
@endsection
@section('after_script')
    <script>    
        $(document).ready(function() {
            val = "<?php echo $userdata->gender_id ?>";
            $('#gender').val(val);
            $('#gender').trigger('change');

            $('#updateuser').attr('disabled',true);
            $("#confirm_password").on('keyup', function() {
                var password = $("#password").val();
                var confirmPassword = $("#confirm_password").val();
                if (password != confirmPassword){
                    $("#CheckPasswordMatch").html("Password does not match !").css("color", "red");
                }
                else{
                    $('#updateuser').attr('disabled',false);
                    $('#updateinfo').hide();
                    $("#CheckPasswordMatch").html("Password match !").css("color", "green");
                }
            });

            $('#bookings-details-table, #booking-cancel-details').DataTable({
				dom: '<"top"fi>rt<"bottom"pl>',
				searching: true,
				paging: true,
				ordering:false,
				select: false,
				bInfo : true,
				lengthChange: true,
				lengthMenu: [
					[ 5, 10, 25, 50, 100, -1 ],
					[ '5', '10', '25', '50', '100', 'All' ]
				],
            });
        });

        function cancelTicket(id){
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to cancel your ticket?",
                icon: "warning",
                buttons: true,
                closeOnClickOutside : true,
            }).then((willDelete) => {
                if (willDelete) {
                    let data = {
                        _token : $("meta[name='csrf-token']").attr("content"),
                        id : id,
                    };
                    
                    $.ajax({
                        type: 'get',
                        url: '{{ route("bookingcancel") }}',
                        data: data,
                        success:function(response) {
                            if(response == 1){ 
                                swal({
                                    title: 'Success',
                                    text: 'Your ticket has been cancelled.',
                                    icon: "success",
                                    button: false,
                                    closeOnClickOutside : true,
                                });
                                setTimeout(location.reload.bind(location), 2000);
                            }else{
                                swal({
                                    title: 'Error',
                                    text: 'Ther was some problem. Please try again!!',
                                    icon: "error",
                                });
                            }
                        },
                    });
                }
            });
        }
    </script>
@endsection