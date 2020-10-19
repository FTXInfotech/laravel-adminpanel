@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.edit'))

@section('breadcrumb-links')
@include('backend.auth.roles.includes.breadcrumb-links')
@endsection

@section('content')
{{ Form::model($role, ['route' => ['admin.auth.role.update', $role], 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role']) }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.roles.management')
                    <small class="text-muted">@lang('labels.backend.access.roles.edit')</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->
        <!--row-->

        <hr />

        <div class="row mt-4">
            <div class="col">
                <div class="form-group row">
                    {{ Form::label('name', __('validation.attributes.backend.access.roles.name'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.roles.name'), 'required' => 'required']) }}
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('associated_permissions', __('validation.attributes.backend.access.roles.associated_permissions'), [ 'class'=>'col-md-2 form-control-label']) }}

                    <div class="col-md-10 search-permission" style="min-height: unset;">
                        {{ Form::select('associated_permissions', ['all' => 'All', 'custom' => 'Custom'], $role->all ? 'all' : 'custom', ['class' => 'form-control select2']) }}

                        <div id="available-permissions" style="margin-top: 20px;">
                            <div>
                                <input type="text" class="form-control search-button" placeholder="Search..." />
                            </div>
                            <div class="get-available-permissions">
                                @if ($permissions->count())
                                @foreach ($permissions as $perm)
                                <div>
                                    <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) ? (in_array($perm->id, old('permissions')) ? 'checked' : '') : (in_array($perm->id, $rolePermissions) ? 'checked' : '') }} /> <label style="margin-left:20px;" for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label>
                                </div>
                                @endforeach
                                @else
                                <p>There are no available permissions.</p>
                                @endif
                            </div>
                        </div>
                        <!--available permissions-->
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('sort', trans('validation.attributes.backend.access.roles.sort'), ['class' => 'col-md-2 control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('sort', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.roles.sort')]) }}
                    </div>
                    <!--col-lg-10-->
                </div>
                <!--form control-->
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-body-->

    @include('backend.components.footer-buttons', [ 'cancelRoute' => 'admin.auth.role.index', 'id' => $role->id ])
</div>
<!--card-->
{{ Form::close() }}
@endsection

@section('pagescript')
<script>
    FTX.Utils.documentReady(function() {
        FTX.Roles.edit.init();
    });
</script>
@endsection