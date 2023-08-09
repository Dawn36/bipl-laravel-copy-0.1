<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IjaraSukukController extends Controller
{
    public  function show()
    {
        return view('ijara-sukuk/ijara_sukuk_show'); 
    }
}
