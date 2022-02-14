$("#right_column").attr('disabled','disabled');
    function loadRightRowSeat(max){
        right_row = $('#right_row').val();
        isANumber(max, right_row , '#right_row');

        if(right_row && right_row > 0){
            $("#right_column").attr('disabled',false);
        }

        right_row = $('#right_row').val();
        return right_row;
    }

    function loadRightColumnSeat(max){
        right_column = $('#right_column').val();
        isANumber(max, right_column , '#right_column');

        right_column = $('#right_column').val();
        right_row = loadRightRowSeat(3);
        
        total_right_seat = right_column * right_row;
        if(total_right_seat  == 0){
            $('.right').empty();
        }else{
            for(let i = 1; i <= total_right_seat ; i++) {
                $('.right').append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
            }
        }
    }

    $("#left_column").attr('disabled','disabled');
    function loadLeftRowSeat(max){
        left_row = $('#left_row').val();
        isANumber(max, left_row , '#left_row');

        if(left_row && left_row > 0){
            $("#left_column").attr('disabled',false);
        }

        left_row = $('#left_row').val();
        return left_row;
    }

    function loadLeftColumnSeat(max){
        left_column = $('#left_column').val();
        isANumber(max, left_column , '#left_column');

        left_column = $('#left_column').val();
        left_row = loadLeftRowSeat(3);
        console.log(left_row, left_column);
        
        total_left_seat = left_column * left_row;
        if(total_left_seat  == 0){
            $('.left').empty();
        }else{
            for(let i = 1; i <= total_left_seat ; i++) {
                $('.left').append('<div><a href="javascript:;"><img src="{{ asset("images/avaliable.png") }}"/></a></div>');
            }
        }
    }
