@if($datas)
@foreach($datas as $data)
        @php 
            $boarding_points = json_decode($data->boarding_point);
            $dropping_points = json_decode($data->dropping_point);
            $booking_policies = json_decode($data->booking_policy);
            $amenities = json_decode($data->amenities);

            $driver_side = $data->driver_side;
            $last_row = $data->last_row;
            $right_row = $data->right_row;
            $right_column = $data->right_column;
            $left_row = $data->left_row;
            $left_column = $data->left_column;
            $id = $data->id;
        @endphp
        <div class="accordion" id="accordion_search">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_{{$data->id}}">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$data->id}}" 
                            aria-expanded="true" aria-controls="collapse_{{$data->id}}" onclick="loadSeat('<?= $id ?>','<?= $driver_side ?>', '<?= $last_row ?>');
                            loadMiddleSeat('<?= $right_row ?>','<?= $right_column ?>','<?= $left_row ?>', '<?= $left_column ?>','<?= $data->id ?>');">
                        <div class="row w-100">
                            <div class="col-md-3 text-dark fs-5 text-break">{{ $data->client_name }}</div>
                            <div class="col-md-3 text-dark fs-5 text-break">{{ $data->vehicle_type }}</div>
                            <div class="col-md-2 text-dark fs-5 text-break">{{ $data->departure_date }} <br> {{ date_format(date_create($data->departure_time), 'h:i A') }}</div>
                            <div class="col-md-2 text-dark fs-5 text-break">Rs. {{ $data->price }}</div>
                            <div class="col-md-2 text-dark fs-5 text-break">avaliable seats</div>
                        </div>
                    </button>
                </h2>
                <div id="collapse_{{$data->id}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$data->id}}" data-bs-parent="#accordion_search">
                    <div class="accordion-body">
                        <div class="row" id="details">
                            <div class="col-md-8">
                                <h4>{{ $data->from_name}} to {{ $data->to_name}}</h4>
                                <div class="row">
                                    <div class="col-md-5 form-group">
                                        <label for="seat_number">Seat Number</label>
                                        <input type="text" name="seat_number" id="seat_number" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="total_price">Total Price</label>
                                        <input type="text" name="total_price" id="total_price" class="form-control" readonly>
                                    </div>
                                </div>
                                @if(backpack_user())
                                    <button type="button" class="btn btn-md btn-primary mt-2">Continue Booking</button>
                                @else
                                    <span class="text-danger">Login first to proceed with the booking !!</span>
                                @endif

                                <div class="row mt-2">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#boarding_point_{{$data->id}}" aria-expanded="false" aria-controls="boarding_point_{{$data->id}}"><i class="la la-map-marker"></i> Boarding Point</button>
                                        <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#dropping_point_{{$data->id}}" aria-expanded="false" aria-controls="dropping_point_{{$data->id}}"><i class="la la-map-marker"></i> Dropping Point</button>
                                        <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#booking_policy_{{$data->id}}" aria-expanded="false" aria-controls="booking_policy_{{$data->id}}"><i class="la la-percentage"></i> Booking Policy</button>
                                        <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#amenities_{{$data->id}}" aria-expanded="false" aria-controls="amenities_{{$data->id}}"><i class="la la-clipboard-list"></i> Amenities</button>
                                    </div>
                                </div>

                                <!-- boarding point -->
                                <div class="collapse collapse_2 indent mt-2" id="boarding_point_{{$data->id}}">
                                    <h6>Boarding Points</h6>
                                    @if ($dropping_points[0]->point == '')
                                        No records found.
                                    @else
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Point</th>
                                                    <th>Time</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($boarding_points as $boarding_point)
                                                    <tr>
                                                        <td>{{ $boarding_point->point }}</td>
                                                        <td>{{ date_format(date_create($boarding_point->time), 'h:i A') }}</td>
                                                        <td>Rs. {{ $boarding_point->point_price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <!-- dropping point -->
                                <div class="collapse collapse_2 indent mt-2" id="dropping_point_{{$data->id}}">
                                    <h6>Dropping Points</h6>
                                    @if ($dropping_points[0]->point == '')
                                        No records found.
                                    @else
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Point</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dropping_points as $dropping_point)
                                                    <tr>
                                                        <td>{{ $dropping_point->point }}</td>
                                                        <td>Rs. {{ $dropping_point->point_price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <!-- booking policy -->
                                <div class="collapse collapse_2 indent mt-2" id="booking_policy_{{$data->id}}">
                                    <h6>Booking Policy</h6>
                                    @if ($booking_policies[0]->policy == '')
                                            No records found.
                                    @else
                                        <table class="table table-bordered text-break">
                                            <thead>
                                                <tr>
                                                    <th>Policy</th>
                                                    <th>Deduction</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($booking_policies as $booking_policy)
                                                    <tr>
                                                        <td>{{ $booking_policy->policy }}</td>
                                                        <td>{{ $booking_policy->deduction }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>

                                <!-- amenities -->
                                <div class="collapse collapse_2 indent text-break" id="amenities_{{$data->id}}">
                                    <h6>Amenities</h6>
                                    @if ($amenities[0]->name == '')
                                        No records found.
                                    @else
                                        @foreach($amenities as $amenitie)
                                            <tr>{{ $amenitie->name}}</tr>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                @if($data->vehicle_id == 2)
                                <div class="card border-success" style="max-width: 42%;">
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row bg-danger" id="driver_side_{{$data->id}}"></div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img src="{{ asset('images/driver.png') }}" alt="Driver" class="float-right bg-success" height="50px"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 m-2"></div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-5" style="align-self: end;">
                                                    <div class="row left bg-secondary"></div>
                                                </div>
                                                <div class="col-md-2"></div>
                                                <div class="col-md-5" style="align-self: end;">
                                                    <div class="row right bg-dark"></div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-between last_row bg-primary"></div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-danger text-center fs-2 font-weight-bold">No records can be found !!</div>
@endif
<style>
    .accordion-button::after{
        content: none;
    }
</style>

<script>
    $(document).ready(function () {
        $('.to_collapse').on('click',function(){
            $('.collapse_2').collapse('hide');
        });
        $('.accordion-button').on('click',function(){
            $('.collapse').collapse('hide');
        });
    });

    function loadSeat(id,driver_side,last_row){
        console.log(id, '-',driver_side, '-',last_row);
        for(let i = 1; i <= driver_side ; i++) {
            $('#driver_side_'+id).append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
        }
        // for(let i = 1; i <= last_row ; i++) {
        //     $('.last_row').append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
        // }
    }

    function loadMiddleSeat(right_row, right_column, left_row, left_column,id){
    }
</script>