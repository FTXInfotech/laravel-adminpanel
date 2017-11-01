<?php

namespace App\Models\BlogCategories\Traits\Attribute;

/**
 * Class BlogCategoryAttribute.
 */
trait BlogCategoryAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-blog-category', 'admin.blogcategories.edit').'
                    '.$this->getDeleteButtonAttribute('delete-blog-category', 'admin.blogcategories.destroy').'
                </div>';
    }
}
