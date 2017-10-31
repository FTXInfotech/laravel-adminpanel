<?php

namespace App\Models\CMSPages\Traits\Attribute;

/**
 * Class CMSPageAttribute.
 */
trait CMSPageAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-cms-pages', 'admin.cmspages.edit').'
                    '.$this->getDeleteButtonAttribute('delete-cms-pages', 'admin.cmspages.destroy').'
                </div>';
    }
}
