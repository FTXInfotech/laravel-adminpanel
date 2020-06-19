<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.email-templates.management') }}
                <small class="text-muted">{{ __('labels.backend.access.email-templates.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('title', trans('labels.backend.access.email-templates.table.title'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('title', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.email-templates.table.title'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('slug', trans('labels.backend.access.email-templates.table.slug'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.email-templates.table.slug'), 'disabled' => 'disabled']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('content', trans('labels.backend.access.email-templates.table.content'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.email-templates.table.content')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('labels.backend.access.email-templates.table.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    <div class="checkbox d-flex align-items-center">
                        <label class="switch switch-label switch-pill switch-primary mr-2" for="role-1"><input class="switch-input" type="checkbox" name="status" id="role-1" value="1" {{ (isset($emailTemplate->status) && $emailTemplate->status === 1) ? "checked" : "" }}><span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
                    </div>
                </div>
                <!--col-->
            </div>
            <!--form-group-->
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->

@section('pagescript')
<script type="text/javascript">
    Backend.Utils.documentReady(function() {
        Backend.Faq.init('edit', "{{ config('locale.languages.' . app()->getLocale())[1] }}");
    });
</script>
@stop