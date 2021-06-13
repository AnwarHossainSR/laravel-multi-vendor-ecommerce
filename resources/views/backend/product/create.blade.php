@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="{{asset('admin/summernote/summernote.min.css')}}">
    <link rel="stylesheet" href="{{ asset('admin') }}/switch-button-bootstrap/css/bootstrap-switch-button.css">
@endpush

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;<a href="{{ route('product.index') }}">Products</a></h2>
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
                        <h3 class="display-6">Add Product</h3>
                    </div>
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="title" class="input-material" value="{{ old('title') }}">
                            <label for="register-username" class="label-material">Title</label>
                            @error('title')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="stock" class="input-material" value="{{ old('stock') }}">
                            <label for="register-username" class="label-material">Stock</label>
                            @error('stock')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="price" class="input-material"  value="{{ old('price') }}">
                            <label for="register-username" class="label-material">Price</label>
                            @error('price')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group-material">
                            <input id="register-username" type="text" name="discount" class="input-material"  value="{{ old('discount') }}">
                            <label for="register-username" class="label-material">Discount</label>
                            @error('discount')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>

                          <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">Brands</label>
                            <div class="col-sm-12">
                              <select name="brand_id" class="form-control mb-3 mb-3">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand') }}>{{ $brand->title }}</option>
                                @endforeach
                              </select>
                              @error('brand')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="register-email" class="label-material ml-3">Condition</label>
                            <div class="col-sm-12">
                                <select name="condition" class="form-control mb-3 mb-3">
                                    <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="popular" {{ old('condition') == 'popular' ? 'selected' : '' }}>Popular</option>
                                    <option value="hot" {{ old('condition') == 'hot' ? 'selected' : '' }}>Hot</option>
                                    <option value="winter" {{ old('condition') == 'winter' ? 'selected' : '' }}>Winter</option>
                                </select>
                              @error('condition')
                                <span class="text-danger">{{$message}}</span>
                              @enderror
                            </div>
                          </div>

                        </div>
                        <div class="col-sm-6 mt-4">
                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Size</label>
                                <div class="col-sm-12">
                                    <select name="size" class="form-control mb-3 mb-3">
                                        <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>Small</option>
                                        <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>Medium</option>
                                        <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>Large</option>
                                        <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>Extra Large</option>
                                    </select>
                                  @error('size')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                              </div>
                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Category</label>
                                <div class="col-sm-12">
                                    <select name="cat_id" id="cat_id" class="form-control mb-3 mb-3">
                                        <option > -- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category') }}>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                  @error('category')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row d-none" id="child_cat_div">
                                <label for="register-email" class="label-material ml-3">Chiled Category</label>
                                <div class="col-sm-12">
                                    <select name="child_cat_id" id="child_cat_id" class="form-control mb-3 mb-2">

                                    </select>
                                  @error('category')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="register-email" class="label-material ml-3">Vendor</label>
                                <div class="col-sm-12">
                                    <select name="vendor_id" class="form-control mb-3 mb-3">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" {{ old('vendor') == $vendor->id ? 'selected' : '' }}>{{ $vendor->full_name }}</option>
                                        @endforeach
                                    </select>
                                  @error('vendor_id')
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
                                </div>
                                @error('status')
                                  <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-danger text-light">
                                    <i class="fa fa-picture-o"></i> Choose
                                  </a>
                                </span>
                                <input id="thumbnail" class="form-control" type="text" name="photo" value="{{ old('photo') }}">
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
                              <label class="label-material ml-2">Summary</label>
                              <div class="col-lg-12">
                                  <textarea name="summary" class="input-material summary" style="background-color:#22252A;border:1px solid #62666C">{{ old('summary') }}</textarea>
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
                                    <textarea name="description" class="input-material summary" style="background-color:#22252A;border:1px solid #62666C">{{ old('description') }}</textarea>
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
                              <label class="label-material">Is Featured</label>
                              <div class="col-lg-12">
                                <input type="checkbox" name="is_featured" data-toggle="switchbutton" checked data-onlabel="true" data-offlabel="false"data-size="sm" data-onstyle="success" data-offstyle="danger">
                              </div>
                              @error('is_featured')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
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
