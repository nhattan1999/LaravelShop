<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Category;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();

class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $product = Product::where('product_id', $request->productIdCart)->first();

        $data['id'] = $request->productIdCart;
        $data['qty'] = $request->quantity;
        $data['name'] = $product->product_name;
        $data['price'] = $product->product_price;
        $data['weight'] = 80;
        $data['options']['image']= $product->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');

    }
    public function show_cart() {
        $cate_pro = Category::where('category_status', '1')->get();
        return view('pages.cart.show_cart')->with('cate_pro', $cate_pro);
    }
    public function delete_cart($row_id) {
        Cart::remove($row_id);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        Cart::update($request->cart_rowId, $request->new_quantity);
        return Redirect::to('/show-cart');
    }
}
