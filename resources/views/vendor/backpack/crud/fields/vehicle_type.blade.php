<div class="row col-md-12 if_bus m-1">
    <div class="col-md-12 bg-secondary">
        <legend>Bus Seat Details</legend>
    </div>
    <div class="col-md-6 row bold-labels">
        <div class="form-group col-md-8">
            <label for="driver_side">Driver Side</label><small>(MAX value is 2)</small>
            <input type="text" name="driver_side" class="form-control" id="driver_side" onkeyup="loadSeat( 2)">
        </div>
        <div class="form-group col-md-8">
            <label for="last_row">Last Row</label><small>(MAX value is 5)</small>
            <input type="text" name="last_row" class="form-control" id="last_row" onkeyup="loadSeat(this,5)">
        </div>
        <div class="form-group col-md-8">
            <label for="right_row">Right Row</label><small>(MAX value is 3)</small>
            <input type="text" name="right_row" class="form-control" id="right_row" onkeyup="loadMiddleSeat(3)">
        </div>
        <div class="form-group col-md-8">
            <label for="right_column">Right Column</label><small>(MAX value is 10)</small>
            <input type="text" name="right_column" class="form-control" id="right_column" onkeyup="loadMiddleSeat(10)">
        </div>
        <div class="form-group col-md-8">
            <label for="left_row">Left Row</label><small>(MAX value is 3)</small>
            <input type="text" name="left_row" class="form-control" id="left_row" onkeyup="loadMiddleSeat(3)">
        </div>
        <div class="form-group col-md-8">
            <label for="left_column">Left Column</label><small>(MAX value is 10)</small>
            <input type="text" name="left_column" class="form-control" id="left_column" onkeyup="loadMiddleSeat(10)">
        </div>
    </div>
    <div class="col-md-6 row">
        <div class="col-md-12 card mt-2" style="max-width:42%;">
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row driver_side"></div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ asset('images/driver.png') }}" alt="Driver" class="float-right" height="50px"> 
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5 bg-blue">asdf</div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5 bg-secondary">asdf</div>
                    </div>
                    <div class="row last_row justify-content-between"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
    function loadSeat(item, max){
        field_id = item.id;
        seat_value = $('#'+field_id).val();

        isANumber(max, seat_value , '#'+field_id);

        $('.'+field_id).empty();
        seat_value = $('#'+field_id).val();

        if(seat_value  == ''){
            $('.'+field_id).empty();
        }else{
            for(let i = 1; i <= seat_value ; i++) {
                $('.'+field_id).append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
            }
        }
    } 

    function loadMiddleSeat(max){
        left_row = $('#left_row').val();
        isANumber(max, left_row , '#'+field_id);
        
        left_column = $('#left_column').val();
        isANumber(max, left_column , '#'+field_id);

        right_row = $('#right_row').val();
        isANumber(max, right_row , '#'+field_id);

        right_column = $('#right_column').val();
        isANumber(max, right_column , '#'+field_id);

        $('.'+field_id).empty();
        seat_value = $('#'+field_id).val();

        if(seat_value  == ''){
            $('.'+field_id).empty();
        }else{
            for(let i = 1; i <= seat_value ; i++) {
                $('.'+field_id).append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
            }
        }
    }

    function isANumber(max, value, id){
        max = max;
        val = isNaN(value) ? 0 : Math.max(Math.min(value, max), 0);
        $(id).val(val);
    }
</script>