<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request)
    {
        info(json_encode($request));
    }
}
