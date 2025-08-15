<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class moresolist extends Model
{
    //
      //
      protected $fillable = ['total'];

      public function orderCols(){
     
        return $this->belongsToMany(moresolists::class);
      }
  
      public  static function createOrder(){
         $user = Auth::user();
         $order = $user->orders()->create([
           'total' => Cart::total()
         ]); // insert order table data
  
         // place order and insert data to orders_products
         foreach(Cart::content() as $cData){
           $order->orderCols()->attach($cData->id,[
             'total' => $cData->qty * $cData->price,
             'qty' => $cData->qty
           ]);
         }
  
         Cart::destroy(); // make cart empty
      }
  
  
      public function orders_products(){
        return $this->hasMany('App\orders_products', 'orders_id');
      }

    
}
