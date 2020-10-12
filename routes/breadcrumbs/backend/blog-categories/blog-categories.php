<?php

Breadcrumbs::for('admin.blog-categories.index', function ($trail) {
    $trail->push(__('labels.backend.access.blog-category.management'), route('admin.blog-categories.index'));
});

Breadcrumbs::for('admin.blog-categories.create', function ($trail) {
    $trail->parent('admin.blog-categories.index');
    $trail->push(__('labels.backend.access.blog-category.management'), route('admin.blog-categories.create'));
});

Breadcrumbs::for('admin.blog-categories.edit', function ($trail, $id) {
    $trail->parent('admin.blog-categories.index');
    $trail->push(__('labels.backend.access.blog-category.management'), route('admin.blog-categories.edit', $id));
});
