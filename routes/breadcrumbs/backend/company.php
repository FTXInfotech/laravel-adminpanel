<?php
Breadcrumbs::for('admin.company.index', function ($trail) {
    $trail->push(__('Company Management'), route('admin.company.index'));
});

// Breadcrumbs::for('admin.company.deactivated', function ($trail) {
//     $trail->parent('admin.company.index');
//     $trail->push(__('Company Deactivate'), route('admin.company.deactivated'));
// });

Breadcrumbs::for('admin.company.deleted', function ($trail) {
    $trail->parent('admin.company.index');
    $trail->push(__('Company Deleted'), route('admin.company.deleted'));
});

Breadcrumbs::for('admin.company.deactivated', function ($trail) {
    $trail->parent('admin.company.index');
    $trail->push(__('Deactivated Company'), route('admin.company.deactivated'));
});

Breadcrumbs::for('admin.company.create', function ($trail) {
    $trail->parent('admin.company.index');
    $trail->push(__('Create Company'), route('admin.company.create'));
});

Breadcrumbs::for('admin.company.show', function ($trail, $id) {
    $trail->parent('admin.company.index');
    $trail->push(__('View Company'), route('admin.company.show', $id));
});

Breadcrumbs::for('admin.company.edit', function ($trail, $id) {
    $trail->parent('admin.company.index');
    $trail->push(__('Update Company'), route('admin.company.edit', $id));
});