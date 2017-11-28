<?php

namespace App\Models\Page\Traits\Attribute;

/**
 * Class PageAttribute.
 */
trait PageAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-cms-pages', 'admin.pages.edit').'
                    '.$this->getDeleteButtonAttribute('delete-cms-pages', 'admin.pages.destroy').'
                </div>';
    }
}
