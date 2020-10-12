<?php

Breadcrumbs::for('admin.faqs.index', function ($trail) {
    $trail->push(__('labels.backend.access.faqs.management'), route('admin.faqs.index'));
});

Breadcrumbs::for('admin.faqs.create', function ($trail) {
    $trail->parent('admin.faqs.index');
    $trail->push(__('labels.backend.access.faqs.management'), route('admin.faqs.create'));
});

Breadcrumbs::for('admin.faqs.edit', function ($trail, $id) {
    $trail->parent('admin.faqs.index');
    $trail->push(__('labels.backend.access.faqs.management'), route('admin.faqs.edit', $id));
});
