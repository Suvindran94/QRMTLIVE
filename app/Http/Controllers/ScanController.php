<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Task;

class ScanController extends Controller
{
  
 
    public function index()
    {
        return view('BS.scan');
    }

    public function store(Request $request)
    {
    $this->validate(request(), ['qrcode' => 'required',]);
    $Task = task::create(request(['qrcode']));
    return redirect()->back();
    }
     
}