<?php

Breadcrumbs::register('admin.cmspages.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.cmspages.management'), route('admin.cmspages.index'));
});

Breadcrumbs::register('admin.cmspages.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.cmspages.index');
    $breadcrumbs->push(trans('menus.backend.cmspages.create'), route('admin.cmspages.create'));
});

Breadcrumbs::register('admin.cmspages.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.cmspages.index');
    $breadcrumbs->push(trans('menus.backend.cmspages.edit'), route('admin.cmspages.edit', $id));
});
