<?php

namespace App\Livewire;

use App\Models\product;
use Illuminate\Http\Request;
use Livewire\Component;

class menu extends Component
{
    public $cart;
    public $products;
 

    public function mount(){
        $this->cart=session("cart");
//        dd($this->cart);
        $this->products=product::all();
    }


    public function add($productId,$quantity){
//        dd($this->cart);
        if(!isset($this->cart[$productId])){
            $this->cart[$productId]=$quantity;

        }else{
            $this->cart[$productId]++;
        }
        session()->put("cart", $this->cart);
        return $this->cart[$productId];
    }

    public function reduce($productId){
        if(isset($this->cart[$productId]) && $this->cart[$productId] >=1 ){
            $this->cart[$productId]--;
        }
        session()->put("cart", $this->cart);
        return $this->cart[$productId];
    }


    


    public function render()
    {
        return view('livewire.menu');
 
    }
}
