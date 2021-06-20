@extends('backend.master')
@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('shipping.index') }}">Shipping</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Create Shipping</h3>
                    </div>
                    <form action="{{ route('shipping.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group-material">
                            <input id="register-username1" type="text" value="{{ old('shipping_address') }}" name="shipping_address" class="input-material">
                            <label for="register-username1" class="label-material">Shipping Address</label>
                            @error('shipping_address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group-material">
                              <input id="register-username" type="date" value="{{ old('delivery_time') }}" name="delivery_time" class="input-material">

                              @error('delivery_time')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group-material">
                              <input id="register-username" type="number" value="{{ old('delivery_charge') }}" name="delivery_charge" class="input-material">
                              <label for="register-username" class="label-material">Shipping Charge</label>
                              @error('delivery_charge')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                        </div>
                        <div class="col-sm-6 ml-auto mt-3">
                            <select name="status" class="form-control">
                              <option value="active" {{ old('status')=='active'?'selected':'' }}>Active</option>
                              <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                            @error('status')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
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
