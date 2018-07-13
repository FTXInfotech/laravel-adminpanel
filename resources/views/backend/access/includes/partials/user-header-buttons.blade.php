<!--Action Button-->
    @if(Active::checkUriPattern('admin/access/user') || Active::checkUriPattern('admin/access/user/deleted') || Active::checkUriPattern('admin/access/user/deactivated'))
        <div class="btn-group">
          <button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown">Export
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu">
            <li id="copyButton"><a href="#"><i class="fa fa-clone"></i>Copy</a></li>
            <li id="csvButton"><a href="#"><i class="fa fa-file-text-o"></i> CSV</a></li>
            <li id="excelButton"><a href="#"><i class="fa fa-file-excel-o"></i> Excel</a></li>
            <li id="pdfButton"><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li>
            <li id="printButton"><a href="#"><i class="fa fa-print"></i> Print</a></li>
          </ul>
        </div>
    @endif
<!--Action Button-->
<div class="btn-group">
  <button type="button" class="btn btn-primary btn-flat dropdown-toggle" data-toggle="dropdown">Action
    <span class="caret"></span>
    <span class="sr-only">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu" role="menu">
    <li><a href="{{route('admin.access.user.index')}}"><i class="fa fa-list-ul"></i> List</a></li>
    @permission('create-user')
    <li><a href="{{route('admin.access.user.create')}}"><i class="fa fa-plus"></i> Add new</a></li>
    @endauth
    @permission('view-deactive-user')
    <li><a href="{{route('admin.access.user.deactivated')}}"><i class="fa fa-square"></i> Deactivated Users</a></li>
    @endauth
    @permission('view-deleted-user')
    <li><a href="{{route('admin.access.user.deleted')}}"><i class="fa fa-trash"></i> Deleted Users</a></li>
    @endauth
  </ul>
</div>