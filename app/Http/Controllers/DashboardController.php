<?php

namespace App\Http\Controllers;
use App\Models\Clients;
use Inertia\Inertia;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
          return Inertia::render('Dashboard');
    }


    public function clients(Request $request){
        $query = \App\Models\Clients::query();
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('mobile_no', 'like', '%' . $request->search . '%');
            });
        }
        $clients = $query->paginate(10)->withQueryString();
        return Inertia::render('Clients', [
            'clients' => $clients,
            'filters' => $request->only('search')
        ]);
    }

    public function jobs(){
        return Inertia::render('Jobs');
    }

    public function profile(){
        return Inertia::render('Profile');
    }

    public function technician(){
        return Inertia::render('Tech');
    }
}
