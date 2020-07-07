<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.blogs.management') }}
                <small class="text-muted">{{ (isset($blog)) ? __('labels.backend.access.blogs.edit') : __('labels.backend.access.blogs.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('name', trans('validation.attributes.backend.access.blogs.title'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.title'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('categories', trans('validation.attributes.backend.access.blogs.blog_categories'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('categories[]', $blogCategories, null, ['class' => 'form-control categories box-size', 'data-placeholder' => trans('validation.attributes.backend.access.blogs.blog_categories'), 'required' => 'required', 'multiple' => 'multiple']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('publish_datetime', trans('validation.attributes.backend.access.blogs.publish_date_time'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    @if(!empty($blog->publish_datetime))
                    {{ Form::text('publish_datetime', \Carbon\Carbon::parse($blog->publish_datetime)->format('m/d/Y h:i a'), ['class' => 'form-control publish_datetime box-size', 'placeholder' => trans('validation.attributes.backend.access.blogs.publish_date_time'), 'required' => 'required', 'id' => 'publish_datetime']) }}
                    @else
                    {{ Form::text('publish_datetime', null, ['class' => 'form-control publish_datetime box-size', 'placeholder' => trans('validation.attributes.backend.access.blogs.publish_date_time'), 'required' => 'required', 'id' => 'publish_datetime']) }}
                    @endif
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('featured_image', trans('validation.attributes.backend.access.blogs.featured_image'), ['class' => 'col-md-2 from-control-label required']) }}

                @if(!empty($blog->featured_image))
                <div class="col-lg-1">
                    <img src="{{ asset('storage/img/blog/'.$blog->featured_image) }}" height="80" width="80">
                </div>
                <div class="col-lg-5">
                    {{ Form::file('featured_image', ['id' => 'featured_image']) }}
                </div>
                @else
                <div class="col-lg-5">
                    {{ Form::file('featured_image', ['id' => 'featured_image']) }}
                </div>
                @endif
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('content', trans('validation.attributes.backend.access.blogs.content'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.content')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('tags', trans('validation.attributes.backend.access.blogs.tags'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    @if(!empty($selectedtags))
                    {{ Form::select('tags[]', $blogTags, $selectedtags, ['class' => 'form-control tags', 'placeholder' => trans('validation.attributes.backend.access.blogs.tags'), 'required' => 'required', 'multiple' => 'multiple']) }}
                    @else
                    {{ Form::select('tags[]', $blogTags, null, ['class' => 'form-control tags', 'data-placeholder' => trans('validation.attributes.backend.access.blogs.tags'), 'required' => 'required', 'multiple' => 'multiple']) }}
                    @endif
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_title', trans('validation.attributes.backend.access.blogs.meta_title'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.meta_title')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('slug', trans('validation.attributes.backend.access.blogs.slug'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.slug'), 'disabled' => 'disabled']) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('cannonical_link', trans('validation.attributes.backend.access.blogs.cannonical_link'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('cannonical_link', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.cannonical_link')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_keywords', trans('validation.attributes.backend.access.blogs.meta_keywords'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.meta_keywords')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_description', trans('validation.attributes.backend.access.blogs.meta_description'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.blogs.meta_description')]) }}
                </div>
                <!--col-->
            </div>
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.blogs.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('status', $status, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('validation.attributes.backend.access.blogs.status'), 'required' => 'required']) }}
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
    FTX.Utils.documentReady(function() {
        FTX.Blogs.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
    });
</script>
@stop