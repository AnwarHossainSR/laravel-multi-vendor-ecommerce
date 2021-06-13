@if(session('success'))
    <div class="alert alert-success alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('success')}}
    </div>
@endif


@if(session('error'))
    <div class="alert alert-danger alert-dismissable fade show">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        {{session('error')}}
    </div>
@endif

@if ($errors->any())

    <div class="alert alert-danger">

        <button type="button" class="close" data-dismiss="alert">×</button>

        <i class="fa fa-ban"></i> Please check the form below for errors
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif
