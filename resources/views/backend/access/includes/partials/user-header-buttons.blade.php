<!--Action Button-->
    @if(Active::checkUriPattern('admin/access/user') || Active::checkUriPattern('admin/access/user/deleted') || Active::checkUriPattern('admin/access/user/deactivated'))
        @include('backend.access.includes.partials.header-export')
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">@lang('menus.backend.access.users.action')
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.access.user.index')}}"><i class="fa fa-list-ul"></i> @lang('menus.backend.access.users.list')</a></li>
    @permission('create-user')
    <li><a href="{{route('admin.access.user.create')}}"><i class="fa fa-plus"></i> @lang('menus.backend.access.users.add-new')</a></li>
    @endauth
    @permission('view-deactive-user')
    <li><a href="{{route('admin.access.user.deactivated')}}"><i class="fa fa-square"></i> @lang('menus.backend.access.users.deactivated-users')</a></li>
    @endauth
    @permission('view-deleted-user')
    <li><a href="{{route('admin.access.user.deleted')}}"><i class="fa fa-trash"></i> @lang('menus.backend.access.users.deleted-users')</a></li>
    @endauth
  </ul>
</div>