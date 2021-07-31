<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Product;

use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index() {
      $cate_pro = Category::where('category_status', '1')->get();
      $product = Product::where('product_status', '1')->orderby('product_id', 'desc')->limit(3)->get();
      return view('pages.home')->with('cate_pro', $cate_pro)->with('product', $product);
    }
    public function find_product(Request $request) {
      $keywords = $request->search_keyword;

      $cate_product = Category::where('category_status','1')->get();

      $search_product = Product::where('product_name','like','%'.$keywords.'%')->get();

      return view('pages.product.find_product')->with('cate_pro',$cate_product)->with('product',$search_product);
    }
}
