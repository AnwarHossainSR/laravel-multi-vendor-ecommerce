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
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Update order</h3>
                    </div>
                    <form action="{{ route('orders.update',$order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="register-email" class="label-material ml-3">Status</label>
                            <div class="col-sm-12 mt-3">
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                                    <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Processing</option>
                                    <option value="delivered" {{ $order->status=='delivered'?'selected':'' }}>Delivered</option>
                                    <option value="cancelled" {{ $order->status=='cancell'?'selected':'' }}>Cancelled</option>
                                </select>
                            </div>
                            @error('status')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                  </div>
                  <div class="col-sm-6">
                    <button id="login" class="btn btn-danger text-light mt-5">Change Status</button>
                  </div>
                </form>
                </div>
            </div>
		  </div>
		</div>
	  </div>
	</section>
  </div>

@endsection
