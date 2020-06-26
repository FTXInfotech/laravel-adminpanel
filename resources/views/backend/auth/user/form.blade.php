<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                @lang('labels.backend.access.users.management')
                <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('first_name', __('validation.attributes.backend.access.users.first_name'), [ 'class'=>'col-md-2 form-control-label']) }}

                <div class="col-md-10">
                    {{ Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.first_name'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('last_name', __('validation.attributes.backend.access.users.last_name'), [ 'class'=>'col-md-2 form-control-label']) }}

                <div class="col-md-10">
                    {{ Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.last_name'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('email', __('validation.attributes.backend.access.users.email'), [ 'class'=>'col-md-2 form-control-label']) }}

                <div class="col-md-10">
                    {{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.users.email'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            @if ($user->id != 1)

            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.users.active'), ['class' => 'col-md-2 control-label']) }}
                <div class="col-md-10">
                    {{ Form::checkbox('status', '1', $user->status == 1) }}
                </div>
            </div>
            <!--form control-->

            <div class="form-group row">
                {{ Form::label('confirmed', trans('validation.attributes.backend.access.users.confirmed'), ['class' => 'col-md-2 control-label']) }}
                <div class="col-md-10">
                    {{ Form::checkbox('confirmed', '1', $user->confirmed == 1) }}
                </div>
            </div>
            <!--form control-->

            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.users.associated_roles'), ['class' => 'col-md-2 control-label']) }}

                <div class="col-md-8">
                    @if (count($roles) > 0)
                    @foreach($roles as $role)
                    <label for="role-{{$role->id}}" class="control">
                        <input type="radio" value="{{$role->id}}" name="assignees_roles[]" {{ is_array(old('assignees_roles')) ? (in_array($role->id, old('assignees_roles')) ? 'checked' : '') : (in_array($role->id, $userRoles) ? 'checked' : '') }} id="role-{{$role->id}}" class="get-role-for-permissions" /> &nbsp;&nbsp;{!! $role->name !!}
                    </label>
                    <!--permission list-->
                    @endforeach
                    @else
                    {{ trans('labels.backend.access.users.no_roles') }}
                    @endif
                </div>
                <!--col-lg-3-->
            </div>
            <!--form control-->

            <div class="form-group row">
                {{ Form::label('associated-permissions', trans('validation.attributes.backend.access.roles.associated_permissions'), ['class' => 'col-md-2 control-label']) }}
                <div class="col-md-10">
                    <div id="available-permissions" style="width: 700px; height: 200px; overflow-x: hidden; overflow-y: scroll;">
                        <div class="get-available-permissions">
                            @if ($permissions)
                            @foreach ($permissions as $id => $display_name)
                            <div>
                                <input type="checkbox" name="permissions[{{ $id }}]" value="{{ $id }}" id="perm_{{ $id }}" {{ isset($userPermissions) && in_array($id, $userPermissions) ? 'checked' : '' }} /> <label for="perm_{{ $id }}"  style="margin-left:20px;">{{ $display_name }}</label>
                            </div>
                            @endforeach
                            @else
                            <p>There are no available permissions.</p>
                            @endif
                        </div>
                        <!--col-lg-6-->

                    </div>
                    <!--available permissions-->
                </div>
                <!--col-lg-3-->
            </div>
            <!--form control-->
            @endif
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->