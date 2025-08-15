<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller

{

    public function create()
    {
        return view('cars.home2');
    }


    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'staffId' => 'required',
            'email' => 'required|email',
            'location' => 'required',
            'dept' => 'required',
            'role' => 'required',
            'password' => 'required|confirmed'
        ]);
        
        $user = User::create(request(['name','staffId','email','location','dept','role','password']));
        
        auth()->login($user);
       
        
        return redirect()->to('/home2');
    }
}
