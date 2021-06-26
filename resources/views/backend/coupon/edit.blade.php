@extends('backend.master')


@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('coupon.index') }}">Coupons</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Update Coupon</h3>
                    </div>
                    <form action="{{ route('coupon.update',$coupon->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group-material mt-2">
                        <input id="register-username" type="text" value="{{ $coupon->code }}" name="code" class="input-material">
                        <label for="register-username" class="label-material">Code</label>
                        @error('code')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>

                      <div class="form-group-material mt-5">
                        <input id="register-username" type="text" name="value" value="{{ $coupon->value }}" class="input-material">
                        <label for="register-username" class="label-material">Coupon Value</label>
                        @error('value')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">Coupon Type</label>
                            <div class="col-sm-12">
                                <select name="type" class="form-control">
                                    <option value="fixed" {{ $coupon->type =='fixed'?'selected':'' }}>Fixed</option>
                                    <option value="percent" {{  $coupon->type =='percent'?'selected':'' }}>percent</option>
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
                                    <option value="active" {{  $coupon->status =='active'?'selected':'' }}>Active</option>
                                    <option value="inactive"  {{ $coupon->status =='inactive'?'selected':'' }}>Inactive</option>
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

