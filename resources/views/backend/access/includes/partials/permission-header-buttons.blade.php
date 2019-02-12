<!--Action Button-->
  @if(Active::checkUriPattern('admin/access/permission'))
    @include('backend.access.includes.partials.header-export')
  @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.access.permission.index')}}"><i class="fa fa-list-ul"></i> {{trans('menus.backend.access.permissions.all')}}</a></li>
    @permission('create-permission')
    <li><a href="{{route('admin.access.permission.create')}}"><i class="fa fa-plus"></i> {{trans('menus.backend.access.permissions.create')}}</a></li>
    @endauth
  </ul>
</div>