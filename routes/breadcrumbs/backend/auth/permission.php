<?php

Breadcrumbs::for('admin.auth.permission.index', function ($trail) {
    $trail->push(__('menus.backend.access.permissions.management'), route('admin.auth.permission.index'));
});

Breadcrumbs::for('admin.auth.permission.create', function ($trail) {
    $trail->parent('admin.auth.permission.index');
    $trail->push(__('menus.backend.access.permissions.create'), route('admin.auth.permission.create'));
});

Breadcrumbs::for('admin.auth.permission.edit', function ($trail, $id) {
    $trail->parent('admin.auth.permission.index');
    $trail->push(__('menus.backend.access.permissions.edit'), route('admin.auth.permission.edit', $id));
});
