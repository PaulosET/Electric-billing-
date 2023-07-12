<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\wishlist;
use Illuminate\Http\Request;

class WishListController extends Controller
{
   public function index(){
   
    return view('frontend.wishlist.index');
   }
}
