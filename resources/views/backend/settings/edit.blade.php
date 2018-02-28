@extends ('backend.layouts.app') 

@section ('title', trans('labels.backend.settings.management') . ' | ' . trans('labels.backend.settings.edit'))

@section('page-header')
<h1>
	{{ trans('labels.backend.settings.management') }}
	<small>{{ trans('labels.backend.settings.edit') }}</small>
</h1>
@endsection 

@section('content') 
{{ Form::model($setting, ['route' => ['admin.settings.update', $setting], 'class' => 'form-horizontal',
'role' => 'form', 'method' => 'PATCH','files' => true, 'id' => 'edit-settings']) }}

<div class="box box-info">
	<div class="box-header">
		<h3 class="box-title">{{ trans('labels.backend.settings.edit') }}</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body setting-block">
		<!-- Nav tabs -->
		<ul id="myTab" class="nav nav-tabs setting-tab-list" role="tablist">
			<li role="presentation" class="active">
				<a href="#tab1" aria-controls="home" role="tab" data-toggle="tab">{{ trans('labels.backend.settings.seo') }}</a>
			</li>
			<li role="presentation">
				<a href="#tab2" aria-controls="1" role="tab" data-toggle="tab">{{ trans('labels.backend.settings.companydetails') }}</a>
			</li>
			<li role="presentation">
				<a href="#tab3" aria-controls="2" role="tab" data-toggle="tab">{{ trans('labels.backend.settings.mail') }}</a>
			</li>
			<li role="presentation">
				<a href="#tab4" aria-controls="3" role="tab" data-toggle="tab">{{ trans('labels.backend.settings.footer') }}</a>
			</li>
			<li role="presentation">
				<a href="#tab5" aria-controls="4" role="tab" data-toggle="tab">{{ trans('labels.backend.settings.terms') }}</a>
			</li>
			<li role="presentation">
				<a href="#tab6" aria-controls="5" role="tab" data-toggle="tab">{{ trans('labels.backend.settings.google') }}</a>
			</li>
		</ul>

		<!-- Tab panes -->
		<div id="myTabContent" class="tab-content setting-tab">
			<div role="tabpanel" class="tab-pane active" id="tab1">
				<div class="form-group">
					{{ Form::label('logo', trans('validation.attributes.backend.settings.sitelogo'), ['class' => 'col-lg-2 control-label']) }}

					<div class="col-lg-10">

						<div class="custom-file-input">
							{!! Form::file('logo', array('class'=>'form-control inputfile inputfile-1' )) !!}
							<label for="logo">
								<i class="fa fa-upload"></i>
								<span>Choose a file</span>
							</label>
						</div>
						<div class="img-remove-logo">
							@if($setting->logo)
							<img height="50" width="50" src="{{ Storage::disk('public')->url('img/logo/' . $setting->logo) }}">
							<i id="remove-logo-img" class="fa fa-times remove-logo" data-id="logo" aria-hidden="true"></i>
							@endif
						</div>
					</div>
					<!--col-lg-10-->
				</div>
				<!--form control-->

				<div class="form-group">
					{{ Form::label('favicon', trans('validation.attributes.backend.settings.favicon'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						<div class="custom-file-input">
							{!! Form::file('favicon', array('class'=>'form-control inputfile inputfile-1' )) !!}
							<label for="favicon">
								<i class="fa fa-upload"></i>
								<span>Choose a file</span>
							</label>
						</div>
						<div class="img-remove-favicon">
							@if($setting->favicon)
							<img height="50" width="50" src="{{ Storage::disk('public')->url('img/favicon/' . $setting->favicon) }}">
							<i id="remove-favicon-img" class="fa fa-times remove-logo" data-id="favicon" aria-hidden="true"></i>
							@endif
						</div>
					</div>
					<!--col-lg-10-->
				</div>
				<!--form control-->
				<div class="form-group">
					{{ Form::label('seo_title', trans('validation.attributes.backend.settings.metatitle'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						{{ Form::text('seo_title', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.metatitle')])
						}}
					</div>
					<!--col-lg-10-->
				</div>
				<!--form control-->

				<div class="form-group">
					{{ Form::label('seo_keyword', trans('validation.attributes.backend.settings.metakeyword'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						{{ Form::textarea('seo_keyword', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.metakeyword'),
						'rows' => 2]) }}
					</div>
					<!--col-lg-3-->
				</div>
				<!--form control-->

				<div class="form-group">
					{{ Form::label('seo_description', trans('validation.attributes.backend.settings.metadescription'), ['class' => 'col-lg-2
					control-label']) }}

					<div class="col-lg-10">
						{{ Form::textarea('seo_description', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.metadescription'),
						'rows' => 2]) }}
					</div>
					<!--col-lg-3-->
				</div>
				<!--form control-->
			</div>
			<div role="tabpanel" class="tab-pane" id="tab2">
				<div class="form-group">
					{{ Form::label('company_address', trans('validation.attributes.backend.settings.companydetails.address'), ['class' => 'col-lg-2
					control-label']) }}

					<div class="col-lg-10">
						{{ Form::textarea('company_address', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.companydetails.address'),
						'rows' => 2]) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('company_contact', trans('validation.attributes.backend.settings.companydetails.contactnumber'), ['class'
					=> 'col-lg-2 control-label']) }}

					<div class="col-lg-10">
						{{ Form::text('company_contact', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.companydetails.contactnumber'),
						'rows' => 2]) }}
					</div>
				</div>
				<!--form control-->
			</div>
			<div role="tabpanel" class="tab-pane" id="tab3">
				<div class="form-group">
					{{ Form::label('from_name', trans('validation.attributes.backend.settings.mail.fromname'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						{{ Form::text('from_name', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.mail.fromname'),
						'rows' => 2]) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('from_email', trans('validation.attributes.backend.settings.mail.fromemail'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						{{ Form::text('from_email', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.mail.fromemail'),
						'rows' => 2]) }}
					</div>
				</div>
				<!--form control-->
			</div>
			<div role="tabpanel" class="tab-pane" id="tab4">
				<div class="form-group">
					{{ Form::label('footer_text', trans('validation.attributes.backend.settings.footer.text'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						{{ Form::text('footer_text', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.footer.text'),
						'rows' => 2]) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('copyright_text', trans('validation.attributes.backend.settings.footer.copyright'), ['class' => 'col-lg-2
					control-label']) }}

					<div class="col-lg-10">
						{{ Form::text('copyright_text', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.footer.copyright'),
						'rows' => 2]) }}
					</div>
				</div>
				<!--form control-->
			</div>
			<div role="tabpanel" class="tab-pane" id="tab5">
				<div class="form-group">
					{{ Form::label('terms', trans('validation.attributes.backend.settings.termscondition.terms'), ['class' => 'col-lg-2 control-label'])
					}}

					<div class="col-lg-10">
						{{ Form::textarea('terms', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.termscondition.terms')])
						}}
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('disclaimer', trans('validation.attributes.backend.settings.termscondition.disclaimer'), ['class' => 'col-lg-2
					control-label']) }}

					<div class="col-lg-10">
						{{ Form::textarea('disclaimer', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.termscondition.disclaimer')])
						}}
					</div>
				</div>
				<!--form control-->
			</div>
			<div role="tabpanel" class="tab-pane" id="tab6">
				<div class="form-group">
					{{ Form::label('google_analytics', trans('validation.attributes.backend.settings.google.analytic'), ['class' => 'col-lg-2
					control-label']) }}

					<div class="col-lg-10">
						{{ Form::textarea('google_analytics', null,['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.settings.google.analytic')])
						}}
					</div>
				</div>
				<!--form control-->
			</div>
		</div>
	</div>
	<!-- /.box-body -->
	<div class="box-footer">
		<div class="row">
			<div class="col-lg-offset-2 col-lg-10 footer-btn">
				{{ Form::submit(trans('buttons.general.crud.update'), ['class' => 'btn btn-primary btn-md']) }}
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div><!--box-->

<!-- hidden setting id variable -->
<input type="hidden" data-id="{{ $setting->id }}" id="setting">
{{ Form::close() }} 
@endsection 

@section('after-scripts')
<script src='/js/backend/bootstrap-tabcollapse.js'></script>
<script>
	(function(){
		Backend.Utils.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		Backend.Settings.selectors.RouteURL = "{{ route('admin.removeIcon', -1) }}";
		Backend.Settings.init();
		
	})();

	window.load = function(){
		
	}
	/*
	var route = "{{ route('admin.removeIcon', -1) }}";
    var data_id = $('#setting').data('id');
    
    route = route.replace('-1', data_id);

    $('.remove-logo').click(function() {
        var data = $(this).data('id');

        swal({
            title: "Warning",
            text: "Are you sure you want to remove?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: true
            }, function (confirmed) {
                if (confirmed)
                {
                    console.log(data);
                    if(data=='logo')
                    {
                        value= 'logo';
                        $('.img-remove-logo').addClass('hidden');
                    }
                    else
                    {
                        value= 'favicon';
                        $('.img-remove-favicon').addClass('hidden');
                    }
                    $.ajax({
                        url: route,
                        type: "POST",
                        data: {data: value},
                    });
                }
            });
    });
	
   */
    $('#myTab').tabCollapse({
        tabsClass: 'hidden-sm hidden-xs',
        accordionClass: 'visible-sm visible-xs'
    });

</script>
@endsection