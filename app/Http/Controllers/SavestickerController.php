<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SavestickerController extends Controller
{
    //
    public function store(Request $request)
    {
        $tests = new \App\Test;
        $tests->first_name = request('first_name');
        $tests->last_name = request('last_name');
        $tests->save();
        return redirect()->back();
    }
}
