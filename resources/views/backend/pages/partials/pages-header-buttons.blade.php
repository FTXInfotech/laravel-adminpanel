<!--Action Button-->
@if(Active::checkUriPattern('admin/pages'))
    <export-component></export-component>    
@endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.pages.index')}}"><i class="fa fa-list-ul"></i> {{trans('menus.backend.pages.all')}}</a></li>
    @permission('create-page')
    <li><a href="{{route('admin.pages.create')}}"><i class="fa fa-plus"></i> {{trans('menus.backend.pages.create')}}</a></li>
    @endauth
  </ul>
</div>
<div class="clearfix"></div>
