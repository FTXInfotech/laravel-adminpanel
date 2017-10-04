<?php

Breadcrumbs::register('admin.blogcategories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.blogcategories.management'), route('admin.blogcategories.index'));
});

Breadcrumbs::register('admin.blogcategories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.blogcategories.index');
    $breadcrumbs->push(trans('menus.backend.blogcategories.create'), route('admin.blogcategories.create'));
});

Breadcrumbs::register('admin.blogcategories.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.blogcategories.index');
    $breadcrumbs->push(trans('menus.backend.blogcategories.edit'), route('admin.blogcategories.edit', $id));
});
