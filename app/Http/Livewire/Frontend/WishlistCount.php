<?php

namespace App\Http\Livewire\Frontend;

use App\Models\wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistCount extends Component
{

    //wishlistAddedUpdated 
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];
    public $wishlistCount;
    public function checkWishlistCount()
    {
      if(Auth::check()){
        return $this->wishlistCount=wishlist::where('user_id',auth()->user()->id)->count();
      }
      else{
        return $this->wishlistCount=0;
      }
    }
    public function render()
    {
       $this->wishlistCount= $this->checkWishlistCount();
        return view('livewire.frontend.wishlist-count',[
                           'wishlistCount'=>$this->wishlistCount  
        ]);

    }
}
