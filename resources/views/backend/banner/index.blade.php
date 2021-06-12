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
		<h2 class="h5 no-margin-bottom"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;<a href="{{ route('admin') }}">Banners</a></h2>
	  </div>
	</div>
	<section class="no-padding-bottom">
	  <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
               @include('backend.include.notification')
            </div>
        </div>
		<div class="row">
		  <div class="col-lg-12">
            <div class="card mt-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h1 class="display-4">All Banners</h1>
                        <h1 class="display-4"><a href="{{ route('banner.create') }}" class="btn btn-secondary text-white p-2"><i class="fa fa-plus" aria-hidden="true"></i> Add Banner</a></h1>
                    </div>
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Image</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>{{ $banner->slug }}</td>
                                <td>
                                    @if($banner->photo)
                                        <img src="{{$banner->photo}}" class="img-fluid zoom" style="max-width:80px" alt="{{$banner->photo}}">
                                    @else
                                        <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid zoom" style="max-width:100%" alt="avatar.png">
                                    @endif
                                </td>
                                <td>
                                    @if($banner->condition=='banner')
                                        <span class="badge badge-success">{{$banner->condition}}</span>
                                    @else
                                        <span class="badge badge-primary">{{$banner->condition}}</span>
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" name="toggle" value="{{ $banner->id }}" data-toggle="switchbutton" {{ $banner->status == 'active' ? 'checked':'' }} data-onlabel="active" data-offlabel="inactive"data-size="sm" data-onstyle="success" data-offstyle="danger">
                                   {{--  @if($banner->status=='active')
                                        <span class="badge badge-success">{{$banner->status}}</span>
                                    @else
                                        <span class="badge badge-warning">{{$banner->status}}</span>
                                    @endif --}}
                                </td>
                                <td>
                                    <a href="{{route('banner.edit',$banner->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fa fa-edit"></i></a>
                                    <form method="POST" action="{{route('banner.destroy',[$banner->id])}}">
                                    @csrf
                                    @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id={{$banner->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
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

           $('input[name=toggle]').change(function(){
               var mode = $(this).prop('checked')
               var id = $(this).val()
               $.ajax({
                   url:'{{ route('banner.status') }}',
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
                           swar('error','Please try again letter')
                       }
                   }
               });
           });

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

        } );
</script>
@endsection
