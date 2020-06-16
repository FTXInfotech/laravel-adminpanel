<?php

namespace App\Models\Auth\Permission\Traits\Attribute;

/**
 * Class PermissionAttribute.
 */
trait PermissionAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-permission', 'admin.auth.permission.edit').'
                    '.$this->getDeleteButtonAttribute('delete-permission', 'admin.auth.permission.destroy').'
                </div>';
    }
}
