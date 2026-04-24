<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ImportClientsJob;


class ClientImportController extends Controller
{
    

public function import(Request $request){
    $request->validate([
        'file' => 'required|file|mimes:csv,txt,xlsx'
    ]);

   
    if (!$request->hasFile('file')) {
        dd('NO FILE RECEIVED');
    }

    $file = $request->file('file');

    $path = $file->store('imports');


    ImportClientsJob::dispatch($path);

    return back()->with('success', 'Import started');
}
}
