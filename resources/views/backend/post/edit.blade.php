@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="{{asset('admin/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin') }}/switch-button-bootstrap/css/bootstrap-switch-button.css">
@endpush

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('post.index') }}">Posts</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-header">
                    @include('backend.include.notification')
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3 class="display-6">Update post</h3>
                    </div>
                    <form action="{{ route('post.update',$post->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group-material">
                                <input id="register-username" type="text" name="title" class="input-material" value="{{ $post->title }}">
                                <label for="register-username" class="label-material">Title</label>
                                @error('title')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Category</label>
                                <div class="col-sm-12">
                                    <select name="post_cat_id" id="cat_id" class="form-control mb-3 mb-3">
                                        <option > -- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $post->post_cat_id ? 'selected':'' }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                  @error('post_cat_id')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Tag</label>
                                <div class="col-sm-12">
                                    <select name="tags[]" multiple  data-live-search="true" class="form-control mb-3 mb-3 selectpicker">
                                        @php
                                            $post_tags=explode(',',$post->tags);
                                            // dd($tags);
                                        @endphp
                                        <option value="">--Select any tag--</option>
                                        @foreach($tags as $key=>$data)
                                            <option value='{{$data->title}}' {{in_array( "$data->title",$post_tags )  ? 'selected' : ''}}>{{$data->title}}</option>
                                        @endforeach
                                    </select>
                                  @error('tags')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Author</label>
                                <div class="col-sm-12">
                                    <select name="added_by" class="form-control">
                                        <option value="">--Select any one--</option>
                                        @foreach($users as $key=>$data)
                                          <option value='{{$data->id}}' {{($data->id==$post->added_by) ? 'selected' : ''}}>{{$data->full_name}}</option>
                                      @endforeach
                                    </select>
                                  @error('added_by')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Status</label>
                                <div class="col-sm-12">
                                    <select name="status" class="form-control">
                                        <option value="active" {{ $post->status=='active'?'selected':'' }}>Active</option>
                                        <option value="inactive" {{ $post->status=='inactive'?'selected':'' }}>Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <p class="label-material">Photo</p>
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-danger text-light">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{$post->photo}}">
                                @error('photo')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                              {{-- <div id="holder" style="margin-top:15px;height:300px;width:300px"> --}}

                            </div>

                        </div>

                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group-material">
                              <label class="label-material ml-2">Quote</label>
                              <div class="col-lg-12">
                                  <textarea id="quote" name="quote" class="input-material summary" style="background-color:#22252A;border:1px solid #62666C">{{ $post->quote }}</textarea>
                                  @error('quote')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>
                            </div>
                        </div>
                    </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group-material">
                              <label class="label-material ml-2">Summary</label>
                              <div class="col-lg-12">
                                  <textarea name="summary" class="input-material summary" style="background-color:#22252A;border:1px solid #62666C">{{  $post->summary }}</textarea>
                                  @error('summary')
                                      <span class="text-danger">{{$message}}</span>
                                  @enderror
                              </div>
                            </div>
                        </div>
                    </div>


                      <div class="row mt-2">
                          <div class="col-md-12">
                            <div class="form-group-material">
                                <label class="label-material ml-2">Description</label>
                                <div class="col-lg-12">
                                    <textarea name="description" class="input-material summary" style="background-color:#22252A;border:1px solid #62666C">{{ $post->description }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row mt-2 ml-1">
                        <div class="col-md-12">
                          <div class="form-group-material">
                              <button type="reset" class="btn btn-outline-warning">Reset</button>
                            </div>
                        </div>
                    </div>

                      <div class="mx-4 my-2 d-flex justify-content-center">

                        <button id="login" class="btn btn-outline-danger text-light">Create</button>
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

@section('script')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{asset('admin/summernote/summernote.min.js')}}"></script>
    <script src="{{ asset('admin') }}/switch-button-bootstrap/src/bootstrap-switch-button.js"></script>

    <script>
        $(document).ready(function() {
            $('#lfm').filemanager('image');
            $('.summary').summernote({
                placeholder: "Write here.....",
                tabsize: 2,
                height: 140
            });
        } );
    </script>
    <script>
        $('#cat_id').change(function(){
               var cat_id = $(this).val()
               if(cat_id != null){
                    $.ajax({
                    url:'/admin/category/'+cat_id+'/child',
                    type:'POST',
                    data:{
                        _token:'{{ csrf_token() }}',
                        cat_id:cat_id,
                    },
                    success:function(response){
                        var html_option = "<option value=''> -- select child category -- </option>"
                        if(response.status == true){
                            $('#child_cat_div').removeClass('d-none')
                            $.each(response.data,function(id,title){
                                html_option += "<option value='"+id+"'>"+title+"</option>"
                            })
                        }else{
                            $('#child_cat_div').addClass('d-none')
                        }
                        $('#child_cat_id').html(html_option)
                    }
                });
               }
           });
    </script>
@endsection
