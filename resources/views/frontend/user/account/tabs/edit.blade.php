{{ Form::model($logged_in_user, ['route' => 'frontend.user.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

    <div class="form-group">
        {{ Form::label('first_name', trans('validation.attributes.frontend.register-user.firstName'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.firstName')]) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('last_name', trans('validation.attributes.frontend.register-user.lastName'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.firstName')]) }}
        </div>
    </div>

    @if ($logged_in_user->canChangeEmail())
        <div class="form-group">
            {{ Form::label('email', trans('validation.attributes.frontend.register-user.email'), ['class' => 'col-md-4 control-label']) }}
            <div class="col-md-6">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> {{  trans('strings.frontend.user.change_email_notice') }}
                </div>

                {{ Form::input('email', 'email', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.email')]) }}
            </div>
        </div>
    @endif

    <div class="form-group">
        {{ Form::label('address', trans('validation.attributes.frontend.register-user.address'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::input('textarea', 'address', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.address')]) }}
        </div>
    </div>

    {{-- state --}}
    <div class="form-group">
        {{ Form::label('state_id', trans('validation.attributes.frontend.register-user.state'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::select('state_id', [] , null, ['class' => 'form-control select2', 'placeholder' => trans('validation.attributes.frontend.register-user.state'), 'id' => 'state', 'style' => 'width : 539px !important;']) }}
        </div><!--col-md-6-->
    </div><!--form-group-->

    {{-- city --}}
    <div class="form-group">
        {{ Form::label('city_id', trans('validation.attributes.frontend.register-user.city'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::select('city_id', [], null, ['class' => 'form-control select2', 'placeholder' => trans('validation.attributes.frontend.register-user.city'), 'id' => 'city', 'style' => 'width : 539px !important;']) }}
        </div><!--col-md-6-->
    </div><!--form-group-->

    {{-- zipcode --}}
    <div class="form-group">
        {{ Form::label('zip_code', trans('validation.attributes.frontend.register-user.zipcode'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::input('name', 'zip_code', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.zipcode')]) }}
        </div><!--col-md-6-->
    </div><!--form-group-->

    {{-- SSN --}}
    <div class="form-group">
        {{ Form::label('ssn', trans('validation.attributes.frontend.register-user.ssn'), ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::input('name', 'ssn', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.frontend.register-user.ssn')]) }}
        </div><!--col-md-6-->
    </div><!--form-group-->
                    
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            {{ Form::submit(trans('labels.general.buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
        </div>
    </div>

{{ Form::close() }}