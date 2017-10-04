<?php

Breadcrumbs::register('admin.modules.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.modules.management'), route('admin.modules.index'));
});

Breadcrumbs::register('admin.modules.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.modules.index');
    $breadcrumbs->push(trans('menus.backend.modules.create'), route('admin.modules.create'));
});

Breadcrumbs::register('admin.modules.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.modules.index');
    $breadcrumbs->push(trans('menus.backend.modules.edit'), route('admin.modules.edit', $id));
});
