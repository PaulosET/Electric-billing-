<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Setting;

class FrontendController extends Controller
{
    //

    public function index( ){
       
         $slider =Slider::where('status','0')->get();
         $newArrivalsProduct=Product::latest()->take(15)->get();
        $trendingProducts=Product::where('trending','1')->latest()->take(14)->get();
         $featuredProduct=Product::where('featured','1')->latest()->take(14)->get();
         $setting=Setting::first();
        return view('frontend.index',compact('slider','trendingProducts','newArrivalsProduct','featuredProduct','setting'));
    }
    public function searchProducts(Request $request){
     
        if($request->search)
        {
         $searchProducts=Product::where('name','Like','%'.$request->search.'%')->latest()->paginate(15);

         return view('frontend.pages.search',compact('searchProducts'));
        }
        else
        {
        return redirect()->back()->with('message','Empty Search');
        }

    }

     public function newArrival(){
       $newArrivalsProduct=Product::latest()->take(15)->get();

       return view('frontend.pages.new-arrival',compact('newArrivalsProduct'));
    }

    public function featuredProducts(){
        $featuredProduct=Product::where('featured','1')->latest()->take(15)->get();
        return view('frontend.pages.featured-products',compact('featuredProduct'));
     
    } 
    public function categories(){

        $catagories=Category::where('status','0')->get();
        return view('frontend.collections.category.index',compact('catagories'));
    }
    public function products($category_slug){
        $category=Category::where('slug',$category_slug)->first();
        if($category){
         
         return view('frontend.collections.products.index',compact('category'));
        }
        else{
           return redirect()->back();
        }
    }
    public function productview(string $category_slug, string $product_slug)
    {
        $category=Category::where('slug',$category_slug)->first();
        if($category){
           $product =$category->products()->where('slug',$product_slug)->where('status','0')->first(); 
           if($product){
                 return view('frontend.collections.products.view',compact('category','product'));
           }
        else{
          return redirect()->back();
        }
        }
        else{
          return redirect()->back();
        }
        
    }
    public function thankyou(){
        return view('frontend.thank-you');
    }
   
}
