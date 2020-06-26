<?php

namespace App\Models\Auth\Traits\Attributes;

trait RoleAttributes
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-role')) {
            return '<a class="btn btn-flat btn-primary btn-sm" href="'.route('admin.auth.role.edit', $this).'">
                    <i data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.edit').'" class="fas fa-edit"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        //Can't delete master admin role
        if ($this->id != 1 && access()->allow('delete-role')) {
            return '<a class="btn btn-flat btn-danger btn-sm" href="'.route('admin.auth.role.destroy', $this).'" data-method="delete"
                        data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                        data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                        data-trans-title="'.trans('strings.backend.general.are_you_sure').'">
                            <i data-toggle="tooltip" data-placement="top" title="'.trans('buttons.general.crud.delete').'" class="fa fa-trash"></i>
                    </a>';
        }

        return '';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-role', 'admin.auth.role.edit').'
                    '.$this->getDeleteButtonAttribute().'
                </div>';
    }
}
