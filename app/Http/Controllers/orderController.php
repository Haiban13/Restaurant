<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function getOrderById($id){
        $order=order::where('user_id',$id)->first();
        return $order;
    }

    public function update(Request $request,$id){
        
    }

    public function create(Request $request,$id){
        $order=new order;
        $order->user_id=$request->user_id;
        $order->payment_status=$request->payment_status;
 
        $order->save();
        
        
    }
}
