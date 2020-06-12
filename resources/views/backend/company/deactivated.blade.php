@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('Company Management'))

@section('breadcrumb-links')
    @include('backend.company.includes.breadcrumb-links')
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Company Management <small class="text-muted">Active Company</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.company.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>#Customers</th>
                            <th>Created At</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->website }}</td>
                                <td>
                                    @if (!$company->active)
                                    <span class='badge badge-danger'>@lang('labels.general.inactive')</span>
                                    @endif
                                </td>
                                <td>{{count($company->customers)}}</td>
                                <td>{{ $company->created_at->diffForHumans() }}</td>
                                <td class="btn-td">
                                    @include('backend.company.includes.actions', ['company' => $company])
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
                    {!! $companies->total() !!} companies total
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right">
                    {!! $companies->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection
