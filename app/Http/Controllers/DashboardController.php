<?php

namespace App\Http\Controllers;
use App\Models\Clients;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
          $clients = Clients::all();
          return view('dashboard.dashboard' , compact('clients'));
    }

    public function client(){
        return view('dashboard.clients');
    }
}
