<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    
    public function index()
    {
        return view("apar.index");
    }

    public function create()
    {
        return view("apar.create");
    }

    public function edit()
    {
        return view("apar.edit");
    }


}
