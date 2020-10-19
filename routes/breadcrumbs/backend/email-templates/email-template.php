<?php

Breadcrumbs::for('admin.email-templates.index', function ($trail) {
    $trail->push(__('labels.backend.access.email-templates.management'), route('admin.email-templates.index'));
});

Breadcrumbs::for('admin.email-templates.create', function ($trail) {
    $trail->parent('admin.email-templates.index');
    $trail->push(__('labels.backend.access.email-templates.management'), route('admin.email-templates.create'));
});

Breadcrumbs::for('admin.email-templates.edit', function ($trail, $id) {
    $trail->parent('admin.email-templates.index');
    $trail->push(__('labels.backend.access.email-templates.management'), route('admin.email-templates.edit', $id));
});
