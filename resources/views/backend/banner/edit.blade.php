@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/table/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{asset('admin/summernote/summernote.min.css')}}">
@endpush

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('banner.index') }}">Banners</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Create Banner</h3>
                    </div>
                    <form action="{{route('banner.update',$banner->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="title" value="{{ $banner->title }}" required class="input-material">
                            <label for="register-username" class="label-material">Title</label>
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                          <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">Condition</label>
                            <div class="col-sm-12">
                              <select name="condition" class="form-control mb-3 mb-3">
                                <option value="banner" {{ $banner->condition == 'banner'?'selected':'' }}>Banner</option>
                                <option value="promo" {{ $banner->condition =='promo'?'selected':'' }}>Promotion</option>
                              </select>
                              @error('condition')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                            <div class="col-sm-12 ml-auto mt-3">
                              <select name="status" class="form-control">
                                <option value="active" {{ $banner->status =='active'?'selected':'' }}>Active</option>
                                <option value="inactive" {{ $banner->status =='inactive'?'selected':'' }}>Inactive</option>
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
                                <input id="thumbnail" value="{{ $banner->photo }}" class="form-control" type="text" name="photo">
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
                                <label class="label-material">Description</label>
                                <div class="col-lg-12">
                                    <textarea name="description" id="description"  required class="input-material" style="background-color:#22252A;border:1px solid #62666C">{{ $banner->description }}</textarea>
                                    @error('description')
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
