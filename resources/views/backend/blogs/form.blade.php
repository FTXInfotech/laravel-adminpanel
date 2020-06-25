<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.blogs.management') }}
                <small class="text-muted">{{ (isset($blog)) ? __('labels.backend.access.blogs.edit') : __('labels.backend.access.blogs.create') }}</small>
            </h4>
        </div><!--col-->
    </div><!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('name', trans('labels.backend.access.blogs.table.title'), ['class' => 'col-md-2 from-control-label required']) }}
                
                <div class="col-md-10">
                    {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.title'), 'required' => 'required']) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('categories', trans('labels.backend.access.blogs.table.category'), ['class' => 'col-md-2 from-control-label required']) }}
                
                <div class="col-md-10">
                    {{ Form::select('categories[]', $blogCategories, null, ['class' => 'form-control categories box-size', 'data-placeholder' => trans('labels.backend.access.blogs.table.category'), 'required' => 'required', 'multiple' => 'multiple']) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('publish_datetime', trans('labels.backend.access.blogs.table.published'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    @if(!empty($blog->publish_datetime))
                        {{ Form::text('publish_datetime', \Carbon\Carbon::parse($blog->publish_datetime)->format('m/d/Y h:i a'), ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('labels.backend.access.blogs.table.published'), 'required' => 'required', 'id' => 'datetimepicker1']) }}
                    @else
                        {{ Form::text('publish_datetime', null, ['class' => 'form-control datetimepicker1 box-size', 'placeholder' => trans('labels.backend.access.blogs.table.published'), 'required' => 'required', 'id' => 'datetimepicker1']) }}
                    @endif
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('featured_image', trans('labels.backend.access.blogs.table.featured_image'), ['class' => 'col-md-2 from-control-label required']) }}

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
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('content', trans('labels.backend.access.blogs.table.content'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.content')]) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('tags', trans('labels.backend.access.blogs.table.tags'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                @if(!empty($selectedtags))
                    {{ Form::select('tags[]', $blogTags, $selectedtags, ['class' => 'form-control tags', 'placeholder' => trans('labels.backend.access.blogs.table.tags'), 'required' => 'required', 'multiple' => 'multiple']) }}
                @else
                    {{ Form::select('tags[]', $blogTags, null, ['class' => 'form-control tags', 'data-placeholder' => trans('labels.backend.access.blogs.table.tags'), 'required' => 'required', 'multiple' => 'multiple']) }}
                @endif
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_title', trans('labels.backend.access.blogs.table.meta_title'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.meta_title')]) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('slug', trans('labels.backend.access.blogs.table.slug'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('slug', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.slug'), 'disabled' => 'disabled']) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('cannonical_link', trans('labels.backend.access.blogs.table.cannonical_link'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('cannonical_link', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.cannonical_link')]) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_keywords', trans('labels.backend.access.blogs.table.meta_keywords'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.meta_keywords')]) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('meta_description', trans('labels.backend.access.blogs.table.meta_description'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('labels.backend.access.blogs.table.meta_description')]) }}
                </div><!--col-->
            </div><!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('labels.backend.access.blogs.table.status'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::select('status', $status, null, ['class' => 'form-control select2 status box-size', 'placeholder' => trans('labels.backend.access.blogs.table.status'), 'required' => 'required']) }}
                </div><!--col-->
            </div><!--form-group-->
        </div><!--col-->
    </div><!--row-->
</div><!--card-body-->

@section('pagescript')
    <script src="{{URL::asset('/js/backend/blogs.js')}}"></script>
    <script type="text/javascript">
        
        Blog.Blog.init('{{ config('locale.languages.' . app()->getLocale())[1] }}');

    </script>
@stop