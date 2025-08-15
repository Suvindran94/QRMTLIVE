<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Operator;
use Gate;

class OperatorController extends Controller
{
    //  
    public function update(Request $request)
    {
        $operator = Operator::findOrFail($request->id);
        $opeator->update($request->all());
       
        return back();
    }
}
