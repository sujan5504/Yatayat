@extends('layouts.layout')

@section('title')
    Home
@endsection

@section('content')
    <!-- search -->
    <div class="mt-3 mb-2" id="back">
        <div class="row text-center text-white text-uppercase pt-5 pb-5">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Search For Vehicles</h1>
            </div>
            <div class="col-md-12">
                <h5 class="pt-2">make your journey easier and faster</h5>
            </div>
        </div>
        <div class="container" align="center">
                
            <div class="row" id="form-box">
                <div class="col-md-3">
                    <select class="form-control searchselect" name="vehicle_id" id="vehicle_id" onchange="getVehicleSeatData()">
                        <option disabled selected value="">Vehicle</option>
                        <option value="2">Bus</option>
                        <option value="4">Hiace</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="booking_date" name="date" placeholder="Date" oninput="getVehicleSeatData()"></input>
                </div>
                <div class="col-md-3">
                    <select class="form-control searchselect" name="from_id" id="from_id" onchange="getVehicleSeatData()">
                        <option disabled selected value="" style="font-weight:bold;">From (Soruce)</option>
                        @foreach($places as $place)
                            <option class="form-control" value="{{ $place->id }}">{{ $place->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-control searchselect" name="to_id" id="to_id" onchange="getVehicleSeatData()">
                        <option disabled selected value="" style="font-weight:bold;">To (Destination)</option>
                        @foreach($places as $place)
                            <option class="form-control" value="{{ $place->id }}">{{ $place->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- <div class="col-md-2">
                    <button class="btn btn-md btn-danger" type="reset"><i class="la la-times"></i></button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="container p-3" id="container-width" style="background-color:#eee"> 
        <div class="card mb-2 w-100">
            <div class="card-body row p-1" style="--bs-gutter-x:-0.5rem">
                <div class="col-md-3 text-dark fs-5 text-break">Travels</div>
                <div class="col-md-3 text-dark fs-5 text-break">Vehicle Type</div>
                <div class="col-md-2 text-dark fs-5 text-break">Departure Date <br> Time</div>
                <div class="col-md-2 text-dark fs-5 text-break">Fear</div>
                <div class="col-md-2 text-dark fs-5 text-break">Seats Avaliable</div>
            </div>
        </div>
        <div id="vehicle_search_datas"></div>
    </div>

    <!-- steps -->
    <div class="mt-2 mb-3" style="background-color:#39c9dc;font-family: SFProDisplay-Regular, Helvetica, Arial, sans-serif;">
        <h2 class="text-white text-center p-3">Book yatayat seats in 3 steps</h2>   
        <div class="card-columns mt-2 pb-3 mb-5">
            <div class="row justify-content-around">
                <div class="card text-center mb-2">
                    <blockquote class="blockquote mb-0 card-body">
                        <img src="{{ asset('images\search.png') }}">
                        <footer class="blockquote-footer">
                            <h5> Search Vehicle</h5>
                        </footer>
                    </blockquote>
                </div>

                <div class="card text-center mb-2" >
                    <blockquote class="blockquote mb-0 card-body">
                        <img src="{{ asset('images\book.png') }}">
                        <footer class="blockquote-footer">
                            <small class="text-muted">
                                <h5> Book Seats</h5>
                            </small>
                        </footer>
                    </blockquote>
                </div>

                <div class="card text-center mb-2" >
                    <blockquote class="blockquote mb-0 card-body">
                        <img src="{{ asset('images\card.png') }}">
                        <footer class="blockquote-footer">
                            <small class="text-muted">
                                <h5>
                                    Pay and Relex
                                </h5>
                            </small>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        #container-width{
            max-width: 1290px;
        }
        #date{
            /* width: 130%; */
        }
        .card{
            border: 3px solid white;
            border-radius: 10px;
            width: 25rem;
        }
        #back{
            background-image: url('images/pokhara.jpg');
            background-size: cover;
            background-position-y: 15%;
            min-height: 350px;
        }
        #form-box{
            background-color :rgb(182, 186, 183, 0.5);
            padding: 30px;
            border-radius: 10px;
        }
        .search-field{
            height:50px;
            width:250px;
            padding:10px;
            border-radius: 25px;
            border: none;
            outline: none;
        }
        .search-btn{
            height: 50px;
            width: 150px;
            font-weight: 38px;
            font-style: bold;
            background:blue;
            border: none;
            color:white;
            border-radius: 25px;
        }
    </style>
@endsection

@section('after_script')
    <script>
        $(document).ready(function () {
            $('.searchselect').select2();

            $('#booking_date').nepaliDatePicker({
                npdMonth: true,
                npdYear: true,
                npdYearCount: 10,
                onChange: function() {
                    getVehicleSeatData();
            	}
            });

            // getVehicleSeatData();
        });

        function getVehicleSeatData(){
            let data = {
                vehicle_id: $('#vehicle_id').val(),
                from_id : $('#from_id').val(),
                to_id : $('#to_id').val(),
                date : $('#booking_date').val(),
            }
            $('#vehicle_search_datas').html('<div class="text-center"><img src="{{ asset("images/loading.gif")}}"/></div>');

            $.ajax({
            type: "POST",
            url: "/getvehicleseatdetails",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data: data,
            success: function(response){
                $('#vehicle_search_datas').html(response);
            }
        });
        }
    </script>
@endsection