
<html>
    <head>
        <title>Yatayat</title>
    </head>
    <div style="max-width:400px; margin:50px; padding:8px; border:solid black">
        <div style="text-align:center">
            <span style="font-weight:bold">{{ $client_name }}</span> <br>
            <span style="font-weight:bold">Hattiban</span> <br>
            <span style="font-weight:bold">{{ $client_contact }}</span> <br>
            <span style="float:left"><strong>Vehicle No.</strong>{{ $vehicle_number }}</span>
            <span style="float:right"><strong>Ticket No.</strong>{{ $ticket_number }}</span>
        </div><br>
        <hr>
        <div class="col-md-12">
            <span><strong>Date & Time:</strong> {{ $date }} / {{$departure_time}}</span>
        </div>
        <div class="col-md-12">
            <span><strong>Name:</strong> {{ $name }}</span>
        </div>
        <div class="col-md-6">
            <span><strong>From:</strong> {{ $from }}</span>
        </div>
        <div class="col-md-6">
            <span><strong>To:</strong> {{ $to }}</span>
        </div>
        <div class="col-md-12">
            <span><strong>Boarding Point:</strong> {{ $boarding_point }} ({{ $time }})</span>
        </div>
        <div class="col-md-12">
            <span><strong>Dropping Point:</strong> {{ $dropping_point }} (Rs. 500)</span>
        </div>
        <div class="col-md-12">
            <span><strong>Seat No.:</strong> {{ $seat }}</span>
        </div>
        <div class="col-md-12">
            <span><strong>Fare:</strong> Rs.{{ $cost }}</span>
        </div>
    </div>
</html>