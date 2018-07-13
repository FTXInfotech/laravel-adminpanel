<?php

Breadcrumbs::register('admin.menus.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.menus.management'), route('admin.menus.index'));
});

Breadcrumbs::register('admin.menus.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.menus.index');
    $breadcrumbs->push(trans('menus.backend.menus.create'), route('admin.menus.create'));
});

Breadcrumbs::register('admin.menus.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.menus.index');
    $breadcrumbs->push(trans('menus.backend.menus.edit'), route('admin.menus.edit', $id));
});
