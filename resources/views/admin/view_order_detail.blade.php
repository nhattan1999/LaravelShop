@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">

  <div class="panel panel-default">
    <div class="panel-heading">
     Customer Information
   </div>

   <div class="table-responsive">
     <?php
 			$msg = Session::get('msg');
 			if($msg) {
 				echo $msg;
 				Session::put('msg', null);
 			}
 		 ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>

          <th>Customer name</th>
          <th>Phone number</th>
          <th>Email</th>


          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td>{{$order_by_id->customer_name}}</td>
          <td>{{$order_by_id->customer_phone}}</td>
          <td>{{$order_by_id->customer_email}}</td>

        </tr>

      </tbody>
    </table>

  </div>

</div>
</div>
<br>
<div class="table-agile-info">

  <div class="panel panel-default">
    <div class="panel-heading">
     Shipping information
   </div>


   <div class="table-responsive">
     <?php
 			$msg = Session::get('msg');
 			if($msg) {
 				echo $msg;
 				Session::put('msg', null);
 			}
 		 ?>
    <table class="table table-striped b-t b-light">
      <thead>
        <tr>

          <th>Recipient</th>
          <th>Address</th>
          <th>Phone number</th>
          <th>Email</th>


          <th style="width:30px;"></th>
        </tr>
      </thead>
      <tbody>

        <tr>
          <td>{{$order_by_id->shipping_name}}</td>
          <td>{{$order_by_id->shipping_address}}</td>
          <td>{{$order_by_id->shipping_phone}}</td>
          <td>{{$order_by_id->shipping_email}}</td>
        </tr>

      </tbody>
    </table>

  </div>

</div>
</div>
<br><br>

<div class="table-agile-info">

  <div class="panel panel-default">
    <div class="panel-heading">
      Order details
    </div>

    <div class="table-responsive">
      <?php
  			$msg = Session::get('msg');
  			if($msg) {
  				echo $msg;
  				Session::put('msg', null);
  			}
  		 ?>

      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total price</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($order_detail as $key => $details)
          <tr>

            <td>{{$details->product_name}}</td>
            <td>

              <input type="number" min="1"  value="{{$details->product_quantity}}" name="product_sales_quantity">

              <input type="hidden" name="order_qty_storage"  value="{{$details->product->product_quantity}}">

              <input type="hidden" name="order_id" class="order_code" value="{{$details->order_id}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">

            </td>
            <td>${{$details->product_price}}</td>
            <td>{{$details->product_price*$details->product_quantity}}</td>
          </tr>
          @endforeach

      </tbody>
    </table>
  </div>

</div>
</div>
@endsection
