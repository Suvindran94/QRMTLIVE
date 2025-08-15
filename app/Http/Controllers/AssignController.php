<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class AssignController extends Controller
{
    //
    public function edit(Request $request,$id) {
        $operator = $request->input('operators');
        DB::update('update moresolist set operator = ? where id = ?',[$operator,$id]);
        echo "Record updated successfully.<br/>";
        echo '<a href = "/view-records">Click Here</a> to go back.';
    }
}
