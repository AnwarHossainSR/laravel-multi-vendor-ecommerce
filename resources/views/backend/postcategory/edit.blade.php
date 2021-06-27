@extends('backend.master')

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('postcategory.index') }}">Post Category</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Update Post Category</h3>
                    </div>
                    <form action="{{ route('postcategory.update',$postcategory->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="title" value="{{ $postcategory->title }}" class="input-material">
                            <label for="register-username" class="label-material">Title</label>
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group-material">
                                <label for="register-email" class="label-material ml-3">Status</label>
                                <div class="col-sm-12 ml-auto">
                                  <select name="status" class="form-control">
                                    <option value="active" {{ $postcategory->status =='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ $postcategory->status =='inactive'?'selected':'' }}>Inactive</option>
                                  </select>
                                  @error('status')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
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
@endsection
