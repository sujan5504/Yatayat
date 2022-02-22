<div class="container p-3" id="container-width" style="background-color:#eee"> 
    <div class="card mb-2 w-100">
        <div class="card-body row" style="--bs-gutter-x:-0.5rem">
            <div class="col-md-3 text-dark fs-5 text-break">Travels</div>
            <div class="col-md-3 text-dark fs-5 text-break">Vehicle Type</div>
            <div class="col-md-2 text-dark fs-5 text-break">Departure Date <br> Time</div>
            <div class="col-md-2 text-dark fs-5 text-break">Fear</div>
            <div class="col-md-2 text-dark fs-5 text-break">Seats Avaliable</div>
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <div class="row w-100">
                        <div class="col-md-3 text-dark fs-5 text-break">Mountain Pvt. Ltd.</div>
                        <div class="col-md-3 text-dark fs-5 text-break">AC Delux</div>
                        <div class="col-md-2 text-dark fs-5 text-break">20:00 Am</div>
                        <div class="col-md-2 text-dark fs-5 text-break">Rs. 500</div>
                        <div class="col-md-2 text-dark fs-5 text-break">11</div>
                    </div>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div class="row" id="details">
                        <div class="col-md-8">
                            <h4>Biratnar to Pokhara</h4>
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
                                    <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#boarding_point" aria-expanded="false" aria-controls="boarding_point"><i class="la la-map-marker"></i> Boarding Point</button>
                                    <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#dropping_point" aria-expanded="false" aria-controls="dropping_point"><i class="la la-map-marker"></i> Dropping Point</button>
                                    <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#booking_policy" aria-expanded="false" aria-controls="booking_policy"><i class="la la-percentage"></i> Booking Policy</button>
                                    <button type="button" class="btn btn-sm btn-secondary to_collapse" data-bs-toggle="collapse" data-bs-target="#amenities" aria-expanded="false" aria-controls="amenities"><i class="la la-clipboard-list"></i> Amenities</button>
                                </div>
                            </div>

                            <!-- boarding point -->
                            <div class="collapse collapse_2 indent mt-2" id="boarding_point">
                                <h6>Boarding Points</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Point</th>
                                            <th>Time</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>asdf</td>
                                            <td>adsf</td>
                                            <td>asdf</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- dropping point -->
                            <div class="collapse collapse_2 indent mt-2" id="dropping_point">
                                <h6>Dropping Points</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Point</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>asdf</td>
                                            <td>asdf</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- booking policy -->
                            <div class="collapse collapse_2 indent mt-2" id="booking_policy">
                                <h6>Booking Policy</h6>
                                <table class="table table-bordered text-break">
                                    <thead>
                                        <tr>
                                            <th>Policy</th>
                                            <th>Deduction</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>asd</td>
                                            <td>asdf</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- amenities -->
                            <div class="collapse collapse_2 indent text-break" id="amenities">
                                <h6>Amenities</h6>
                                asdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdfasdfasfasdf
                            </div>
                        </div>
                        <div class="col-md-4 bg-success">
                            asdf
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-button::after{
        content: none;
    }
</style>

<script>
    $('.to_collapse').on('click',function(){
        $('.collapse_2').collapse('hide');
    });
</script>