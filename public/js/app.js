$(document).ready(function () {

    $('.driver_license_info').hide();
    var val = $('select[name=employee_type_id]').val();
    if(val == 1){
        $('.driver_license_info').show();
    }

    $('select[name=employee_type_id]').change(function (e) { 
        e.preventDefault();
        var val = $('select[name=employee_type_id]').val();
        if(val != 1){
            $('.driver_license_info').hide();
        }else{
            $('.driver_license_info').show();
        }
    });

    vehicle_value = $('#vehicle_type_change').val();
    if(vehicle_value == 2){
        $('.if_bus').show();
        $("#total_no_of_seat").attr('readonly', true);
    }else{
        $('.if_bus').hide();
        $("#total_no_of_seat").attr('readonly', false);
    }
    $('#vehicle_type_change').change(function(){
        vehicle_value = $(this).val();
        if(vehicle_value == 2){
            $('.if_bus').show();
            $("#total_no_of_seat").attr('readonly', true);
        }else{
            $('.if_bus').hide();
            $("#total_no_of_seat").attr('readonly', false);

            // clear value if bus not selected
            $('#driver_side, #last_row, #right_row, #right_column, #left_row, #left_column, #total_no_of_seat').val('');
        }
    });

    $('#vehicle_number').on('keyup paste', function (e) { 
        $(this).val($(this).val().toUpperCase());
    });
});