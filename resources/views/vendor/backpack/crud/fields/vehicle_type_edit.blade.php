<div class="row col-md-12 if_bus m-1">
    <div class="col-md-12 bg-secondary">
        <legend>Bus Seat Details</legend>
    </div>
    <div class="col-md-6 row bold-labels">
        <div class="form-group col-md-8">
            <label for="driver_side">Driver Side</label><small>(MAX value is 2)</small>
            <input type="text" name="driver_side" class="form-control" value="{{ $entry->driver_side }}" id="driver_side" onkeyup="loadSeat(this, 2)">
        </div>
        <div class="form-group col-md-8">
            <label for="last_row">Last Row</label><small>(MAX value is 5)</small>
            <input type="text" name="last_row" class="form-control" value="{{ $entry->last_row }}" id="last_row" onkeyup="loadSeat(this,5)">
        </div>
        <div class="form-group col-md-8">
            <label for="right_row">Right Row</label><small>(MAX value is 2)</small>
            <input type="text" name="right_row" class="form-control" value="{{ $entry->right_row }}" id="right_row">
        </div>
        <div class="form-group col-md-8">
            <label for="right_column">Right Column</label><small>(MAX value is 10)</small>
            <input type="text" name="right_column" class="form-control" value="{{ $entry->right_column }}" id="right_column" 
                placeholder="Fill value in Right Row first.">
        </div>
        <div class="form-group col-md-8">
            <label for="left_row">Left Row</label><small>(MAX value is 2)</small>
            <input type="text" name="left_row" class="form-control" value="{{ $entry->left_row }}" id="left_row">
        </div>
        <div class="form-group col-md-8">
            <label for="left_column">Left Column</label><small>(MAX value is 10)</small>
            <input type="text" name="left_column" class="form-control" value="{{ $entry->left_column }}" id="left_column" 
                placeholder="Fill value in Left Row first.">
        </div>
    </div>
    <div class="col-md-6 row">
        <div class="col-md-12 card mt-2 border-success" style="max-width: 42%;">
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
                <div class="col-md-12 m-2"></div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5" style="align-self: end;">
                            <div class="row left"></div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5" style="align-self: end;">
                            <div class="row right"></div>
                        </div>
                    </div>
                    <div class="row last_row justify-content-between"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script>
    $(document).ready(function () {
        driver_side_val = $('#driver_side').val();
        last_row_val = $('#last_row').val();
        right_row_val = $('#right_row').val();
        right_column_val = $('#right_column').val();
        left_row_val = $('#left_row').val();
        left_column_val = $('#left_column').val();
        if(driver_side_val && last_row_val && right_row_val && right_column_val && left_row_val && left_column_val){
            loadSeat('driver_side',null);
            loadSeat('last_row',null);
            loadMiddleSeat(right_row_val, right_column_val, 'right');
            loadMiddleSeat(left_row_val, left_column_val, 'left');
        }

        let right_row;
        let right_column;
        let left_row;
        let left_column;
        
        // for right side seats
        $("#right_column").attr('readonly', true);
        $('#right_row').on('keyup paste change', function (e) { 
            e.preventDefault();
            right_row = $(this).val();
            isANumber(2, right_row, '#right_row');
            
            if(right_row && right_row > 0){
                $("#right_column").attr('readonly', false);
            }else{
                $("#right_column").attr('readonly', true);
            }
        });

        $('#right_column').on('keyup paste change', function (e) {
            e.preventDefault();
            $('.right').empty();

            right_column = $(this).val();
            isANumber(10, right_column, '#right_column');

            loadMiddleSeat(right_row, right_column, 'right');
        });

        // for left side seats
        $("#left_column").attr('readonly', true);
        $("#left_row").on('keyup paste change', function (e){
            e.preventDefault();
            left_row = $(this).val();
            isANumber(2, left_row, '#left_row');
            
            if(left_row && left_row > 0){
                $("#left_column").attr('readonly', false);
            }else{
                $("#left_column").attr('readonly', true);
            }
        });

        $('#left_column').on('keyup paste change', function (e) {
            e.preventDefault();
            $('.left').empty();

            left_column = $(this).val();
            isANumber(10, left_column, '#left_column');

            loadMiddleSeat(left_row, left_column, 'left');
        });
    });

    function loadSeat(item, max){
        field_id = item.id;
        if(field_id == undefined){
            field_id = item;
            seat_value = $('#'+field_id).val();
            for(let i = 1; i <= seat_value ; i++) {
                $('.'+field_id).append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
            }
            totalNoOfSeat();
        }else{
            field_id = item.id;
            seat_value = $('#'+field_id).val();
            isANumber(max, seat_value , '#'+field_id);
            $('.'+field_id).empty();
            seat_value = $('#'+field_id).val();
            if(seat_value  == ''){
                $('.'+field_id).empty();
            }else{
                console.log(seat_value, field_id);
                for(let i = 1; i <= seat_value ; i++) {
                    $('.'+field_id).append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
                }
            }
            totalNoOfSeat();
        }
    } 

    function loadMiddleSeat(row, column, class_name)
    {
        total_seat = row * column;
        if(total_seat  == 0){
            $('.'+class_name).empty();
        }else{
            for(let i = 1; i <= total_seat ; i++) {
                $('.'+class_name).append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
            }
        }
        totalNoOfSeat();
    }

    function totalNoOfSeat(){
        driver_side = $('#driver_side').val();
        last_row = $('#last_row').val();
        right_row = $('#right_row').val();
        right_column = $('#right_column').val();
        left_row = $('#left_row').val();
        left_column = $('#left_column').val();
        total_no_of_seat = 0;
        if(driver_side && last_row && right_row && right_column && left_row && left_column){
            total_no_of_seat = Number(driver_side) + Number(last_row) + Number((right_row  * right_column)) + Number((left_row * left_column));
            $('#total_no_of_seat ').val(total_no_of_seat);
        }
    }
    function isANumber(max, value, id){
        max = max;
        val = isNaN(value) ? 0 : Math.max(Math.min(value, max), 0);
        $(id).val(val);
    }
</script>