@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
      <div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/trang-chu')}}">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div>

			<div class="register-req">
				<p>Please register to check out your bill</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Fill in your information</p>
							<div class="form-one">
								<form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                  {{csrf_field()}}
									<input type="email" name="shipping_email" placeholder="Email" value="{{$customer->customer_email}}"required>
									<input type="text" name="shipping_name" placeholder="Name" value="{{$customer->customer_name}}">
									<input type="text" name="shipping_address" placeholder="Address" required>
									<input type="text" name="shipping_phone" placeholder="Phone number" value="{{$customer->customer_phone}}" required>
                  <input type="submit" value="Confirm" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
							</div>
							</div>
						</div>

				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
@endsection
