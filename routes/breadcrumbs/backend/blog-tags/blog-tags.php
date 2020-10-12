<?php

Breadcrumbs::for('admin.blog-tags.index', function ($trail) {
    $trail->push(__('labels.backend.access.blog-tag.management'), route('admin.blog-tags.index'));
});

Breadcrumbs::for('admin.blog-tags.create', function ($trail) {
    $trail->parent('admin.blog-tags.index');
    $trail->push(__('labels.backend.access.blog-tag.management'), route('admin.blog-tags.create'));
});

Breadcrumbs::for('admin.blog-tags.edit', function ($trail, $id) {
    $trail->parent('admin.blog-tags.index');
    $trail->push(__('labels.backend.access.blog-tag.management'), route('admin.blog-tags.edit', $id));
});
