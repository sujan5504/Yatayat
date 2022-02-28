@extends('layouts.layout')

@section('title')
    Booking
@endsection

@section('content')
    @php 
        $boarding_points = json_decode($data['boarding_point']);
        $dropping_points = json_decode($data['dropping_point']);

        $total_seat = $data['total_seat'];

        $seat = explode(' ',$data['seat_number']);
        $total_seat = count($seat);
    @endphp
    
    <div class="container mt-3 mb-3">
        <div class="card">
            <div class="card-header text-center">
                <h3>Details</h3>
            </div>
           <div class="card-body row">
                <div class="col-md-8 mb-3">
                    <h4>Passenger Details</h4>
                    <div class="row" style="line-height:40px">
                        <div class="col-md-6 form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ $data['name'] }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="contact">Contact <span class="text-danger">*</span></label>
                            <input type="contact" name="contact" id="contact" value="{{ $data['contact'] }}" class="form-control" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="email">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" value="{{ $data['email'] }}" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="boarding_point">Boarding Point</label>
                            <select class="form-control searchselect" name="boarding_point" id="boarding_point" onchange="changeBoardingPoint()">
                                @foreach($boarding_points as $bp)
                                    <option class="form-control" value="{{ $bp->point }} - {{date_format(date_create($bp->time), 'h:i A')}}">
                                        {{ $bp->point }} - {{date_format(date_create($bp->time), 'h:i A')}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dropping_point">Dropping Point</label>
                            <select class="form-control searchselect" name="dropping_point" id="dropping_point" onchange="changeDroppingPoint()">
                                @foreach($dropping_points as $dp)
                                    <option class="form-control" value="{{ $dp->point }} - {{ $dp->point_price }}">
                                        {{ $dp->point }} - Rs. {{ $dp->point_price }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-md btn-success mt-2" data-bs-toggle="modal" data-bs-target="#seatConfirmationModel"
                        data-bs-whatever="@mdo"> Proceed For Conformation</button>
                </div>

                <div class="modal fade" id="seatConfirmationModel" tabindex="-1" aria-labelledby="seatConfimration" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="seatConfimration">Confirm Your Details</h5>
                                    <i class=" btn-close fa fa-times-circle fa-2x" data-bs-dismiss="modal" type="button" aria-hidden="true"></i>
                                </div>
                                <div class="modal-body" style="line-height:40px">
                                    <div class="row">
                                        <h6 class="text-primary">Passenger Details</h6>
                                        <div class="col-md-3 form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="user_name" value="{{ $data['name'] }}" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="contact">Contact</label>
                                            <input type="contact" name="contact" id="user_contact" value="{{ $data['contact'] }}" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="user_email" value="{{ $data['email'] }}" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                            <h6 class="text-primary">Travel Details</h6>
                                            <div class="col-md-4 form-group">
                                                <label for="client_id">Travels</label>
                                                <input type="text" name="client_id" id="client_id" value="{{ $data['client_name']['name'] }}" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="route">Source(From) to Destination(To)</label>
                                                <input type="text" name="route" id="route" value="{{ $data['from'] }} - {{ $data['to'] }}" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="date">Date</label>
                                                <input type="text" name="date" id="seat_date" value="{{ $data['date'] }}" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-2 form-group">
                                                <label for="time">Time</label>
                                                <input type="text" name="time" id="departure_time" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="boarding_point">Boarding Point</label>
                                                <input type="text" name="boarding_point" id="vehicle_boarding_point" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="dropping_point">Droppint Point</label>
                                                <input type="text" name="dropping_point" id="vehicle_dropping_point" class="form-control" readonly>
                                            </div>
                                    </div>
                                    <div class="row mt-3">
                                            <h6 class="text-primary">Seat & Cost Details</h6>
                                            <div class="col-md-4 form-group">
                                                <label for="seat">Seat</label>
                                                <input type="text" name="seat" value="{{ $data['seat_number'] }}" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-4 form-group">
                                                <label for="total_cost">Total Cost</label>
                                                <input type="text" name="total_cost" id="total_seat_cost" class="form-control" readonly>
                                            </div>
                                    </div>
                                    <button class="btn btn-md btn-success mt-2" onclick="saveBookingDetails()">Proceed To Payment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-4 p-2" style="background-color:#dee2e6; border-radius:5px">
                    <div>
                        <h4>Travel Details</h4>
                        <div>
                            <strong>Travels:</strong>
                            <span id="client_name">
                                {{ $data['client_name']['name'] }} 
                            </span>
                        </div>
                        <div>
                            <strong>Route:</strong> 
                            <span id="from-to">
                                {{ $data['from'] }} - {{ $data['to'] }}
                            </span>
                        </div>
                        <div>
                            <strong>Date & Time:</strong>
                            <span id="date">
                                {{ $data['date'] }}
                            </span> / 
                            <span id="time"></span>
                        </div>
                        <div>
                            <strong>Boarding Point:</strong>
                            <span id="boarding-point"></span>
                        </div>
                        <div>
                            <strong>Dropping Point:</strong>
                            <span id="droppint-point"></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Seat Details</h4>
                        <div>
                            <strong>Seat:</strong>
                            <span id="seat">{{ $data['seat_number'] }}</span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h4>Payment Details</h4>
                        <div>
                            <strong>Per Ticket Cost:</strong>
                            <span id="per-ticket-cost"></span>
                        </div>
                        <div>
                            <strong>Total Cost:</strong>
                            <span id="total-cost"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        label{
            font-weight: bold;
        }
    </style>
@endsection

@section('after_script')
    <script>
        let total_seat = 0;
        $(document).ready(function () {
            $('.searchselect').select2();

            boarding_point = $('#boarding_point').val();
            boarding_point = boarding_point.split('-');
            $('#time').text(boarding_point[1]);
            $('#departure_time').val(boarding_point[1]);
            $('#boarding-point').text(boarding_point[0]);
            $('#vehicle_boarding_point').val(boarding_point[0]);

            dropping_point = $('#dropping_point').val();
            dropping_point = dropping_point.split('-');
            $('#droppint-point').text(dropping_point[0]);
            $('#vehicle_dropping_point').val(dropping_point[0]);
            $('#per-ticket-cost').text('Rs. '+dropping_point[1]);

            total_seat = "<?= $total_seat ?>";
            total_price = total_seat * dropping_point[1];
            $('#total-cost').text('Rs. '+total_price);
            $('#total_seat_cost').val(total_price);

            $('#name, #contact, #email').on('keyup paste', function(){
                $("#user_name").val($('#name').val());
                $("#user_contact").val($('#contact').val());
                $("#user_email").val($('#email').val());
            });
        });

        function changeBoardingPoint(){
            boarding_point = $('#boarding_point').val();
            boarding_point = boarding_point.split('-');
            $('#time').text(boarding_point[1]);
            $('#departure_time').val(boarding_point[1]);
            $('#boarding-point').text(boarding_point[0]);
            $('#vehicle_boarding_point').val(boarding_point[0]);

        }

        function changeDroppingPoint(){
            dropping_point = $('#dropping_point').val();
            dropping_point = dropping_point.split('-');
            $('#droppint-point').text(dropping_point[0]);
            $('#vehicle_dropping_point').val(dropping_point[0]);
            $('#per-ticket-cost').text('Rs. '+dropping_point[1]);
            total_price = total_seat * dropping_point[1];
            $('#total-cost').text('Rs. '+total_price);
            $('#total_seat_cost').val(total_price);
        }

        function saveBookingDetails(){
            let data = {
                _token : $("meta[name='csrf-token']").attr("content"),
                user_id : <?= $data['user_id'] ?>,
                client_id : <?= $data['client_id'] ?>,
                vehicles_assign_id : <?= $data['vehicles_assign_id'] ?>,  
                seat : "<?= $data['seat_number'] ?>",
                boarding_point : $('#vehicle_boarding_point').val(),
                droppint_point: $('#vehicle_dropping_point').val(),
                cost : $('#total_seat_cost').val(),
                date : $('#seat_date').val(),
                ticket_number : getRandomString(),
                time : $('#departure_time').val(),
                name : $('#user_name').val(),
                contact : $('#user_contact').val(),
                email : $('#user_email').val(),
            };

            $.ajax({
                type:"post",
                url: 'savebooking',
                data: data,
                success:function(response) {}
            });
        }

        function getRandomString() {
            var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var random_string = '';
            for ( var i = 0; i < 6; i++ ) {
                random_string += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
            }
            return random_string;
        }
    </script>
@endsection