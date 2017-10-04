@extends ('backend.layouts.app')

@section ('title', trans('labels.backend.access.users.management') . ' | ' . trans('labels.backend.access.users.edit'))

@section('page-header')
    <h1>
        {{ trans('labels.backend.access.users.edit-profile') }}
    </h1>
@endsection

@section('content')
	{{ Form::model($logged_in_user, ['route' => 'admin.profile.update', 'class' => 'form-horizontal', 'method' => 'PATCH']) }}

     <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">{{ trans('labels.backend.access.users.edit-profile') }}</h3>
        </div>
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('first_name', trans('validation.attributes.frontend.register-user.firstName'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::input('text', 'first_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.firstName')]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('last_name', trans('validation.attributes.frontend.register-user.lastName'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::input('text', 'last_name', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.firstName')]) }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('address', trans('validation.attributes.frontend.register-user.address'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::input('textarea', 'address', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.address')]) }}
                </div>
            </div>

            {{-- state --}}
            <div class="form-group">
                {{ Form::label('state_id', trans('validation.attributes.frontend.register-user.state'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::select('state_id', [] , null, ['class' => 'form-control box-size st', 'placeholder' => trans('validation.attributes.frontend.register-user.state'), 'id' => 'state']) }}
                </div><!--col-lg-10-->
            </div><!--form-group-->

            {{-- city --}}
            <div class="form-group">
                {{ Form::label('city_id', trans('validation.attributes.frontend.register-user.city'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::select('city_id', [], null, ['class' => 'form-control box-size ct', 'placeholder' => trans('validation.attributes.frontend.register-user.city'), 'id' => 'city']) }}
                </div><!--col-lg-10-->
            </div><!--form-group-->

            {{-- zipcode --}}
            <div class="form-group">
                {{ Form::label('zip_code', trans('validation.attributes.frontend.register-user.zipcode'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::input('name', 'zip_code', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.zipcode')]) }}
                </div><!--col-lg-10-->
            </div><!--form-group-->

            {{-- SSN --}}
            <div class="form-group">
                {{ Form::label('ssn', trans('validation.attributes.frontend.register-user.ssn'), ['class' => 'col-lg-2 control-label']) }}
                <div class="col-lg-10">
                    {{ Form::input('name', 'ssn', null, ['class' => 'form-control box-size', 'placeholder' => trans('validation.attributes.frontend.register-user.ssn')]) }}
                </div><!--col-lg-10-->
            </div><!--form-group-->
                            
            <div class="form-group">
                <div class="col-lg-10 col-md-offset-4">
                    {{ Form::submit(trans('labels.general.buttons.update'), ['class' => 'btn btn-primary', 'id' => 'update-profile']) }}
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}
@endsection
@section('after-scripts')

<script type="text/javascript">
    $(document).ready(function() {
        FinBuilders.Profile.init();
        //Getting States of default contry
        ajaxCall("{{route('admin.get.states')}}");

    

        //Getting Cities of select State
        $("#state").on("change", function() {
            var stateId = $(this).val();
            var url = "{{route('admin.get.cities')}}";
            ajaxCall(url, stateId);
        });

        function ajaxCall(url, data = null)
        {
            $.ajax({
                url: url,
                type: "POST",
                data: {stateId: data},
                success: function(result) {
                    if(result != null)
                    {
                        if(result.status == "city")
                        {
                            var userCity = "{{ $logged_in_user->city_id }}";
                            var options;
                            $.each(result.data, function(key, value) {
                                if(key == userCity)
                                    options += "<option value='" + key + "' selected>" + value + "</option>";
                                else
                                    options += "<option value='" + key + "'>" + value + "</option>";
                            });
                            $("#city").html('');
                            $("#city").append(options);
                        }
                        else
                        {
                            var userState = "{{ $logged_in_user->state_id }}";
                            var options;
                            $.each(result.data, function(key, value) {
                                if(key == userState)
                                    options += "<option value='" + key + "' selected>" + value + "</option>";
                                else
                                    options += "<option value='" + key + "'>" + value + "</option>";
                            });
                            $("#state").append(options);
                            $("#state").trigger('change');
                        }
                    }
                }
            });
        }
    });
</script>
@endsection