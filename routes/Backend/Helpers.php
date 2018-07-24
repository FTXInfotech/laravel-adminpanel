<?php

/*
 * General Slug generator
 */
Route::any('generateSlug', function (\Illuminate\Http\Request $request) {
    return str_slug($request['text']);
})->name('generate.slug');
