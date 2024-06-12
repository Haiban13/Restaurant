<?php

namespace App\Livewire;

use App\Http\Controllers\midtrans;
use App\Models\product;
use Livewire\Component;

class Cart extends Component
{

    public $cart;
    public $products=[];
    public $total;
    public $transactionToken=null;


    public function mount(){
        $this->cart=session("cart");
        $something= array_keys($this->cart) ;
        $this->getProductDetail();
        //var_dump($this->transactionToken);
        
        
        
        //var_dump(  $this->products) ;
        //$this->products=product::where();
    }

    public function getProductDetail(){
        $total=0;
        foreach(array_keys($this->cart) as $item){
            $item=product::where('id',$item)->first();
            
            if(isset($item) && $item != null){
                $total+=$item->price*$this->cart[$item->id];
                array_push($this->products,$item);
            }
        }
        $this->total=$total;
        //array_push($this->products,$total);
    }

    public function checkoutButton(){   
        $midtrans= new midtrans();
        $this->transactionToken = $midtrans->checkout();
        
        
    }
    
    public function render()
    {
        return view('livewire.cart') ;
    }
}

