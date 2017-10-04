<?php

Breadcrumbs::register('admin.settings.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.settings.edit'), route('admin.settings.edit', $id));
});
