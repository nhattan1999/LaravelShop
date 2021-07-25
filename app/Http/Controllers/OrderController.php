<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;

session_start();


class OrderController extends Controller
{
    public function isAdmin() {
      $admin_id = Session::get('admin_id');
      if($admin_id) {
        return Redirect::to('dashboard');
      } else {
        return Redirect::to('admin')->send();
      }
    }
    public function view_order() {
      $this->isAdmin();
      $all_order = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
      ->select('tbl_order.*','tbl_customers.customer_name')
      ->orderby('tbl_order.order_id','desc')->get();
      $manager_order  = view('admin.manage_order')->with('all_order',$all_order);
      return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function edit_order($order_id) {
      $this->isAdmin();
      //$order_by_id = Order::where('order_id', $order_id)->get();
      $order_detail = OrderDetail::where('order_id',  $order_id) -> get();
      $order_by_id = Order::join('tbl_customers','tbl_order.customer_id','=','tbl_customers.customer_id')
      ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
      ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*')
      ->where('tbl_order.order_id', $order_id)->first();
      $manager_order_by_id  = view('admin.view_order_detail')->with('order_by_id',$order_by_id)->with('order_detail',$order_detail);
      return view('admin_layout')->with('admin.view_order_detail', $manager_order_by_id);
    }
    public function delete_order($order_id) {
      $this->isAdmin();
      Order::where('order_id', $order_id)->delete();
      Session::put('msg', 'Delete order successfully');
      return Redirect::to('view-order');
    }

}
