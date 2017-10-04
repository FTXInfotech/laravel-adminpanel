<?php

Breadcrumbs::register('admin.blogtags.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.blogtags.management'), route('admin.blogtags.index'));
});

Breadcrumbs::register('admin.blogtags.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.blogtags.index');
    $breadcrumbs->push(trans('menus.backend.blogtags.create'), route('admin.blogtags.create'));
});

Breadcrumbs::register('admin.blogtags.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.blogtags.index');
    $breadcrumbs->push(trans('menus.backend.blogtags.edit'), route('admin.blogtags.edit', $id));
});
