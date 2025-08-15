<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }
    
    public function store()
    {
        if (auth()->attempt(request(['staffId', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The Staff ID or password is incorrect, please try again'
            ]);
        }
        return redirect()->to('/home2');
    }

    public function store2(Request $request)
    {
        $qrcode =  $request->input('qrcode');
        $staffId = substr($qrcode,3,6);
     
        if (auth()->attempt(['staffId' => $staffId, 'password' => "P@ssw0rd"]) == false) {
			
           return back()->withErrors([
                'message' => 'The Staff ID or password is incorrect, please try again'
            ]);

        }
       
        return redirect()->to('/BSprint/'.$staffId);

    }
    
    public function destroy()
    {
		\LogActivity::addToLog('Logout IQRMT');
        auth()->logout();
        return redirect()->intended('https://ierp.tk/home2');
    }
}

