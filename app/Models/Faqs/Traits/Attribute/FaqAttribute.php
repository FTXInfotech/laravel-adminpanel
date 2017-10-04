<?php

namespace App\Models\Faqs\Traits\Attribute;

/**
 * Class FaqAttribute.
 */
trait FaqAttribute
{
    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        if(access()->allow('edit-faq'))
        {
        return '<a href="'.route('admin.faqs.edit', $this).'" class="btn btn-flat btn-default">
                    <i data-toggle="tooltip" data-placement="top" title="Edit" class="fa fa-pencil"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if(access()->allow('delete-faq'))
        {
            return '<a href="'.route('admin.faqs.destroy', $this).'" 
                    class="btn btn-flat btn-default" data-method="delete"
                    data-trans-button-cancel="'.trans('buttons.general.cancel').'"
                    data-trans-button-confirm="'.trans('buttons.general.crud.delete').'"
                    data-trans-title="'.trans('strings.backend.general.are_you_sure').'">
                        <i data-toggle="tooltip" data-placement="top" title="Delete" class="fa fa-trash"></i>
                </a>';    
        }
    }

     /**
     * @return string
     */
    public function getStatusButtonAttribute()
    {
        switch ($this->status && access()->allow('edit-faq'))
        {
            case 0:
                return '<a href="'.route('admin.faqs.mark', [$this,1]).'" class="btn btn-flat btn-default"><i class="fa fa-check-square" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.activate').'"></i></a>';
            // No break

            case 1:
                return '<a href="'.route('admin.faqs.mark', [$this,0]).'" class="btn btn-flat btn-default"><i class="fa fa-square" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.deactivate').'"></i></a>';
            // No break

            default:
                return '';
            // No break
        }

        return '';
    }

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        if ($this->isActive()) {
            return "<label class='label label-success'>".trans('labels.general.active').'</label>';
        }

        return "<label class='label label-danger'>".trans('labels.general.inactive').'</label>';
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->status == 1;
    }
    
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">'.
                $this->getEditButtonAttribute().
                $this->getDeleteButtonAttribute().
                $this->getStatusButtonAttribute().
                '</div>';
    }
}
