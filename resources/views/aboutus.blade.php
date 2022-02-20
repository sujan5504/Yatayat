@extends('layouts.layout')

@section('title')
    AboutUs
@endsection

@section('content')
<section class="my-1">
        <div class="container">
       
        
            <div class="row">
                <div class="col" style=" position: relative;text-align: center;">
                    <div class="card text-center">
                        <img src="images/gt.jpg" class="img-fluid">
                        <div class="card-body" style="position: absolute; top: 8px;left: 26px;">
                            <h1 class=" text-danger text-weight-bold display-1 "><u>YATAYAT</u>
                            </h1>
                            <p class="text-dark font-weight-bold fs-4"> - At Your Service.<mark>Anywhere</mark> <mark> Anytime</mark></p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card text-center" style="border:none;">
                        <div class="card-body">
                            <h5 class="text-primary">Yatayat</h5>
                            <p class="card-text">Yatayat facilitates the passengers to enquire
                                about the vehicles available on the basis of source and destination,
                                Booking and Cancellation of tickets, enquire about the status of the booked ticket, etc.
                                It is the computerized system of reserving the seats of vehicles seats in advanced.</p>
                        </div>
                    </div>
                </div>
                <div class="col offset-5 pl-5">
                    <!-- <button type="button" class="btn btn-info">more info</button> -->
                </div>
            </div>
            <div class="row">
            </div>
        </div>
    </section>
@endsection