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
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
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
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Passenger</th>
                                            <th scope="col">Vechile</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Seat</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach($bookdata as $bookval)

                                        <tr>
                                            
                                            <td><?php  ?></td>
                                            <td><?php  ?></td>
                                            <td><?php  ?></td>


                                            <td></td>
                                            <td></td>
                                            <td>{{$bookval->seat}}</td>
                                            <td>
                                                <p class=" font-weight-bold text-success">BOOKED</p>
                                            </td>
                                            <td><?php
                                                date_default_timezone_set('Asia/Kathmandu');
                                                $ab = strtotime($bookval->created_at);

                                                if ($date_time > $ab) {
                                                ?>
                                                    <button class=" btn btn-danger btn-sm" disabled data-toggle="tool-tip" id="cancle" title="Cancle">Cancle</button></a>


                                                <?php } else {
                                                ?>
                                                    <a onclick="return confirm('Are you sure to cancle your booking?')" href="cancle/{{$bookval->seat}}">
                                                        <button class=" btn btn-danger btn-sm" data-toggle="tool-tip" id="cancle" title="Cancle" value="{{$bookval->seat}}">Cancle</button></a>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody> --}} 
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
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Passenger</th>
                                            <th scope="col">Vechile</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Seat</th>
                                            <th scope="col">Status</th>

                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach($bookingcancle as $canclled)
                                        <tr>
                                            <td><?php  ?></td>
                                            <td><?php  ?></td>
                                            <td><?php  ?></td>
                                            <td><?php  ?></td>
                                            <td><?php  ?></td>
                                            <td> {{$canclled->seat}}</td>
                                            <td>
                                                <p class=" font-weight-bold text-info">Cancelled</p>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tody> --}}
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
        });
    </script>
@endsection