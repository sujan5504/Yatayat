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

    // var active = $('#is_seat_details_required').prop("checked");
    // console.log(active);
    $('#is_seat_details_required').click(function(){
        value = $('#is_seat_details_required').prop("checked");

        if(true){
            $('.if_bus').hide();
        }else{
            $('.if_bus').show();
        }
    });
});