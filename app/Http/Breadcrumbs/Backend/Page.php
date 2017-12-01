<?php

Breadcrumbs::register('admin.pages.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.pages.management'), route('admin.pages.index'));
});

Breadcrumbs::register('admin.pages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push(trans('menus.backend.pages.create'), route('admin.pages.create'));
});

Breadcrumbs::register('admin.pages.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.pages.index');
    $breadcrumbs->push(trans('menus.backend.pages.edit'), route('admin.pages.edit', $id));
});
