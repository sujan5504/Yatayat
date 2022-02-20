@extends('layouts.layout')

@section('title')
    VehicleHire
@endsection

@section('content')
    <div class="container">
        <div class="card m-4">
            <div class="card-header text-center text-uppercase">
                <h3>reservation</h3>
            </div>
            <div class="card-body bold-labels" style="line-height:40px">
                <form action="{{ route('vehiclehire.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="name">Name</label>
                            <input required type="text" value="{{ $user_detail->name }}" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="contact">Contact</label>
                            <input required type="text" value="{{ $user_detail->contact }}" name="contact" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <input value="{{ $user_detail->id }}" name="user_id" id="user">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="client_id">Operator</label>
                            <select class="form-control searchselect" name="client_id" id="getclient" data-id="getvehicle" onchange="getVehicle()">
                                <option disabled selected value="" style="font-weight:bold;">Select Operator</option>
                                @foreach($clients as $c)
                                    <option class="form-control" value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="vehicle_id">Vehicle</label>
                            <select class="form-control searchselect" name="vehicle_id" id="getvehicle"></select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="from_id">Joruney From</label>
                            <select class="form-control searchselect" name="from_id" id="from">
                                @foreach($destinations as $destination)
                                    <option class="form-control" value="{{ $destination->id }} {{old('from_id')==$destination->id ? 'selected':'' }}">{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="to_id">Joruney To</label>
                            <select class="form-control searchselect" name="to_id" id="to">
                                @foreach($destinations as $destination)
                                    <option class="form-control" value="{{ $destination->id }} {{old('to_id')==$destination->id ? 'selected':'' }}">{{ $destination->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="date_of_travel">Date of Travel</label>
                            <input required type="text" name="date_of_travel" id="date_of_travel" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="remarks">Remarks</label>
                            <textarea id="ckeditor" name="remarks" class="form-control">{{ old('political_background') }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-md btn-primary"><i class="la la-save"></i> Submit</button>
                </form>
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
        $(document).ready(function () {
            $('#user').hide();
            $('.searchselect').select2();

            $('#date_of_travel').nepaliDatePicker({
                npdMonth: true,
                npdYear: true,
                npdYearCount: 10,
            });
        });
    </script>
@endsection