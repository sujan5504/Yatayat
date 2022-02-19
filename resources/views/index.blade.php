@extends('layouts.layout')

@section('title')
    Home
@endsection

@section('content')
    <!--  -->
    <div align="right" style="margin-right:20px; margin-top:2px">
        <a href="javascript:;" class="btn btn-md btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">SEARCH TICKET</a>
        <a class="btn btn-md btn-secondary" href="javascript:;">VEHICLE HIRE</a>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="staticBackdropLabel">Search Ticket</h5>
                    <i class="la la-times la-2x" id="close" data-bs-dismiss="modal" aria-label="Close" style="cursor:pointer;"></i>
                </div>
                <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Ticket Number:</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Eg:124xyba4677">
                </div>
                </div>
                <div class="modal-footer">
                <button type="button " class="btn btn-primary btn-block">Search</button>
                </div>
            </div>
        </div>
    </div>

    <!-- search -->
    <div class="mt-3 mb-5" id="back">
        <div class="row text-center text-white text-uppercase pt-5 pb-5">
            <div class="col-md-12">
                <h1 class="font-weight-bold">Search For Vehicles</h1>
            </div>
            <div class="col-md-12">
                <h5 class="pt-2">make your journey easier and faster</h5>
            </div>
        </div>
        <div class="container" align="center">
                <form action="">
                    
                    <div class="row" id="form-box" >
                    <div class="row">
                        <div class="col-md-4">
                            <select class="form-control searchselect" name="" id="">
                                <option disabled selected value="" style="font-weight:bold;">From (Soruce)</option>
                                @foreach($places as $place)
                                    <option class="form-control" value="{{ $place->id }}">{{ $place->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select class="form-control searchselect" name="" id="">
                                <option disabled selected value="" style="font-weight:bold;">To (Destination)</option>
                                @foreach($places as $place)
                                    <option class="form-control" value="{{ $place->id }}">{{ $place->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="date" name="date" placeholder="Date"></input>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-md btn-danger" type="reset"><i class="la la-times"></i> Clear</button>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
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
                            <h5> Search yatayat</h5>
                        </footer>
                    </blockquote>
                </div>

                <div class="card text-center mb-2" >
                    <blockquote class="blockquote mb-0 card-body">
                        <img src="{{ asset('images\book.png') }}">
                        <footer class="blockquote-footer">
                            <small class="text-muted">
                                <h5> Book seats</h5>
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
        #date{
            width: 130%;
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

            $('#date').nepaliDatePicker({
                npdMonth: true,
                npdYear: true,
                npdYearCount: 10,
            });
        });
    </script>
@endsection