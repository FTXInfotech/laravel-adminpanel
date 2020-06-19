@extends('backend.layouts.app')

@section('title', __('labels.backend.access.roles.management') . ' | ' . __('labels.backend.access.roles.create'))

@section('content')
{{ Form::open(['route' => 'admin.auth.role.store', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'id' => 'create-role']) }}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.roles.management')
                    <small class="text-muted">@lang('labels.backend.access.roles.create')</small>
                </h4>
            </div>
            <!--col-->
        </div>
        <!--row-->

        <hr>

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
                        {{ Form::select('associated_permissions', array('all' => trans('labels.general.all'), 'custom' => trans('labels.general.custom')), 'all', ['class' => 'form-control select2']) }}

                        <div id="available-permissions" class="hidden" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;margin-top:20px;">
                            <div class="row">
                                <div class="col-md-10">
                                    @if ($permissions->count())
                                    @foreach ($permissions as $perm)
                                    <div>
                                        <input type="checkbox" name="permissions[{{ $perm->id }}]" value="{{ $perm->id }}" id="perm_{{ $perm->id }}" {{ is_array(old('permissions')) && in_array($perm->id, old('permissions')) ? 'checked' : '' }} /> <label style="margin-left:20px;" for="perm_{{ $perm->id }}">{{ $perm->display_name }}</label>
                                    </div>
                                    @endforeach
                                    @else
                                    <p>There are no available permissions.</p>
                                    @endif
                                </div>
                                <!--col-lg-6-->
                            </div>
                            <!--row-->
                        </div>
                        <!--available permissions-->
                    </div>
                    <!--col-->
                </div>
                <!--form-group-->

                <div class="form-group row">
                    {{ Form::label('sort', trans('validation.attributes.backend.access.roles.sort'), ['class' => 'col-md-2 control-label']) }}

                    <div class="col-md-10">
                        {{ Form::text('sort', ($roleCount+1), ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.roles.sort')]) }}
                    </div>
                    <!--col-lg-10-->
                </div>
                <!--form control-->

                <div class="form-group row">
                    {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-md-2 control-label']) }}

                    <div class="col-md-10">
                        {{ Form::checkbox('status', 1, true) }}
                    </div>
                    <!--col-lg-3-->
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
                {{ form_submit(__('buttons.general.crud.create')) }}
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