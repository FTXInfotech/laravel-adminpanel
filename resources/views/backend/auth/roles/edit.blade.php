@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.edit'))

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

                    <div class="col-md-10">
                        {{ Form::select('associated_permissions', ['all' => 'All', 'custom' => 'Custom'], $role->all ? 'all' : 'custom', ['class' => 'form-control select2']) }}

                        <input type="text" class="form-control search-button" placeholder="Search..." />
                        
                        <div id="available-permissions" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll; border: 1px solid #f1f1f1; padding: 40px 0 0 7px;">
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

    <div class="card-footer">
        <div class="row">
            <div class="col">
                {{ form_cancel(route('admin.auth.role.index'), __('buttons.general.cancel')) }}
            </div>
            <!--col-->

            <div class="col text-right">
                {{ form_submit(__('buttons.general.crud.update')) }}
            </div>
            <!--col-->
        </div>
        <!--row-->
    </div>
    <!--card-footer-->
</div>
<!--card-->
{{ Form::close() }}
@endsection

@section('pagescript')
<script>
    Backend.Utils.documentReady(function() {
        Backend.Roles.init("rolecreate")
    });
</script>
@endsection