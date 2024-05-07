<?php

namespace App\Http\Controllers;
use App\Models\Aplication;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function main(){
        return redirect('dashboard');
    }

    public function dashboard(){




        return view('dashboard')->with([
            'aplications' => Aplication::latest()->paginate(10),
        ]);
        

    }
}
