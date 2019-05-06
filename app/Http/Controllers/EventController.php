<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(int $id, Request $request)
    {
        info("channel id = $id : " . json_encode($request->all()));

        if ($request->has('hub_challenge')) {
            return $request->get('hub_challenge');
        }
    }
}
