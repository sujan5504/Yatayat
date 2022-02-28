<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function sendEmail(){
        $data["email"] = "shreeshashre@gmail.com";
        $data["title"] = "From ItSolutionStuff.com";
        $data["body"] = "This is Demo";
        
        $pdf = PDF::loadView('ticket',$data);

        Mail::send('ticket', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf");
        });
        
        dd('mail sent success');
    }
}
