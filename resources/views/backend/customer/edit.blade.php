@extends('backend.layouts.app')

@section('title', __('Customer Management') . ' | ' . __('Edit Customer'))

@section('breadcrumb-links')
    @include('backend.company.includes.breadcrumb-links')
@endsection

@section('content')
<form action="{{route('admin.customer.update', $customer->id)}}" class="form-horizontal">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        Customer Management
                        <small class="text-muted">Update Customer</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="name">Name</label>

                        <div class="col-md-10">
                            <input type="text" name="name" class="form-control" id="name"
                             placeholder="Customer Name" value="{{$customer->name}}" />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="email">Email</label>

                        <div class="col-md-10">
                            <input type="email" name="email" class="form-control" id="email"
                             placeholer="Customer Email" value="{{$customer->email}}" />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="mobile">Mobile</label>

                        <div class="col-md-10">
                            <input type="number" name="mobile" class="form-control" id="mobile"
                             placeholer="Customer Mobile" value="{{$customer->mobile}}" />
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="about">About</label>

                        <div class="col-md-10">
                            <textarea class="form-control" name="about" id="about">{{$customer->about}}</textarea>
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="company_id">Company</label>

                        <div class="col-md-10">
                            
                            <select name="company_id" id="company_id" class="form-control">
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                <option value="{{$company->id}}" {{$customer->company_id == $company->id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="active">Status</label>

                        <div class="col-md-10">
                            <select name="active" class="form-control">
                                @foreach([0=>'Inactive', 1=>'Active'] as $key=>$value)
                                <option value="{{$key}}" {{$customer->active == $key ? 'selected' : ''}}>{{$value}}</option>
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
                    {{ form_cancel(route('admin.customer.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection