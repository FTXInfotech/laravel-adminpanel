<li class="{{ active_class(isActiveMenuItem($item)) }} @if(!empty($item->children)) {{ 'treeview' }} @endif ">
    <a href="{{ getRouteUrl($item->url, $item->url_type) }}" @if(!empty($item->open_in_new_tab) && ($item->open_in_new_tab == 1)) {{ 'target="_blank"' }} @endif>
        <i class="fa {{ @$item->icon }}"></i>
        <span>{{ $item->name }}</span>
        @if (!empty($item->children))
            <i class="fa fa-angle-left pull-right"></i>
        @endif
    </a>
    @if (!empty($item->children))
    <ul class="treeview-menu {{ active_class(isActiveMenuItem($item), 'menu-open') }}" style="display: none; {{ active_class(isActiveMenuItem($item), 'display: block;') }}">
        {{ renderMenuItems($item->children) }}
    </ul>
    @endif
</li>
