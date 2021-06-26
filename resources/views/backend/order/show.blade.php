@extends('backend.master')


@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('orders.index') }}">Orders</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <h5 class="text-danger">User Note</h5>
                    <p>{{ $order->note }}</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="">
                                <h5 class="display-6 text-danger">Order Detaile</h5>
                            </div>
                            <h5>Order No : {{ $order->order_number }}</h5>
                            <h5>Sub Total : {{ $order->sub_total }}</h5>
                            <h5>Delivery Cost : {{ $order->delivery_charge }}</h5>
                            <h5>Total Amount : {{ $order->total_amount }}</h5>
                            <h5>Order No : {{ $order->order_number }}</h5>
                            <h5>Status : {{ $order->payment_status }}</h5>
                            <h5>Payment Type : {{ $order->payment_method }}</h5>
                            <h5>Ordered By : {{ $order->user->full_name }}</h5>
                        </div>
                        <div class="col-sm-6">
                            <div class="">
                                <h5 class="display-6 text-danger">Shipping Detaile</h5>
                            </div>
                            <h5>Name : {{ $order->first_name.' '.$order->last_name }}</h5>
                            <h5>Email : {{ $order->email }}</h5>
                            <h5>Address : {{ $order->saddress }}</h5>
                            <h5>State : {{ $order->sstate }}</h5>
                            <h5>City : {{ $order->scity }}</h5>
                            <h5>Phone : {{ $order->phone }}</h5>
                            <h5>Postcode : {{ $order->spostcode }}</h5>
                            <h5>Country : {{ $order->scountry }}</h5>
                        </div>
                    </div>
                </div>
            </div>
		  </div>
		</div>
	  </div>
	</section>
  </div>

@endsection

@extends('backend.master')


@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('orders.index') }}">orders</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Update order</h3>
                    </div>
                    <form action="{{ route('orders.update',$order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group-material mt-2">
                        <input id="register-username" type="text" value="{{ $order->code }}" name="code" class="input-material">
                        <label for="register-username" class="label-material">Code</label>
                        @error('code')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                      <div class="form-group-material mt-5">
                        <input id="register-username" type="text" name="value" value="{{ $order->value }}" class="input-material">
                        <label for="register-username" class="label-material">order Value</label>
                        @error('value')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">order Type</label>
                            <div class="col-sm-12">
                                <select name="type" class="form-control">
                                    <option value="fixed" {{ $order->type =='fixed'?'selected':'' }}>Fixed</option>
                                    <option value="percent" {{  $order->type =='percent'?'selected':'' }}>percent</option>
                                </select>
                              @error('type')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>


                          <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">Status</label>
                            <div class="col-sm-12">
                                <select name="status" class="form-control">
                                    <option value="active" {{  $order->status =='active'?'selected':'' }}>Active</option>
                                    <option value="inactive"  {{ $order->status =='inactive'?'selected':'' }}>Inactive</option>
                                </select>
                              @error('status')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                    </div>
                  </div>
                  <button id="login" class="btn btn-danger p-2 px-3 text-light">Create</button>
                </form>
                </div>
            </div>
		  </div>
		</div>
	  </div>
	</section>
  </div>

@endsection


