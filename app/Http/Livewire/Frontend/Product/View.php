<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\wishlist;
use Auth;
use Livewire\Component;

class View extends Component
{
public $category,$product,$productColorSelectedQuantity,$quantityCount=1,$productColorId,$weightedproduct;


public function addToWishList($productId)
{
    if(Auth::check())
   {
    if(wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()){
   session()->flash('message','Already Added to wishlist');
     $this->dispatchBrowserEvent('message', ['text' => 'Already Added to wishlist',
                                            'type'=>'warning',
                                            'status'=>409
]);
   return false;
    }
    else
    {
    wishlist::create([
    'user_id'=>auth()->user()->id,
    'product_id'=>$productId
   ]);
    $this->emit('wishlistAddedUpdated');
    session()->flash('message','wishlist Added successfuly');
      $this->dispatchBrowserEvent('message', ['text' => 'wishlist Added successfuly',
                                            'type'=>'success',
                                            'status'=>200
]);
   }
}
   else{
    session()->flash('message','please Login to continue');
    $this->dispatchBrowserEvent('message', ['text' => 'please Login to continue',
                                            'type'=>'info',
                                            'status'=>401
]);
    return false;
   } 
   

}
  public function colorSelected($productColorId){
  $this->productColorId=$productColorId;
  $productColor=$this->product->productColors()->where('id',$productColorId)->first();

  $this->productColorSelectedQuantity=$productColor->quantity;  
  
 if($this->productColorSelectedQuantity==0){
    
    $this->productColorSelectedQuantity= 'outofstock';
 }
 
}



public function incrementQuantity(){
    if($this->quantityCount<20){
        $this->quantityCount++;
    }
      
}
public function decrementQuantity(){
    if($this->quantityCount>1){
        $this->quantityCount--;
    }
}

public function addToCart(int $productId){
   if (Auth::check()) {
    if ($this->product->where('id', $productId)->where('status', '0')->exists()) {
        if ($this->product->productColors()->count() >= 1) {
            if ($this->productColorSelectedQuantity != null) {
                $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();

                if (Cart::where('user_id', auth()->user()->id)
                    ->where('product_id', $productId)
                    ->where('product_color_id', $this->productColorId)
                    ->exists()) 
                    {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Already Added',
                        'type' => 'warning',
                        'status' => 200
                    ]);
                } else {
                    if ($productColor->quantity > 0) {
                        if ($productColor->quantity >= $this->quantityCount) {
                            Cart::create([
                                'user_id' => auth()->user()->id,
                                'product_id' => $productId,
                                'product_color_id' => $this->productColorId,
                                'quantity' => $this->quantityCount
                            ]);
                            $this->emit('CartAddedUpdated');
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Added to Cart',
                                'type' => 'success',
                                'status' => 200
                            ]);
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Only ' . $productColor->quantity . ' Quantity Available',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Out of Stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Select Your Product Color',
                    'type' => 'info',
                    'status' => 404
                ]);
            }
        } else {
            if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product Already Added',
                    'type' => 'warning',
                    'status' => 200
                ]);
            } else {
                if ($this->product->quantity > 0) {
                    if ($this->product->quantity >= $this->quantityCount) {
                        Cart::create([
                            'user_id' => auth()->user()->id,
                            'product_id' => $productId,
                            'quantity' => $this->quantityCount
                        ]);
                        $this->emit('CartAddedUpdated');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product Added to Cart',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Only ' . $this->product->quantity . ' Quantity Available',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                } else {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Product Out of Stock',
                        'type' => 'warning',
                        'status' => 404
                    ]);
                }
            }
        }
    } else {
        $this->dispatchBrowserEvent('message', [
            'text' => 'Product Doesn\'t exist',
            'type' => 'warning',
            'status' => 404
        ]);
    }
} else {
    $this->dispatchBrowserEvent('message', [
        'text' => 'Please Login to Add to Cart',
        'type' => 'info',
        'status' => 401
    ]);
}


}

    public function mount($category,$product){

        $this->category=$category;
        $this->product=$product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category'=>$this->category,
            'product'=>$this->product
        ]);
    }
}
