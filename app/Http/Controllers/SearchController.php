<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        $lists = DB::select('select * from solist');
        return view('BS.sodetail',['lists' => $lists])->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function search($sonum){
        $lists = DB::select("select * from solist where sonum= '$sonum'");
        return view('BS.sodetail',['lists'=>$lists]);
    }
}
