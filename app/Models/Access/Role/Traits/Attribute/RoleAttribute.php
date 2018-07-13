<?php

namespace App\Models\Access\Role\Traits\Attribute;

/**
 * Class RoleAttribute.
 */
trait RoleAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if (access()->allow('edit-role')) {
            return '<a class="btn btn-flat btn-default" href="'.route('admin.access.role.edit', $this).'">
                    <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
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
            return '<a class="btn btn-flat btn-default" href="'.route('admin.access.role.destroy', $this).'" data-method="delete"
                        data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                        data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                        data-trans-title="'.trans('strings.backend.general.are_you_sure').'">
                            <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
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
                    '.$this->getEditButtonAttribute('edit-role', 'admin.access.role.edit').'
                    '.$this->getDeleteButtonAttribute().'
                </div>';
    }
}
