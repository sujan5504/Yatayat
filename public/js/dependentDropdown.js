function getVehicle(){
    $.urlParam = function(name) {
        try {

            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        } catch {
            return null;
        }
    }

    var client_id = $('#getclient').val();
    if (client_id) {
        $.ajax({
            url: '/getvehicle/' + client_id,
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            dataType: "json",
            success: function(data) {

                if (data) {
                    $('#getvehicle').empty();
                    $('#getvehicle').focus;
                    $('#getvehicle').append('<option value="">Select Vehicle</option>');
                    var selected_id = $.urlParam("getvehicle");
                    $.each(data, function(key, value) {
                        var selected = "";
                        if (selected_id == value.id) {
                            selected = "SELECTED";
                        }

                        $('select[name="vehicle_id"]').append('<option class="form-control" value="' + value.id + '" ' + selected + '>' + value.name + '</option>');
                        if (selected == "SELECTED") {
                            $("#getvehicle").trigger("change");
                        }
                    });
                } else {
                    $('#getvehicle').empty();

                }
            }
        });
    } else {
        $('#getvehicle').empty();
    }
}