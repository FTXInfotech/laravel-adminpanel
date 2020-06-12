@extends('backend.layouts.app')

@section('title', __('Company Management') . ' | ' . __('Create Company'))

@section('breadcrumb-links')
    @include('backend.company.includes.breadcrumb-links')
@endsection

@section('content')
<form method="POST" action="{{route('admin.company.store')}}" class="form-horizontal">

    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Company Management
                        <small class="text-muted">Create Company</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 from-control-label" for="name">Name</label>

                        <div class="col-md-10">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Company Name" maxlength="191" value="{{old('name')}}"  />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 from-control-label" for="email">Email</label>

                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Company Email" value="{{old('email')}}"  />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 from-control-label" for="website">Website</label>

                        <div class="col-md-10">
                            <input type="text" name="website" id="website" class="form-control" placeholder="Company Website" value="{{old('Website')}}"  />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="logo">Logo</label>

                        <div class="col-md-10">
                            <input type="file" name="logo" id="logo" class="form-control" />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="status" >Status</label>

                        <div class="col-md-10">
                            <select name="active" class="form-control" id="status">
                                <option value="">Select Status</option>
                                @foreach([1=>'Active', 0=>'Inactive'] as $statusKey=>$statusValue)
                                <option value="{{$statusKey}}">{{$statusValue}}</option>
                                @endforeach
                            </select>
                        </div><!--col-->
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a class="btn btn-danger btn-sm" href="{{route('admin.company.index')}}">Cancel</a>
                </div><!--col-->

                <div class="col text-right">
                    <button class="btn btn-success btn-small pull-right" type="submit">Create</button>
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection

@section('pagescript')
    <script src="{{URL::asset('/js')}}"></script>
@stop