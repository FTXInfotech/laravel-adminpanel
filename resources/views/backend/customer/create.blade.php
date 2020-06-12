@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.company.includes.breadcrumb-links')
@endsection

@section('content')
<form method="POST" action="{{route('admin.customer.store')}}" class="form-horizontal">

    @csrf

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Customer Management
                        <small class="text-muted">Create Customer</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 from-control-label" for="name">Name</label>

                        <div class="col-md-10">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Customer Name" maxlength="191" value="{{old('name')}}"  />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 from-control-label" for="email">Email</label>

                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Customer Email" value="{{old('email')}}"  />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 from-control-label" for="mobile">Mobile</label>

                        <div class="col-md-10">
                            <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Customer Mobile" value="{{old('mobile')}}"  />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="about">About </label>

                        <div class="col-md-10">
                            <textarea name="about" class="form-control" id="about">{{old('about')}}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="company_id">Company </label>

                        <div class="col-md-10">
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">Select company</option>
                                @foreach($companies as $company)
                                <option value="{{$company->id}}" {{ old('company_id') ==  $company->id ? 'selected' : '' }}>{{$company->name}}</option>
                                @endforeach
                            </select>
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