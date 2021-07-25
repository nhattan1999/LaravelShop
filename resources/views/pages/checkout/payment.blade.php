@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
      <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
				  <li class="active">Payment</li>
				</ol>
			</div>
		  <div class="review-payment">
        <h2>Confirm your cart</h2>
      </div>
      <div class="table-responsive cart_info">
        <?php
           $content = Cart::content();
         ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
              <td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
            @foreach ($content as $key => $c)
            <tr>
              <td class="cart_product">
                <a href=""><img src="{{URL::to('public/upload/product/'.$c->options->image)}}" width="50" alt=""></a>
              </td>
              <td class="cart_description">
                <h4><a href="">{{$c->name}}</a></h4>
              </td>
              <td class="cart_price">
                <p>${{$c->price}}</p>
              </td>
              <td class="cart_quantity">
                <div class="cart_quantity_button">
                  <form action="{{URL::to('/update-cart-quantity')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="cart_rowId" value="{{$c->rowId}}" class="form-control">
                    <input class="cart_quantity_input" type="text" name="new_quantity" value="{{$c->qty}}" autocomplete="off" size="2">
                    <input type="submit" name="Update" value="Update" class="btn btn-default btn-sm">
                  </form>

                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">${{$c->subtotal()}}</p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href="{{URL::to('/delete-cart/'.$c->rowId)}}"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            @endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="total_area">
							<a href="{{URL::to('/order')}}" class="btn btn-default check_out"><i class="fa fa-user"></i> Order and print bill</a>
					</div>
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection
