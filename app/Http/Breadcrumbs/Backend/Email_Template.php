<?php

Breadcrumbs::register('admin.emailtemplates.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.emailtemplates.management'), route('admin.emailtemplates.index'));
});

Breadcrumbs::register('admin.emailtemplates.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.emailtemplates.index');
    $breadcrumbs->push(trans('menus.backend.emailtemplates.create'), route('admin.emailtemplates.create'));
});

Breadcrumbs::register('admin.emailtemplates.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.emailtemplates.index');
    $breadcrumbs->push(trans('menus.backend.emailtemplates.edit'), route('admin.emailtemplates.edit', $id));
});
