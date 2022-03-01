@extends('layouts.layout')

@section('title')
    Ticket
@endsection

@section('content')
    <div class="container mt-3 mb-2">
        <div class="card">
            <div class="card-header">
                <h5>Ticket Details</h5>
            </div>
            <div class="card-body">
                <strong class="text-danger">We have also mailed you a copy of this ticket!!</strong>
                <div class="mt-2" style="max-width:400px; border:solid black">
                    <div style="text-align:center">
                        <span style="font-weight:bold">{{ $data[0]->client_name }}</span> <br>
                        <span style="font-weight:bold">{{ $data[0]->client_address }}</span> <br>
                        <span style="font-weight:bold">{{ $data[0]->client_contact }}</span> <br>
                        <span style="float:left"><strong>Vehicle No.</strong>{{ $data[0]->vehicle_number }}</span>
                        <span style="float:right"><strong>Ticket No.</strong>{{ $data[0]->ticket_number }}</span>
                    </div><br>
                    <hr>
                    <div class="col-md-12">
                        <span><strong>Date & Time:</strong> {{ $data[0]->date }} / {{$data[0]->departure_time}}</span>
                    </div>
                    <div class="col-md-12">
                        <span><strong>Name:</strong> {{ $data[0]->name }}</span>
                    </div>
                    <div class="col-md-6">
                        <span><strong>From:</strong> {{ $data[0]->from_name }}</span>
                    </div>
                    <div class="col-md-6">
                        <span><strong>To:</strong> {{ $data[0]->to_name }}</span>
                    </div>
                    <div class="col-md-12">
                        <span><strong>Boarding Point:</strong> {{ $data[0]->boarding_point }} ({{ $data[0]->time }})</span>
                    </div>
                    <div class="col-md-12">
                        <span><strong>Dropping Point:</strong> {{ $data[0]->dropping_point }} (Rs. {{ $data[0]->price }})</span>
                    </div>
                    <div class="col-md-12">
                        <span><strong>Seat No.:</strong> {{ $seat }}</span>
                    </div>
                    <div class="col-md-12">
                        <span><strong>Total Fare:</strong> Rs.{{ $data[0]->cost }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection