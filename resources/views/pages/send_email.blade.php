<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>
    </title>
    <style>body{
      font-family: DejaVu Sans;
    }
    .table-styling{
      border:1px solid #000;
    }
    .table-styling tbody tr td{
      border:1px solid #000;
    }
    </style>
  </head>
  <body>
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
      <tbody>
        <tr>
          <td>{{$customer->customer_name}}</td>
          <td>{{$customer->customer_phone}}</td>
          <td>{{$customer->customer_email}}</td>
        </tr>
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
      <tbody>
        <tr>
      		<td>{{$shipping->shipping_name}}</td>
      		<td>{{$shipping->shipping_address}}</td>
      		<td>{{$shipping->shipping_phone}}</td>
      		<td>{{$shipping->shipping_email}}</td>
    		</tr>
      </tbody>
    </table>
    <p>Ordered products</p>
    <table class="table-styling">
      <thead>
        <tr>
          <th>Product name</th>
          <th>Quantity</th>
          <th>Price (per each)</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>


    		@foreach($order_detail_product as $key => $product)
    			<tr>
      			<td>{{$product->product_name}}</td>
      			<td>{{$product->product_quantity}}</td>
      			<td>{{$product->product_price}}</td>
      			<td>{{$product->product_quantity*$product->product_price}}</td>
    			</tr>
        @endforeach
      </tbody>

    </table>
    <p>=> Your total price is: {{$order->order_total}}</p>
    <br>
    <p>Thank you for purchasing products at our shop.</p>
    <p>Please always check your email and phone to receive our shipping call.</p>
    <p>Have a good day.</p>
  </body>
</html>
