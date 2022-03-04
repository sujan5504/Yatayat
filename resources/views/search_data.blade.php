@if($datas != [])
    @foreach($datas as $data)
        @php 
            $booking_policies = json_decode($data->booking_policy);
            $amenities = json_decode($data->amenities);

            $driver_side = $data->driver_side;
            $last_row = $data->last_row;
            $right_row = $data->right_row;
            $right_column = $data->right_column;
            $left_row = $data->left_row;
            $left_column = $data->left_column;
            $id = $data->id;
            $user_id = backpack_user() != null ? backpack_user()->id : null;

            $total_seat = $data->total_no_of_seat;
            $seat = explode(' ', $data->seat);
            $count = count($seat);
            $avaliable_seat = $total_seat - $count;
        @endphp
        
        <div class="accordion" id="accordion_search">
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_{{$data->id}}">
                    @if($data->vehicle_id == 2)
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$data->id}}" 
                            aria-expanded="true" aria-controls="collapse_{{$data->id}}" onclick="clearSeat('<?= $id ?>');
                            loadSeat('<?= $id ?>','<?= $driver_side ?>', '<?= $last_row ?>','<?= $right_row ?>',
                                '<?= $right_column ?>','<?= $left_row ?>', '<?= $left_column ?>','<?= $data->price ?>','<?= $data->seat ?>');">
                    @elseif($data->vehicle_id == 4)
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$data->id}}" 
                            aria-expanded="true" aria-controls="collapse_{{$data->id}}" onclick="bookedSeat('<?= $id ?>','<?= $data->seat ?>')">
                    @endif
                    
                        <div class="row w-100">
                            <div class="col-md-3 text-dark fs-5 text-break">{{ $data->client_name }}</div>
                            <div class="col-md-3 text-dark fs-5 text-break">{{ $data->vehicle_type }}</div>
                            <div class="col-md-2 text-dark fs-5 text-break">{{ $data->departure_date }} <br> {{ date_format(date_create($data->departure_time), 'h:i A') }}</div>
                            <div class="col-md-2 text-dark fs-5 text-break">Rs. {{ $data->price }}</div>
                            <div class="col-md-2 text-dark fs-5 text-break">{{ $avaliable_seat }}</div>
                        </div>
                    </button>
                </h2>
                <div id="collapse_{{$data->id}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$data->id}}" data-bs-parent="#accordion_search">
                    <div class="accordion-body">
                        <div class="row" id="details">
                            <div class="col-md-8">
                                <h4>{{ $data->from_name}} to {{ $data->to_name}}</h4>
                                
                                <form action="{{ url('bookseat') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                                    <input type="hidden" name="total_seat" id="total_seat">
                                    <input type="hidden" name="client_id" value="{{ $data->client_id }}">
                                    <input type="hidden" name="vehicles_assign_id" value="{{ $data->id }}">
                                    <div class="row">
                                        <div class="col-md-5 form-group">
                                            <label for="seat_number">Seat Number <span class="text-danger">*</span></label>
                                            <input type="text" name="seat_number" id="seat_number_{{$data->id}}" class="form-control" readonly required>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <label for="total_price">Total Price <span class="text-danger">*</span></label>
                                            <input type="text" name="total_price" id="total_price_{{$data->id}}" class="form-control" readonly required>
                                        </div>
                                    </div>
                                    @if(backpack_user())
                                        <button type="submit" class="btn btn-md btn-primary mt-2" id="continue_booking_btn_{{$data->id}}">Continue Booking</button>
                                    @else
                                        <span class="text-danger">Login first to proceed with the booking !!</span>
                                    @endif
                                </form>

                                <div class="row mt-2">
                                    <div class="col">
                                        <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#booking_policy_{{$data->id}}" aria-expanded="false" aria-controls="booking_policy_{{$data->id}}"><i class="la la-percentage"></i> Booking Policy</button>
                                        <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#amenities_{{$data->id}}" aria-expanded="false" aria-controls="amenities_{{$data->id}}"><i class="la la-clipboard-list"></i> Amenities</button>
                                        &nbsp;
                                        <img src="{{ asset('images/avaliable.png') }}" alt="Avaliable"> Avaliable &nbsp;
                                        <img src="{{ asset('images/selected.png') }}" alt="Avaliable"> Selected &nbsp; 
                                        <img src="{{ asset('images/booked.png') }}" alt="Avaliable"> Booked &nbsp; 
                                    </div>
                                </div>

                                <!-- booking policy -->
                                <div class="collapse collapse_2 mt-2" id="booking_policy_{{$data->id}}">
                                    <h6>Booking Policy</h6>
                                    @if($booking_policies != null)
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
                                    @else
                                        No records found.
                                    @endif
                                </div>

                                <!-- amenities -->
                                <div class="collapse collapse_2 text-break" id="amenities_{{$data->id}}">
                                    <h6>Amenities</h6>
                                    @if($amenities != null)
                                        @if ($amenities[0]->name == '')
                                            No records found.
                                        @else
                                            @foreach($amenities as $amenitie)
                                                <tr>{{ $amenitie->name}}</tr>
                                            @endforeach
                                        @endif
                                    @else
                                        No records found.
                                    @endif
                                </div>
                            </div>
                            @if($data->vehicle_id == 2)
                                <div class="col-md-4 card-seats">
                                    <div class="card border-success mt-1 p-1" id="seat-card">
                                        <div class="w-100 d-flex">
                                            <div class="w-50" id="driver_side_{{$data->id}}"></div>
                                            <div class="w-50">
                                                <img src="{{ asset('images/driver.png') }}" alt="Driver" class="driver-image" height="50px"> 
                                            </div>
                                        </div>
                                        <div class="m-3"></div>
                                        <div class="d-flex">
                                            <div style="align-self: end;">
                                                <div id="left_{{$data->id}}"></div>
                                            </div>
                                            <div>
                                                <div class="text-white">asdf</div>
                                            </div>
                                            <div style="align-self: end;">
                                                <div id="right_{{$data->id}}"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <div id="last_row_{{$data->id}}"></div>
                                        </div>
                                    </div>
                                </div>
                            @elseif($data->vehicle_id == 4)
                                <div class="col-md-4">
                                    <div class="card border-success mt-1 p-1" style="width: 177px;">
                                        <div class="w-100 d-flex">
                                            <div class="w-50" id="hiace_driver_side_{{$data->id}}">
                                                <div class="col">
                                                    <div class="d-inline seat-pointer" id="seat_{{$data->id}}_A01" data-value="A01" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_A01" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">A01</span></div>
                                                    <div class="d-inline seat-pointer" id="seat_{{$data->id}}_A02" data-value="A02" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_A02" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">A02</span></div>
                                                </div>
                                            </div>
                                            <div class="w-50">
                                                <img src="{{ asset('images/driver.png') }}" alt="Driver" class="driver-image" height="50px"> 
                                            </div>
                                        </div>
                                        <div class="m-3"></div>
                                        <div class="col">
                                            <div style="padding-left:42px" class="d-inline seat-pointer" id="seat_{{$data->id}}_B01" data-value="B01" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B01" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B01</span></div>
                                            <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B02" data-value="B02" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B02" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B02</span></div>
                                            <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B03" data-value="B03" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B03" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B03</span></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="row">
                                                <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B04" data-value="B04" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B04" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B04</span></div>
                                                        <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B07" data-value="B07" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B07" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B07</span></div>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col" style="margin-left: 21px;">
                                                        <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B05" data-value="B05" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B05" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B05</span></div>
                                                        <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B06" data-value="B06" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B06" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B06</span></div>
                                                    </div>
                                                    <div class="col" style="margin-left: 21px;">
                                                        <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B08" data-value="B08" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B08" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B08</span></div>
                                                        <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B09" data-value="B09" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B09" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B09</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <div id="hiace_last_row_{{$data->id}}">
                                                <div class="col">
                                                    <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B10" data-value="B10" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B10" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B10</span></div>
                                                    <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B11" data-value="B11" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B11" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B11</span></div>
                                                    <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B12" data-value="B12" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B12" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B12</span></div>
                                                    <div class="d-inline seat-pointer" id="seat_{{$data->id}}_B13" data-value="B13" onclick="changeImage(this,'<?= $data->id ?>','<?= $data->price ?>')"><img id="img_seat_{{$data->id}}_B13" src="{{ asset('images/avaliable.png') }}"/><span class="seat-no">B13</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
    label{
        font-weight: bold;
    }
    .accordion-button::after{
        content: none;
    }
    .driver-image{
        float: right;
    }
    @media only screen and (max-width: 400px) {
        #seat-card {
            max-width: 66% !important;
            transform: rotate(0deg) !important;
        }
        .card-seats{
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }
    }
    .card-seats{
        margin-top: -150px;
        margin-bottom: -154px;
    }
    #seat-card{
        max-width:54%;
        transform: rotate(270deg);
    }
    .seat-pointer{
        cursor: pointer;
    }
    .seat-no{
        cursor: pointer;
        margin-left: -31px;
        font-size: 13px;
        margin-right: 8px;
        color:white;
        font-weight: bold;
    }
    .collapse_2{
        width: 55%;
    }
