<?php

namespace App\Models\Blogs\Traits\Relationship;

use App\Models\Access\User\User;
use App\Models\BlogCategories\BlogCategory;
use App\Models\BlogTags\BlogTag;

/**
 * Class BlogRelationship.
 */
trait BlogRelationship
{
    /**
     * Blogs has many relationship with categories.
     */
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_map_categories', 'blog_id', 'category_id');
    }

    /**
     * Blogs has many relationship with tags.
     */
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_map_tags', 'blog_id', 'tag_id');
    }

    /**
     * Blogs belongsTo with User.
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
