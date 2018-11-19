<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <li class="{{ active_class(Active::checkUriPattern('admin/dashboard')) }}">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{ trans('menus.backend.sidebar.dashboard') }}</span>
                </a>
            </li>

            <li class="header">{{ trans('menus.backend.sidebar.system') }}</li>

            @permission('view-access-management')
            <li class="{{ active_class(Active::checkUriPattern('admin/access/*')) }} treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>{{ trans('menus.backend.access.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/access/*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/access/*'), 'display: block;') }}">
                    @permission('view-user-management')
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/user*')) }}">
                        <a href="{{ route('admin.access.user.index') }}">
                            <span>{{ trans('labels.backend.access.users.management') }}</span>
                        </a>
                    </li>
                    @endauth
                    @permission('view-role-management')
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/role*')) }}">
                        <a href="{{ route('admin.access.role.index') }}">
                            <span>{{ trans('labels.backend.access.roles.management') }}</span>
                        </a>
                    </li>
                    @endauth
                    @permission('view-permission-management')
                    <li class="{{ active_class(Active::checkUriPattern('admin/access/permission*')) }}">
                        <a href="{{ route('admin.access.permission.index') }}">
                            <span>{{ trans('labels.backend.access.permissions.management') }}</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </li>
            @endauth
            @permission('view-page')
            <li class="{{ active_class(Active::checkUriPattern('admin/pages*')) }}">
                <a href="{{ route('admin.pages.index') }}">
                    <i class="fa fa-file-text"></i>
                    <span>{{ trans('labels.backend.pages.title') }}</span>
                </a>
            </li>
            @endauth
            @permission('edit-settings')
            <li class="{{ active_class(Active::checkUriPattern('admin/settings*')) }}">
                <a href="{{ route('admin.settings.edit', 1 ) }}">
                    <i class="fa fa-gear"></i>
                    <span>{{ trans('labels.backend.settings.title') }}</span>
                </a>
            </li>
            @endauth
            <li class="{{ active_class(Active::checkUriPattern('admin/modules*')) }}">
                <a href="{{ route('admin.modules.index') }}">
                    <i class="fa fa-gear"></i>
                    <span>{{ trans('generator::menus.modules.management') }}</span>
                </a>
            </li>
            @permission('view-blog')
            <li class="{{ active_class(Active::checkUriPattern('admin/blog*')) }} treeview">
                <a href="#">
                    <i class="fa fa-commenting"></i>
                    <span>{{ trans('menus.backend.blog.management') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>

                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/blog*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/blog*'), 'display: block;') }}">
                    @permission('view-blog-category')
                    <li class="{{ active_class(Active::checkUriPattern('admin/blogCategories*')) }}">
                        <a href="{{ route('admin.blogCategories.index') }}">
                            <span>{{ trans('menus.backend.blogcategories.management') }}</span>
                        </a>
                    </li>
                    @endauth
                    @permission('view-blog-tag')
                    <li class="{{ active_class(Active::checkUriPattern('admin/blogTags*')) }}">
                        <a href="{{ route('admin.blogTags.index') }}">
                            <span>{{ trans('menus.backend.blogtags.management') }}</span>
                        </a>
                    </li>
                    @endauth
                    @permission('view-blog')
                    <li class="{{ active_class(Active::checkUriPattern('admin/blogs*')) }}">
                        <a href="{{ route('admin.blogs.index') }}">
                            <span>{{ trans('menus.backend.blog.management') }}</span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </li>
            @endauth

            @permission('view-faq')
                <li class="{{ active_class(Active::checkUriPattern('admin/faqs*')) }}">
                <a href="{{ route('admin.faqs.index')}}">
                    <i class="fa fa-question-circle"></i>
                    <span>{{ trans('labels.backend.faqs.title') }}</span>
                </a>
                </li>
            @endauth

            <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer*')) }} treeview">
                <a href="#">
                    <i class="fa fa-list"></i>
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'menu-open') }}" style="display: none; {{ active_class(Active::checkUriPattern('admin/log-viewer*'), 'display: block;') }}">
                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer')) }}">
                        <a href="{{ route('log-viewer::dashboard') }}">
                            <span>{{ trans('menus.backend.log-viewer.dashboard') }}</span>
                        </a>
                    </li>

                    <li class="{{ active_class(Active::checkUriPattern('admin/log-viewer/logs')) }}">
                        <a href="{{ route('log-viewer::logs.list') }}">
                            <span>{{ trans('menus.backend.log-viewer.logs') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section><!-- /.sidebar -->
</aside>