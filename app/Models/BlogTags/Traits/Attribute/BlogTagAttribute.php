<?php

namespace App\Models\BlogTags\Traits\Attribute;

/**
 * Class BlogTagAttribute.
 */
trait BlogTagAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-blog-tag', 'admin.blogtags.edit').'
                    '.$this->getDeleteButtonAttribute('delete-blog-tag', 'admin.blogtags.destroy').'
                </div>';
    }
}
