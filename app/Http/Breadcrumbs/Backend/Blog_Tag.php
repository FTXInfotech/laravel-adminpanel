<?php

Breadcrumbs::register('admin.blogTags.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.blogtags.management'), route('admin.blogTags.index'));
});

Breadcrumbs::register('admin.blogTags.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.blogTags.index');
    $breadcrumbs->push(trans('menus.backend.blogtags.create'), route('admin.blogTags.create'));
});

Breadcrumbs::register('admin.blogTags.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.blogTags.index');
    $breadcrumbs->push(trans('menus.backend.blogtags.edit'), route('admin.blogTags.edit', $id));
});
