<?php

Breadcrumbs::for('admin.blogs.index', function ($trail) {
    $trail->push(__('labels.backend.access.blogs.management'), route('admin.blogs.index'));
});

Breadcrumbs::for('admin.blogs.create', function ($trail) {
    $trail->parent('admin.blogs.index');
    $trail->push(__('labels.backend.access.blogs.management'), route('admin.blogs.create'));
});

Breadcrumbs::for('admin.blogs.edit', function ($trail, $id) {
    $trail->parent('admin.blogs.index');
    $trail->push(__('labels.backend.access.blogs.management'), route('admin.blogs.edit', $id));
});
