<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Product;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Imports\Imports;
use App\Exports\Exports;
use Excel;
session_start();

class ProductController extends Controller
{
  //user
  public function isAdmin() {
    $admin_id = Session::get('admin_id');
    if($admin_id) {
      return Redirect::to('dashboard');
    } else {
      return Redirect::to('admin')->send();
    }
  }
  public function add_product() {
    $this->isAdmin();
    $cate_pro = Category::where('category_status', '1')->get();
    return view('admin.add_product')->with('cate_pro', $cate_pro);
  }
  public function view_product() {
    $this->isAdmin();
    $all_products = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->get();
    $manage_product = view('admin.view_product')->with('all_products', $all_products);
    return view('admin_layout')->with('admin.view_product', $manage_product);
  }
  public function save_product(Request $request) {
    $this->isAdmin();
    $data = $request->all();

    $product = new Product();
    $product->product_name = $data['product_name'];
    $product->product_desc = $data['product_desc'];
    $product->product_content = $data['product_content'];
    $product->category_id = $data['product_category'];
    $product->product_price = $data['product_price'];
    $product->product_status = $data['product_status'];

    $get_image = $request->file('product_image');
    if($get_image){
      $get_name_image = $get_image->getClientOriginalName();
      $name_image = current(explode('.',$get_name_image));
      $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
      $get_image->move('public/upload/product',$new_image);
      $product->product_image = $new_image;
      $product->save();
      Session::put('msg', 'Add product successfully');
      return Redirect::to('add-product');
    }
    $product->product_image ='';
    $product->save();
    Session::put('msg', 'Add product successfully');
    return Redirect::to('add-product');
  }
  public function edit_product($product_id){
    $this->isAdmin();
    $cate_pro = Category::where('category_status', '1')->get();
    $edit_product = Product::where('product_id', $product_id)->first();
    $manage_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_pro', $cate_pro);
    return view('admin_layout')->with('admin.edit_product', $manage_product);
  }
  public function save_update_product(Request $request, $product_id) {
    $this->isAdmin();
    $data = $request->all();

    $product = Product::find($product_id);
    $product->product_name = $data['product_name'];
    $product->product_desc = $data['product_desc'];
    $product->product_content = $data['product_content'];
    $product->category_id = $data['product_category'];
    $product->product_price = $data['product_price'];
    $product->product_status = $data['product_status'];

    $get_image = $request->file('product_image');
    if($get_image){
      $get_name_image = $get_image->getClientOriginalName();
      $name_image = current(explode('.',$get_name_image));
      $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
      $get_image->move('public/upload/product',$new_image);
      $product->product_image = $new_image;
      $product->save();
      Session::put('msg', 'Update product successfully');
      return Redirect::to('view-product');
    }
    $product->save();
    Session::put('msg', 'Update product successfully');
    return Redirect::to('view-product');
  }
  public function delete_product($product_id){
    $this->isAdmin();
    Product::where('product_id', $product_id)->delete();
    Session::put('msg', 'Delete product successfully');
    return Redirect::to('view-product');
  }
  public function export_csv() {
    $this->isAdmin();
    return Excel::download(new Exports, 'product.xlsx');
  }
  public function import_csv(Request $request) {
    $path = $request->file('file')->getRealPath();
    Excel::import(new Imports, $path);
    return back();
  }
  public function search_product(Request $request) {
    $keywords = $request->search_keyword;

    $cate_product = Category::where('category_status','0')->orderby('category_id','desc')->get();

    $search_product = Product::where('product_name','like','%'.$keywords.'%')->get();
    $manage_product = view('admin.view_product')->with('cate_pro',$cate_product)->with('all_products',$search_product);

    return view('admin_layout')->with('admin.view_product', $manage_product);
  }
  //User
  public function show_product_detail($product_id) {
    $cate_pro = Category::where('category_status', '1')->get();
    $product_by_id = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->where('tbl_product.product_id', $product_id)->first();
    $related_product =  Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->where('tbl_product.category_id', $product_by_id->category_id)->where('tbl_product.product_status', '1')
    ->whereNotIn('tbl_product.product_id', [$product_id])->get();
    return view('pages.product.show_product_detail')->with('cate_pro', $cate_pro)
    ->with('product_detail', $product_by_id)->with('related_product', $related_product);
  }
}