</style>

<script>
    let selected_seat = '';
    let seat_count = 0;
    let seat_price = 0;

    $(document).ready(function () {
        $('.to_collapse').on('click',function(){
            $('.collapse_2').collapse('hide');
        });
        $('.accordion-button').on('click',function(){
            $('.collapse').collapse('hide');
        });
    });

    function clearSeat(id){
        $('#continue_booking_btn_'+id).attr('disabled',true);
        selected_seat = '';
        seat_count = 0;
        seat_price = 0;
        $('#driver_side_'+id).empty();
        $('#last_row_'+id).empty();
        $('#left_'+id).empty();
        $('#right_'+id).empty();
    }

    function loadSeat(id, driver_side, last_row, right_row, right_column, left_row, left_column, price,seat){
        for(let i = 1; i <= driver_side ; i++) {
            seat_value = 'A0'+i;
            $('#driver_side_'+id).append('<div class="d-inline seat-pointer" id="seat_'+id+'_'+seat_value+'" data-value="'+seat_value+'" onclick="changeImage(this,'+id+','+price+')"><img id="img_seat_'+id+'_'+seat_value+'" src="{{ asset("images/avaliable.png") }}"/><span class="seat-no">'+seat_value+'</span></div>');
        }

        left = left_row * left_column;
        for(let i = 1; i <= left ; i++) {
            if(i <= 9){
                seat_value = 'B0' + i;
            }else{
                seat_value = 'B'+i;
            }
            $('#left_'+id).append('<div class="d-inline seat-pointer" id="seat_'+id+'_'+seat_value+'" data-value="'+seat_value+'" onclick="changeImage(this,'+id+','+price+')"><img id="img_seat_'+id+'_'+seat_value+'" src="{{ asset("images/avaliable.png") }}"/><span class="seat-no">'+seat_value+'</span></div>');
        }

        right = right_row * right_column;
        for(let i = 1; i <= right ; i++) {
            if(i <= 9){
                seat_value = 'C0' + i;
            }else{
                seat_value = 'C'+i;
            }
            $('#right_'+id).append('<div class="d-inline seat-pointer" id="seat_'+id+'_'+seat_value+'" data-value="'+seat_value+'" onclick="changeImage(this,'+id+','+price+')"><img id="img_seat_'+id+'_'+seat_value+'" src="{{ asset("images/avaliable.png") }}"/><span class="seat-no">'+seat_value+'</span></div>');
        }

        for(let i = 1; i <= last_row ; i++) {
            if(i <= 9){
                seat_value = 'D0' + i;
            }else{
                seat_value = 'D'+i;
            }
            $('#last_row_'+id).append('<div class="d-inline seat-pointer" id="seat_'+id+'_'+seat_value+'" data-value="'+seat_value+'" onclick="changeImage(this,'+id+','+price+')"><img id="img_seat_'+id+'_'+seat_value+'" src="{{ asset("images/avaliable.png") }}"/><span class="seat-no">'+seat_value+'</span></div>');
        }

        seats = seat.split(' ');
        $.each( seats, function( index, value ){
            $("#img_seat_"+id+"_"+value).attr("src", "{{asset('images/booked.png')}}");
        });
        
    }

    function bookedSeat(id,seat){
        seats = seat.split(' ');
        $.each( seats, function( index, value ){
            $("#img_seat_"+id+"_"+value).attr("src", "{{asset('images/booked.png')}}");
        });
    }

    function changeImage(item, id, price){
        var item_id = $(item).attr("id");
        var image_src = $('#img_'+item_id).attr('src');
        var dropping_point = $('#dropping_point_'+id).val();
        var value = $(item).attr("data-value");

        if(image_src == "{{asset('images/avaliable.png')}}"){
            seat_count = seat_count + 1;
            $('#img_'+item_id).attr("src", "{{asset('images/selected.png')}}");

            selected_seat = selected_seat + ' ' + value;
            $('#seat_number_'+id).val(selected_seat);

            seat_price = seat_count * price;
            $('#total_price_'+id).val(seat_price);
            $('#total_seat').val(seat_count);
        }

        if(image_src == "{{asset('images/selected.png')}}"){
            seat_count = seat_count - 1;
            $('#img_'+item_id).attr("src", "{{asset('images/avaliable.png')}}");

            selected_seat = $('#seat_number_'+id).val().replace(' '+value, '');
            $('#seat_number_'+id).val(selected_seat);

            seat_price = seat_count * price;
            $('#total_price_'+id).val(seat_price);
            $('#total_seat').val(seat_count);
        }

        console.log(seat_count);
        if(seat_count == '0'){
            $('#continue_booking_btn_'+id).attr('disabled',true);
        }else{
            $('#continue_booking_btn_'+id).attr('disabled',false);
        }
    }
</script>