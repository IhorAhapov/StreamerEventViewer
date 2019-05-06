<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function accept(int $id, Request $request)
    {
        info("ACCEPT action. Channel id = $id : " . json_encode($request->all()));

        if ($request->has('hub_challenge')) {
            return $request->get('hub_challenge');
        }

        return abort(400);
    }

    public function store(int $id, Request $request)
    {
        info("STORE action. Channel id = $id : " . json_encode($request->all()));
    }
}
