<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use PDF;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use Mail;
session_start();

class CheckoutController extends Controller
{
    public function isAdmin() {
      $admin_id = Session::get('admin_id');
      if($admin_id) {
        return Redirect::to('dashboard');
      } else {
        return Redirect::to('admin')->send();
      }
    }
    public function login_checkout() {
        $cate_pro = Category::where('category_status', '1')->get();
        return view('pages.checkout.login_checkout')->with('cate_pro', $cate_pro);
    }
    public function add_customer(Request $request) {
        $data = $request->all();

        $customer = new Customer();
        $customer->customer_name = $data['customer_name'];
        $customer->customer_email = $data['customer_email'];
        $customer->customer_password = md5($data['customer_password']);
        $customer->customer_phone = $data['customer_phone'];
        $customer_id = Customer::insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);

        return Redirect::to('/checkout');
    }
    public function checkout() {
      $cate_pro = Category::where('category_status', '1')->get();
      return view('pages.checkout.checkout')->with('cate_pro', $cate_pro);
    }
    public function save_checkout_customer(Request $request) {
       $data = $request->all();
       $shipping = array();
       $shipping['shipping_name'] = $data['shipping_name'];
       $shipping['shipping_phone'] = $data['shipping_phone'];
       $shipping['shipping_email'] = $data['shipping_email'];
       $shipping['shipping_address'] = $data['shipping_address'];

       $shipping_id = Shipping::insertGetId($shipping);

       Session::put('shipping_id',$shipping_id);

       return Redirect::to('/payment');
    }
    public function payment() {
      $cate_pro = Category::where('category_status', '1')->get();
      return view('pages.checkout.payment')->with('cate_pro', $cate_pro);
    }
    public function logout_checkout() {
       Session::flush();
       return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request) {
      $result = Customer::where('customer_email', $request->email_account)->where('customer_password', md5($request->password_account))->first();
      if($result) {
        Session::put('customer_name', $result->customer_name);
        Session::put('customer_id', $result->customer_id);
        return Redirect::to('/checkout');
      } else {
        Session::put('msg', 'Email or Password is INCORRECT!!!');
        return Redirect::to('/login-checkout');
      }
    }
    public function order() {
      //insert order
      $order_data = array();
      $order_data['customer_id'] = Session::get('customer_id');
      $order_data['shipping_id'] = Session::get('shipping_id');
      $order_data['order_total'] = Cart::subtotal();
      $order_id = Order::insertGetId($order_data);

      //insert order_details
      $content = Cart::content();
      foreach($content as $order_content){
        $order_d_data['order_id'] = $order_id;
        $order_d_data['product_id'] = $order_content->id;
        $order_d_data['product_name'] = $order_content->name;
        $order_d_data['product_price'] = $order_content->price;
        $order_d_data['product_quantity'] = $order_content->qty;
        OrderDetail::insert($order_d_data);
      }
      $pdf = \App::make('dompdf.wrapper');
      $this->send_email($order_id);
  		$pdf->loadHTML($this->print_order_convert($order_id));
  		return $pdf->stream();
    }
    public function print_order_convert($order_id){
    		$order_detail = OrderDetail::where('order_id',$order_id)->get();
    		$order = Order::where('order_id',$order_id)->get();
    		foreach($order as $key => $ord){
    			$customer_id = $ord->customer_id;
    			$shipping_id = $ord->shipping_id;
    		}
    		$customer = Customer::where('customer_id',$customer_id)->first();
    		$shipping = Shipping::where('shipping_id',$shipping_id)->first();

    		$order_detail_product = OrderDetail::with('product')->where('order_id', $order_id)->get();


    		$output = '';

    		$output.='<style>body{
    			font-family: DejaVu Sans;
    		}
    		.table-styling{
    			border:1px solid #000;
    		}
    		.table-styling tbody tr td{
    			border:1px solid #000;
    		}
    		</style>
    		<h1><center>HYAGO SHOP</center></h1>
    		<p>Order person</p>
    		<table class="table-styling">
    		<thead>
    		<tr>
    		<th>Full name</th>
    		<th>Phone number</th>
    		<th>Email</th>
    		</tr>
    		</thead>
    		<tbody>';

    		$output.='
    		<tr>
    		<td>'.$customer->customer_name.'</td>
    		<td>'.$customer->customer_phone.'</td>
    		<td>'.$customer->customer_email.'</td>

    		</tr>';


    		$output.='
    		</tbody>

    		</table>

    		<p>Shipping to</p>
    		<table class="table-styling">
    		<thead>
    		<tr>
    		<th>Recipient name</th>
    		<th>Address</th>
    		<th>Phone number</th>
    		<th>Email</th>
    		</tr>
    		</thead>
    		<tbody>';

    		$output.='
    		<tr>
    		<td>'.$shipping->shipping_name.'</td>
    		<td>'.$shipping->shipping_address.'</td>
    		<td>'.$shipping->shipping_phone.'</td>
    		<td>'.$shipping->shipping_email.'</td>

    		</tr>';


    		$output.='
    		</tbody>

    		</table>

    		<p>Ordered products</p>
    		<table class="table-styling">
    		<thead>
    		<tr>
    		<th>Product name</th>>
    		<th>Quantity</th>
    		<th>Price (per each)</th>
    		<th>Total</th>
    		</tr>
    		</thead>
    		<tbody>';

    		$total = 0;

    		foreach($order_detail_product as $key => $product){

    			$subtotal = $product->product_price*$product->product_quantity;
          $total += $subtotal;

    			$output.='
    			<tr>
    			<td>'.$product->product_name.'</td>
    			<td>'.$product->product_quantity.'</td>
    			<td>'.$product->product_price.'</td>
    			<td>'.$subtotal.'</td>

    			</tr>';
    		}



    		$output.='
    		</tbody>

    		</table>
        <p>=> Your total price is:'.$total.'</p> ';
        $output.='
        <br>
    		<p>Thank you for purchasing products at our shop.</p>
    		<p>Please always check your email and phone to receive our shipping call.</p>
        <p>Have a good day.</p>

    		';

        Cart::destroy();
    		return $output;

	     }

       public function send_email($order_id) {

         $order_detail = OrderDetail::where('order_id',$order_id)->get();
       	 $order = Order::where('order_id',$order_id)->first();
       	 $customer = Customer::where('customer_id',$order->customer_id)->first();
       	 $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();
         $to_name = "Hyago Shop";
         $to_email = $shipping->shipping_email;//send to this email
       	 $order_detail_product = OrderDetail::with('product')->where('order_id', $order_id)->get();

         $data = array("order" => $order, "customer"=> $customer, "shipping" => $shipping, "order_detail_product"=> $order_detail_product ); //body of mail.blade.php
         Mail::send('pages.send_email', $data, function($message) use ($to_name,$to_email){
             $message->to($to_email)->subject('Your order!!!');//send this mail with subject
             $message->from($to_email,$to_name);//send from this mail
         });

       }

}
