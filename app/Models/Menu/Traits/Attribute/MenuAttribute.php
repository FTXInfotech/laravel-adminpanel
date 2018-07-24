<?php

namespace App\Models\Menu\Traits\Attribute;

/**
 * Class MenuAttribute.
 */
trait MenuAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-menu', 'admin.menus.edit').'
                    '.$this->getDeleteButtonAttribute('delete-menu', 'admin.menus.destroy').'
                </div>';
    }
}
