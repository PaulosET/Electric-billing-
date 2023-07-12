<?php

namespace App\Http\Livewire\Frontend;

use App\Models\wishlist;
use Livewire\Component;

class WishlistShow extends Component
{
    public function removeWishlistItem($wishlistid){
      
        Wishlist::where('user_id',auth()->user()->id)->where('id',$wishlistid)->delete();
        $this->emit('wishlistAddedUpdated');
        session()->flash('message','wishlist Item Removed Successfully');
         
        $this->dispatchBrowserEvent('message',[
            'text'=>'wishlist Added successfully',
            'type'=>'success',
            'status'=>200
        ]);
    }
    public function render()
    {
    $wishlist=wishlist::where('user_id',auth()->user()->id)->get(); 
        return view('livewire.frontend.wishlist-show',[
                        'wishlist'=>$wishlist
        ]);
    }
}
