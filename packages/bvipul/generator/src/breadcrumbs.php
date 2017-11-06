<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::register('admin.modules.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('generator::menus.modules.management'), route('admin.modules.index'));
});

Breadcrumbs::register('admin.modules.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.modules.index');
    $breadcrumbs->push(trans('generator::menus.modules.create'), route('admin.modules.create'));
});

Breadcrumbs::register('admin.modules.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.modules.index');
    $breadcrumbs->push(trans('generator::menus.modules.edit'), route('admin.modules.edit', $id));
});
