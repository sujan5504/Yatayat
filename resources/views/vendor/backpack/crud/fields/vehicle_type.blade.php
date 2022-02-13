<div class="row col-md-12 if_bus m-1">
    <div class="col-md-12 bg-secondary">
        <legend>Bus Seat Details</legend>
    </div>
    <div class="col-md-6 row bold-labels">
        <div class="form-group col-md-8">
            <label for="driver_side">Driver Side</label><small>(MAX value is 2)</small>
            <input type="text" name="driver_side" class="form-control" id="driver_side" onkeyup="loadSeat(this)">
        </div>
        <div class="form-group col-md-8">
            <label for="last_row">Last Row</label><small>(MAX value is 5)</small>
            <input type="text" name="last_row" class="form-control" id="last_row" onkeyup="loadSeat(this)">
        </div>
        <div class="form-group col-md-8">
            <label for="right_row">Right Row</label><small>(MAX value is 2)</small>
            <input type="text" name="right_row" class="form-control" id="right_row" onkeyup="loadSeat(this)">
        </div>
        <div class="form-group col-md-8">
            <label for="right_column">Right Column</label><small>(MAX value is 10)</small>
            <input type="text" name="right_column" class="form-control" id="right_column" onkeyup="loadSeat(this)">
        </div>
        <div class="form-group col-md-8">
            <label for="left_row">Left Row</label><small>(MAX value is 2)</small>
            <input type="text" name="left_row" class="form-control" id="left_row" onkeyup="loadSeat(this)">
        </div>
        <div class="form-group col-md-8">
            <label for="left_column">Left Column</label><small>(MAX value is 10)</small>
            <input type="text" name="left_column" class="form-control" id="left_column" onkeyup="loadSeat(this)">
        </div>
    </div>
    <div class="col-md-6 row">
        <div class="col-md-12 card mt-2">
            <div class="row">
            <div class="col-md-12 row">
                <div class="col-md-4">
                    <img src="{{ asset('images/avaliable.png') }}" alt="Avaliable"><strong>Avaliable</strong>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/selected.png') }}" alt="Selected"><strong>Selected</strong>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('images/booked.png') }}" alt="Booked"><strong>Booked</strong>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row driver_side">

                        </div>
                    </div>
                    <div class="col-md-6 bg-success">
                        <img src="{{ asset('images/driver.png') }}" alt="Driver" class="float-right" height="90px"> 
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5 bg-blue">asdf</div>
                    <div class="col-md-2"></div>
                    <div class="col-md-5 bg-secondary">asdf</div>
                </div>
                <div class="row bg-primary">asdf</div>
            </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
    // $(document).ready(function () {
    //     var driver_side= $('#driver_side').val();
    //     var last_row = $('#last_row').val();
    //     var ight_row = $('#ight_row').val();
    //     var right_column = $('#right_column').val();
    //     var left_row = $('#left_row').val();
    //     var left_column = $('#left_column').val();
    // });

    function loadSeat(item){
        field_id = item.id;
        driver_side= $('#driver_side').val();

        isANumber(2, driver_side, '#driver_side');

        $('.driver_side').empty();
        driver_side= $('#driver_side').val();

        if(driver_side == ''){
            $('.driver_side').empty();
        }else{
            for(let i = 1; i <= driver_side; i++) {
                $('.driver_side').append('<div class="col-md-12"><img src="{{ asset("images/avaliable.png") }}"/></div><br>');
            }
        }
    } 

    function isANumber(max, value, id){
        max = max;
        val = isNaN(driver_side) ? 0 : Math.max(Math.min(value, max), 0);
        $(id).val(val);
    }
</script>