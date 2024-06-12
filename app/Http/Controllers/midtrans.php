<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class midtrans extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $total;
    public $products=[];
    public $orderId;
   
    public function __construct( )
    {
       

    }
    


    public function index()
    {
       
        return view("cart");
    }

    public function getProductDetail(){
        $cart=session('cart');
        $something= array_keys($cart) ;
        
        $total=0;
        foreach(array_keys($cart) as $item){
            $item=product::where('id',$item)->first();
            
            if(isset($item) && $item != null){
                $total+=$item->price*$cart[$item->id];
                array_push($this->products,$item);
            }
        }
        $this->total=$total;
        //array_push($this->products,$total);
        
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
    public function checkout()
    {
        $this->getProductDetail();
        $products=$this->products;
        $total=$this->total;
        $order=new orderController;
        $orderId=$order->getOrderById(session('cart')["user_id"]);
       //dd( $total);
       // Set your Merchant Server Key
       \Midtrans\Config::$serverKey = config('midtrans.server_key');
       
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $orderId['id'],
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                 'user_id' => session('cart')['user_id'],
                 'name' =>"adfas"
              
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view("cart",compact('snapToken','products','total') );
    }


    public function callback(Request $request){

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
