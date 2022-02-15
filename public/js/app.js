$(document).ready(function () {
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
        }
    });
});