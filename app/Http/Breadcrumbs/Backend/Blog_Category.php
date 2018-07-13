<?php

Breadcrumbs::register('admin.blogCategories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.blogcategories.management'), route('admin.blogCategories.index'));
});

Breadcrumbs::register('admin.blogCategories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.blogCategories.index');
    $breadcrumbs->push(trans('menus.backend.blogcategories.create'), route('admin.blogCategories.create'));
});

Breadcrumbs::register('admin.blogCategories.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.blogCategories.index');
    $breadcrumbs->push(trans('menus.backend.blogcategories.edit'), route('admin.blogCategories.edit', $id));
});
