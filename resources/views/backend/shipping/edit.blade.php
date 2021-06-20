@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="{{asset('admin/summernote/summernote.min.css')}}">
@endpush

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('shipping.index') }}">Shippings</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Create shipping</h3>
                    </div>
                    <form action="{{route('shipping.update',$shipping->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="shipping_address" value="{{ $shipping->shipping_address }}" required class="input-material">
                            <label for="register-username" class="label-material">Address</label>
                            @error('shipping_address')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group-material">
                                @php
                                    $date = explode(' ',$shipping->delivery_time)
                                @endphp
                              <input id="register-username" type="date" name="delivery_time" value="{{ $shipping->delivery_time->format('Y-m-d') }}"  required class="input-material">
                              <label for="register-username" class="label-material">Delivery Time</label>
                              @error('delivery_time')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group-material">
                              <input id="register-username" type="number" name="delivery_charge" value="{{ $shipping->delivery_charge }}" required class="input-material">
                              <label for="register-username" class="label-material">Delivery Charge</label>
                              @error('delivery_charge')
                                  <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                        <div class="col-sm-6 ml-auto mt-3">
                            <select name="status" class="form-control">
                              <option value="active" {{ $shipping->status =='active'?'selected':'' }}>Active</option>
                              <option value="inactive" {{ $shipping->status =='inactive'?'selected':'' }}>Inactive</option>
                            </select>
                            @error('status')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                      </div>

                      <button id="login" class="btn btn-danger p-2 px-3 text-light">Update</button>
                    </form>
                </div>
            </div>
		  </div>
		</div>
	  </div>
	</section>
  </div>

@endsection

@section('script')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('admin/summernote/summernote.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('#lfm').filemanager('image');
            $('#description').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        } );
    </script>
@endsection
