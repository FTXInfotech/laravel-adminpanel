@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Customer Management'))

@section('breadcrumb-links')
    @include('backend.customer.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    {{ __('Customer Management') }} <small class="text-muted">{{ __('Active Customers') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.customer.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Company</th>
                            <th>Status</th>
                            <th>Updated At</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->mobile }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->company->name }}</td>
                                <td>
                                    @if ($customer->active)
                                    <span class='badge badge-success'>@lang('labels.general.active')</span>
                                    @endif
                                </td>
                                <td>{{ $customer->updated_at->diffForHumans() }}</td>
                                <td class="btn-td">
                                    @include('backend.customer.includes.actions', ['customer' => $customer])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $customers->total() !!} customers total
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $customers->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
