<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;

class listaudit extends Model
{
    public $table = 'barcodelist';
    public $primaryKey = 'barcodeid';
    protected $fillable =     
    [
        'sonum','custID', 'status','operator','created_at'
    ];

    public function userReceiver()
    {
         return $userReceiver = DB::table('barcodelist')->where('carReceiverId', auth()->id())->get();
    }
}
