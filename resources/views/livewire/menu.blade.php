<div>
    @foreach($products as $product)
    
    
    <div wire:key="{{$product->id}}">
        <h1>{{ $product->name }}</h1>
        <input type="hidden" id="id" value="{{$product->id}}">
        <input type="number" value="{{$cart[$product->id]??0}}">
        <div>
            <button type="submit" wire:click="add({{$product->id}},{{$cart[$product->id]??1}})">+</button>
            <button type="submit" wire:click="reduce({{$product->id}})">-</button>
        </div>
    </div>    
    
    @endforeach
    <form action="{{route('checkout')}}" method="post">
    @csrf
    <button type="submit">Cart</button>    
    </form>
</div>