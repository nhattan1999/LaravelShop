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
class CategoryProduct extends Controller
{
  //Admin
  public function isAdmin() {
    $admin_id = Session::get('admin_id');
    if($admin_id) {
      return Redirect::to('dashboard');
    } else {
      return Redirect::to('admin')->send();
    }
  }
  public function add_category() {
    $this->isAdmin();
    return view('admin.add_category_product');
  }
  public function view_category() {
    $this->isAdmin();
    $all_categories = Category::all();
    $manage_category_product = view('admin.view_category_product')->with('all_categories', $all_categories);
    return view('admin_layout')->with('admin.view_category_product', $manage_category_product);
  }
  public function save_category(Request $request) {
    $this->isAdmin();
    $data = $request->all();

    $category = new Category();
    $category->category_name = $data['category_name'];
    $category->category_desc = $data['category_desc'];
    $category->category_status = $data['category_status'];
    $category->save();
    Session::put('msg', 'Add category successfully');
    return Redirect::to('add-category');
  }
  public function edit_category($category_id){
    $this->isAdmin();
    $edit_category = Category::where('category_id', $category_id)->first();
    $manage_category_product = view('admin.edit_category_product')->with('edit_category', $edit_category);
    return view('admin_layout')->with('admin.edit_category_product', $manage_category_product);
  }
  public function save_update_category(Request $request, $category_id) {
    $this->isAdmin();
    $data = $request->all();

    $category = Category::find($category_id);
    $category->category_name = $data['category_name'];
    $category->category_desc = $data['category_desc'];
    $category->category_status = $data['category_status'];
    $category->save();
    Session::put('msg', 'Update category successfully');
    return Redirect::to('view-category');
  }
  public function delete_category($category_id){
    $this->isAdmin();
    DB::table('tbl_category_product')->where('category_id', $category_id)->delete();
    Session::put('msg', 'Delete category successfully');
    return Redirect::to('view-category');
  }

  //user
  public function show_category_home($category_id){
    $cate_pro = Category::where('category_status', '1')->get();
    $category_by_id = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
    ->where('tbl_product.category_id', $category_id)->where('tbl_product.product_status', '1')->get();
    $category_name = Category::where('category_id', $category_id)->first();

    return view('pages.category.show_category')->with('cate_pro', $cate_pro)->with('product', $category_by_id)->with('category_name', $category_name);
  }
}
