<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aplication;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\AplicationCreated;

class AplicationController extends Controller
{
    public function store(Request $request)
    {
        if( $this->checkDate()){
            redirect()->back()->with('error','You can create only 1 aplication a day');
        }
      
       

        if ($request->hasFile('file')) {
            $name = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('files', $name, 'public');
        }

        $request->validate([
            'subject' => 'required|max:255',
            'message' => 'required|max:255',
            'file' => 'file|mimes:jpg,png,pdf',
        ]);


        $aplications = Aplication::create([
            'user_id' => auth()->user()->id,
            'subject' => $request->subject,
            'message' => $request->message,
            'file_url' => $path ?? null,
        ]);

        $manager = User::first();
        Mail::to($manager)->send(new AplicationCreated($aplications));
       
        
        return redirect()->back();
        
    }

    protected function checkDate(){
        
        $last_aplication = auth()->user()->aplications()->latest()->first();
        $last_app_date =Carbon::parse($last_aplication->created_at)->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');

        if($last_app_date == $today){
            return true;
        }
    }
}
