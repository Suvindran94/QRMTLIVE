<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ListController extends Controller {

    public function index(){
   
        $lists = DB::table('solist')->paginate(5);
        return view('BS.list',['lists' => $lists])->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function edit(Request $request,$barcodeid) {
        $operator = $request->input('operators');
        DB::update('update barcodelist set operator = ? where barcodeid = ?',[$operator,$barcodeid]);
        echo "Record updated successfully.<br/>";
        echo '<a href = "/view-records">Click Here</a> to go back.';
     }
     public function show($barcodeid) {
        $lists = DB::select('select * from barcodelist where barcodeid = ?',[$barcodeid]);
        return view('view-records',['lists'=>$lists]);
     }
     
}