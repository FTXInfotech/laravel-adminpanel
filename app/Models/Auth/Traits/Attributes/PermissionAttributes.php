<?php

namespace App\Models\Auth\Traits\Attributes;

trait PermissionAttributes
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
