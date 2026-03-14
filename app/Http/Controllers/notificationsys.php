<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;


class notificationsys extends Controller
{
    public function ReadAll(){
        Notification::where('status', 1)->update([
            'status' => 2
        ]);

        return redirect()->back();
    }
}
