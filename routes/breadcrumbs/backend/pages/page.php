<?php

Breadcrumbs::for('admin.pages.index', function ($trail) {
    $trail->push(__('labels.backend.access.pages.management'), route('admin.pages.index'));
});

Breadcrumbs::for('admin.pages.create', function ($trail) {
    $trail->parent('admin.pages.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.pages.create'));
});

Breadcrumbs::for('admin.pages.edit', function ($trail, $id) {
    $trail->parent('admin.pages.index');
    $trail->push(__('labels.backend.access.pages.management'), route('admin.pages.edit', $id));
});
