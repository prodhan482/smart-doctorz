@if(count($errors)>0)
    @foreach($errors->all as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif
@if(session('success'))
    <div class="alert alert-success font-weight-bold">
        <i class="fa fa-check-circle ml-3 mr-2" aria-hidden="true"></i>{{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger font-weight-bold">
        <i class="fa fa-exclamation-circle ml-3 mr-2" aria-hidden="true"></i>{{session('error')}}
    </div>
@endif
@if(session('warning'))
    <div class="alert alert-warning font-weight-bold">
        <i class="fa fa-exclamation-circle ml-3 mr-2" aria-hidden="true"></i>{{session('warning')}}
    </div>
@endif
