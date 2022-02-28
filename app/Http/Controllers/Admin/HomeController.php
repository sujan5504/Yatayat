<?php

namespace App\Http\Controllers\Admin;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {        
        $places = Destination::all();
        return view('index',compact('places'));
    }

    public function getVehicleSeatDetails(Request $request){
        $vehicle_id = $request->vehicle_id;
        $departure_date = $request->date;
        $from_id = $request->from_id;
        $to_id = $request->to_id;
        
        $sql = "SELECT vs.id,vs.vehicle_id,vs.departure_date,vs.departure_time,vs.price,vs.boarding_point,vs.dropping_point,bp.booking_policy ,
                c.id as client_id, c.NAME AS client_name,vt.NAME AS vehicle_type,vt.last_row,vt.right_row,vt.right_column,vt.left_row,vt.left_column,
                vt.driver_side,vt.total_no_of_seat,vd.vehicle_number,vd.amenities,d.name AS from_name,de.name AS to_name,
                e.full_name as driver_name,em.full_name as conductor_name
                FROM vehicles_assign AS vs
                    LEFT JOIN clients AS c ON c.id = vs.client_id
                    LEFT JOIN vehicle_types AS vt ON vt.id = vs.vehicle_type_id
                    LEFT JOIN vehicle_details AS vd ON vd.id = vs.vehicle_detail_id
                    LEFT JOIN destinations AS d ON d.id = vs.from_id
                    LEFT JOIN destinations AS de ON de.id = vs.to_id
                    LEFT JOIN employees as e on e.id = vs.driver_employee_id
	                LEFT JOIN employees as em on em.id = vs.conductor_employee_id
                    LEFT JOIN (SELECT booking_policy, client_id FROM booking_policies ORDER BY updated_at DESC LIMIT 1 ) AS bp on bp.client_id = c.id
                ";
        $wheres[] = 'WHERE vs.client_id IS NOT NULL';

        if(!empty($vehicle_id)){
            $wheres[] = ' AND vs.vehicle_id = '. "'".$vehicle_id."'";   
        }

        if(!empty($departure_date)){
            $wheres[] = ' AND vs.departure_date = '. "'".$departure_date."'";   
        }

        if(!empty($from_id)){
            $wheres[] = ' AND vs.from_id = '. "'".$from_id."'";   
        }

        if(!empty($to_id)){
            $wheres[] = ' AND vs.to_id = '. "'".$to_id."'";   
        }

        $where_clause = implode(" ", $wheres);
        $sql .= $where_clause;
        $datas = DB::select($sql);

        return view('search_data', compact('datas'));
    }
}
