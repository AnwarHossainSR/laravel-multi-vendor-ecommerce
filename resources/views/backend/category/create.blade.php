@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="{{asset('admin/summernote/summernote.min.css')}}">
@endpush

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('category.index') }}">Categories</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Create Category</h3>
                    </div>
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="title" class="input-material">
                            <label for="register-username" class="label-material">Title</label>
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="col-sm-12 mr-3 mt-3">
                            <label for="is_parent">Is Parent</label><br>
                            <input type="checkbox" name='is_parent' id='is_parent' value='1' checked> Yes
                              @error('is_parent')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>

                          <div class="form-group row mt-3">
                            <label for="register-email" class="label-material ml-3">Parent Category</label>
                            <div class="col-sm-12">
                                <select name="parent_id" class="form-control mb-3 mb-3">
                                    @foreach ($parent_cats as $cate)
                                    <option value="{{ $cate->id }}" {{ old('parent_id')==$cate->id ?'selected':'' }}>{{ $cate->title }}</option>
                                    @endforeach
                                </select>
                              @error('parent_id')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>

                          </div>

                          <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">Status</label>
                            <div class="col-sm-12">
                                <select name="status" class="form-control">
                                    <option value="active" {{ old('status')=='active'?'selected':'' }}>Active</option>
                                    <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>Inactive</option>
                                </select>
                              @error('status')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-danger text-light">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo">
                              </div>
                              <div id="holder" style="margin-top:15px;max-height:300px;">
                            </div>
                            @error('photo')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>

                      </div>
                      <div class="row mt-5">
                          <div class="col-md-12">
                            <div class="form-group-material">
                                <label class="label-material">Summery</label>
                                <div class="col-lg-12">
                                    <textarea name="summary" id="description" class="input-material" style="background-color:#22252A;border:1px solid #62666C"></textarea>
                                    @error('summary')
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
