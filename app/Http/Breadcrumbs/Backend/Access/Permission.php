<?php

Breadcrumbs::register('admin.access.permission.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.access.permissions.management'), route('admin.access.permission.index'));
});

Breadcrumbs::register('admin.access.permission.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.access.permission.index');
    $breadcrumbs->push(trans('menus.backend.access.permissions.create'), route('admin.access.permission.create'));
});

Breadcrumbs::register('admin.access.permission.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.access.permission.index');
    $breadcrumbs->push(trans('menus.backend.access.permissions.edit'), route('admin.access.permission.edit', $id));
});
