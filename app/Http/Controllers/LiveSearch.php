<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LiveSearch extends Controller
{
    function index()
    {
		$so = DB::table('moresolist')
      ->select('sonum')
      ->groupBy('sonum')
      ->get();

      return view('BS.live_search', compact('so'));

    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('moresolist')
         ->where('stockcode', 'like', '%'.$query.'%')
         ->orWhere('sonum', 'like', '%'.$query.'%')
         ->orWhere('particular', 'like', '%'.$query.'%')
		     ->where('trxstatus','A')
         ->orderBy('id')
         ->get();
         
      }
      else
      {
       $data = DB::table('moresolist')
		     ->where('trxstatus','A')
         ->orderBy('id')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
        
         <td>'.$row->stockcode.'</td>
         <td>'.$row->sonum.'</td>
         <td>'.$row->particular.'</td>
         <td>'.ceil($row->total).'</td>
         <td align="center">
         <a href=print2/'.$row->stockcode.'/'.$row->sonum.'>
         <button class="btn btn-warning">Select</button>
         </a>
         </td>
		  <td align="center">
         <a href=printsmb/'.$row->stockcode.'/'.$row->sonum.'>
         <button class="btn btn-warning">Select</button>
         </a>
         </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }

    function index2()
    {
     return view('BS.live_search2');
    }

    function action2(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('solist')
         ->where('sonum', 'like', '%'.$query.'%')
		 
         ->orWhere('refnum', 'like', '%'.$query.'%')
         ->orWhere('shipmark', 'like', '%'.$query.'%')
		  ->where('trxstatus','A')
         ->orderBy('id')
		   
         ->get();
         
      }
      else
      {
      $data = DB::table('moresolist')
		  
		 
		  ->select('sonum', DB::raw('count(*) as total'))
                 ->groupBy('sonum')
		 
        ->where('trxstatus','A')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
        $i = 1;
       foreach($data as $row)
       {
		   
        $prints = DB::table('moresolist')->where('sonum', '=',  $row->sonum)->count();
        $prints2 = DB::table('moresolist')->where('sonum', '=',  $row->sonum)->whereNotNull('asgnto')->where('asgnto', '!=',  '')->count();
		 if($prints != 0){
        $var = ( $prints2/$prints );
		 }
		   else{
			$var = $prints2;   
		   }
        $var2 = $var * 100;
        $var3 = (int)$var2;

        if ($var3 == 100){
          $output .=
          '<tr hidden>
           <td style="width:10px" hidden>'.$i++.'</td>
           <td hidden>'.$row->sonum.'</td>
           <td hidden></td>
           <td style="width:200px" hidden>  <div class="progress" hidden>
           <div class="progress-bar progress-bar-striped active" role="progressbar"
               aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
               style="width:'.$var3.'%; color:black; background-color:yellow" hidden>'.$var3.'%
           </div>
          </div></td>
          <td align="center"style="width:200px" hidden>
          <a style="text-align:center" href=show/'.$row->sonum.' hidden>
              <button class="btn btn-info" style="width:130px" hidden> View / Assign </button>
          </a>
          <br>
          <a style="text-align:center" href=searchtrack/'.$row->sonum.' hidden>
          <button class="btn btn-danger" style="width:130px" hidden>Tracking</button>
          </a>
           </td>
          </tr>
          ';
        }else{
        $output .=
        '<tr>
         <td style="width:10px">'.$i++.'</td>
         <td>'.$row->sonum.'</td>
         <td></td>
         <td style="width:200px">  <div class="progress">
         <div class="progress-bar progress-bar-striped active" role="progressbar"
             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
             style="width:'.$var3.'%; color:black; background-color:yellow">'.$var3.'%
         </div>
        </div></td>
        <td align="center"style="width:200px">
        <a style="text-align:center" href=show/'.$row->sonum.'>
            <button class="btn btn-info" style="width:130px"> View / Assign </button>
        </a>
        <br>
        <a style="text-align:center" href=searchtrack/'.$row->sonum.'>
        <button class="btn btn-danger" style="width:130px" >Tracking</button>
        </a>
         </td>
        </tr>
        ';
        }
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row,
      );
      echo json_encode($data);
     }
    }
	
	public function getstockcode(\Illuminate\Http\Request $request)
    {
      $sonum = explode(',', $request->sonum);

		$data = DB::table('moresolist')
      ->select('sonum','stockcode')
      ->whereIn('sonum',  $sonum)
      //->where('shipmark','KMB')
		
      ->groupBy('stockcode','sonum')
      ->get();
      return response()->json($data);
    }
}