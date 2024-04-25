<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplication;

class AplicationController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
          $name = $request->file('file')->getClientOriginalName();
          $path = $request->file('file')->storeAs(
            'files',
            $name,
           'public',
          );
          
        }
       $request->validate([
            'subject' => 'required|max:20',
            'message' => 'required|max:255',
            'file' => 'file|mimes:jpg,png,pdf',
       ]);

       $aplications = Aplication::create([
        'user_id' => auth()->user()->id,
        'subject' => $request->subject,
        'message' => $request->message,
        'file_url' => $path ?? null,
       ]);
       return redirect()->back();
    }
}
