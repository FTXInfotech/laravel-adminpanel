<?php
Breadcrumbs::for('admin.customer.index', function ($trail) {
    $trail->push(__('Customer Management'), route('admin.customer.index'));
});

// Breadcrumbs::for('admin.company.deactivated', function ($trail) {
//     $trail->parent('admin.company.index');
//     $trail->push(__('Company Deactivate'), route('admin.company.deactivated'));
// });

Breadcrumbs::for('admin.customer.deleted', function ($trail) {
    $trail->parent('admin.customer.index');
    $trail->push(__('Customer Deleted'), route('admin.customer.deleted'));
});

Breadcrumbs::for('admin.customer.deactivated', function ($trail) {
    $trail->parent('admin.customer.index');
    $trail->push(__('Deactivated Customers'), route('admin.customer.deactivated'));
});

Breadcrumbs::for('admin.customer.create', function ($trail) {
    $trail->parent('admin.customer.index');
    $trail->push(__('Create Customer'), route('admin.customer.create'));
});

Breadcrumbs::for('admin.customer.show', function ($trail, $id) {
    $trail->parent('admin.customer.index');
    $trail->push(__('View Customer'), route('admin.customer.show', $id));
});

Breadcrumbs::for('admin.customer.edit', function ($trail, $id) {
    $trail->parent('admin.customer.index');
    $trail->push(__('Update Customer'), route('admin.customer.edit', $id));
});