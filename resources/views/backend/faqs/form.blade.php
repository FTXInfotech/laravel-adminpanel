<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.faqs.management') }}
                <small class="text-muted">{{ __('labels.backend.access.faqs.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('question', trans('labels.backend.access.faqs.table.question'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('question', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.faqs.table.question'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('answer', trans('labels.backend.access.faqs.table.answer'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('answer', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.faqs.table.answer')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('labels.backend.access.faqs.table.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    <div class="checkbox d-flex align-items-center">
                        <label class="switch switch-label switch-pill switch-primary mr-2" for="role-1"><input class="switch-input" type="checkbox" name="status" id="role-1" value="1" {{ (isset($faq->status) && $faq->status === 1) ? "checked" : "" }}><span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
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