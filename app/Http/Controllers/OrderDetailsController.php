<?php

namespace App\Http\Controllers;

use App\Models\orderDetails;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $orderDetails= new orderDetails();
        $orderDetails->order_id=$request->order_id;
        $orderDetails->product_id=$request->product_id;
        $orderDetails->quantity=$request->quantity;

        $orderDetails->save();
        return route('product.menu');
                      
    }

    /**
     * Display the specified resource.
     */
    public function show(orderDetails $orderDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orderDetails $orderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orderDetails $orderDetails)
    {
        $orderDetails = new orderDetails();
        $orderDetails->quantity= $request->quantity;
        $orderDetails->save();
        return route('product.index');
    }

    public function addQuantity(Request $request, $id){
        $orderDetails = orderDetails::where('order_id', $id)->first();
        dd($orderDetails);
        if ($orderDetails) {
            $orderDetails->quantity = $orderDetails->quantity + 1;
        } else {
            $orderDetails = new orderDetails();
            $orderDetails->order_id = $request->order_id;
            $orderDetails->product_id = $request->product_id;
            $orderDetails->quantity = 1;
        }
        $orderDetails->save();
        return redirect()->route('product.index');
    }
    
    public function reduceQuantity(Request $request, $id){
        $orderDetails = orderDetails::where('order_id', $request->order_id)->first();
        if ($orderDetails && $orderDetails->quantity > 0) {
            $orderDetails->quantity = $orderDetails->quantity - 1;
            $orderDetails->save();
        }
        return redirect()->route('product.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orderDetails $orderDetails)
    {
        //
    }
}
