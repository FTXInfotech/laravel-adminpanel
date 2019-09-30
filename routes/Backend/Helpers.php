<?php

use Illuminate\Support\Str;

/*
 * General Slug generator
 */
Route::any('generateSlug', function (Illuminate\Http\Request $request) {
    return Str::slug($request['text']);
})->name('generate.slug');
