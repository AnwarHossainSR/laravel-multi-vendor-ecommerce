@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('admin') }}/table/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('admin') }}/switch-button-bootstrap/css/bootstrap-switch-button.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@section('content')

<div class="page-content">
	<div class="page-header">
	  <div class="container-fluid">
		<h2 class="h5 no-margin-bottom"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<a href="{{ route('admin') }}">Dashboard</a></h2>
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
                        <h3 class="display-4">All Products : {{ $products->count() }}</h3>
                        <h1 class="display-4"><a href="{{ route('product.create') }}" class="btn btn-secondary text-white p-2"><i class="fa fa-plus" aria-hidden="true"></i> Add Product</a></h1>
                    </div>

                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Photo</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($product->title, 10) }}</td>
                                <td>
                                    @if($product->photo)
                                        <img src="{{$product->photo}}" class="img-fluid zoom" style="max-width:80px" alt="Product Image">
                                    @else
                                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                                    @endif
                                </td>
                                <td>{{ number_format($product->price,2) }} $</td>
                                <td>{{ $product->discount }} %</td>
                                <td>
                                    @if ($product->condition == 'new')
                                        <span class="badge badge-success">{{$product->condition}}</span>
                                    @elseif ($product->condition == 'hot')
                                        <span class="badge badge-info">{{$product->condition}}</span>
                                    @elseif ($product->condition == 'popular')
                                        <span class="badge badge-warning">{{$product->condition}}</span>
                                    @else
                                        <span class="badge badge-danger">{{$product->condition}}</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" name="toggle" value="{{ $product->id }}" data-toggle="switchbutton" {{ $product->status == 'active' ? 'checked':'' }} data-onlabel="active" data-offlabel="inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-info btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fa fa-info-circle viewProduct" data-id={{$product->id}} data-toggle="modal" data-target="#productId{{ $product->id }}" ></i></a>

                                    <a href="{{route('product.edit',$product->id)}}" class="btn btn-info btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>

                                    <form method="POST" action="{{route('product.destroy',[$product->id])}}">
                                    @csrf
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>

                                    </a>
                                </td>
                            </tr>
                            <!-- Modal Form-->
                            <div id="productId{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                                <div role="document" class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"><strong id="exampleModalLabel" class="modal-title"></strong>
                                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Stock: </strong><span class="stock ml-1"></span></p>
                                                <p><strong>Price: </strong><span class="price ml-1"></span></p>
                                                <p><strong>Discount: </strong><span class="discount ml-1"></span></p>
                                                <p><strong>Offer Price: </strong><span class="offer ml-1"></span></p>
                                                <p><strong>Size: </strong><span class="size text-info ml-1"></span></p>
                                                <p><strong>Status: </strong><span class="status ml-1 badge badge-info"></span></p>

                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Brand: </strong><span class="brand ml-1 badge badge-warning"></span></p>
                                                <p><strong>Category: </strong><span class="category ml-1"></span></p>
                                                <p><strong>Child Category: </strong><span class="ccategory ml-1"></span></p>
                                                <p><strong>Vendor: </strong><span class="vendor ml-1 text-danger"></span></p>
                                                <p><strong>Feature Product: </strong><span class="feature ml-1 badge badge-primary"></span></p>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><strong>Summary: </strong><span class="summary ml-1"></span></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p><strong>Description: </strong><span class="description ml-1"></span></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mt-1">
                                                    <img class="photo" alt="Product Photo" width="460px" height="250px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
		  </div>
		</div>
	  </div>
	</section>
  </div>



@endsection

@section('script')

    <script src="{{ asset('admin') }}/table/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <script src="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/JSZip-2.5.0/jszip.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/js/buttons.print.min.js"></script>
    <script src="{{ asset('admin') }}/table/DataTables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="{{ asset('admin') }}/switch-button-bootstrap/src/bootstrap-switch-button.js"></script>

     <script>
        $(document).ready(function() {
            $('#table').DataTable( {
                buttons: [ 'copy','csv','print', 'excel', 'pdf', 'colvis' ],
                dom: 'Bfrtip'
            } );
        } );
    </script>
    <script>
        $('input[name=toggle]').change(function(){
               var mode = $(this).prop('checked')
               var id = $(this).val()
               $.ajax({
                   url:'{{ route('product.status') }}',
                   type:'POST',
                   data:{
                       _token:'{{ csrf_token() }}',
                       mode:mode,
                       id:id,
                   },
                   success:function(response){
                       if(response.status){
                           swal('success',response.msg)
                       }else{
                           swal('error','Please try again letter')
                       }
                   }
               });
           });
    </script>

    <script>
        $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
    </script>
    <script>
        $('.viewProduct').click(function(){
            var dataID=$(this).data('id');
            $.ajax({
                   url:'{{ route('product.view') }}',
                   type:'POST',
                   data:{
                       _token:'{{ csrf_token() }}',
                       id:dataID,
                   },
                   success:function(response){
                       console.log(response.data.title)
                       if(response.status){
                           console.log(response)
                        $('.modal-title').html(response.data.title)
                        $('.stock').html(response.data.stock)
                        $('.price').html(response.data.price+' $')
                        $('.discount').html(response.data.discount+' %')
                        $('.offer').html(response.data.offer_price+' $')
                        $('.size').html(response.data.size)
                        $('.status').html(response.data.status)
                        $('.summary').html(response.data.summary)
                        $('.description').html(response.data.description)
                        $('.photo').attr( "src", response.data.photo);
                        if(response.data.is_featured == 1){
                            $('.feature').html('Yes')
                        }else{
                            $('.feature').html('No')
                        }
                        $('.brand').html(response.brand)
                        $('.category').html(response.category)
                        $('.ccategory').html(response.chiled_category)
                        $('.vendor').html(response.vendor)

                       }else{
                           swal('error','Please try again letter')
                       }
                   }
               });
        });
    </script>
@endsection
