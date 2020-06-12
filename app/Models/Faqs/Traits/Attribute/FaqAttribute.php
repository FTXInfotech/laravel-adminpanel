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
    public function getStatusButtonAttribute()
    {
        switch ($this->status && access()->allow('edit-faq')) {
            case 0:
                return '<a href="'.route('admin.faqs.mark', [$this, 1]).'" class="btn btn-flat btn-default"><i class="fa fa-check-square" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.activate').'"></i></a>';

            case 1:
                return '<a href="'.route('admin.faqs.mark', [$this, 0]).'" class="btn btn-flat btn-default"><i class="fa fa-square" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.backend.access.users.deactivate').'"></i></a>';

            default:
                return '';
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
                $this->getEditButtonAttribute('edit-faq', 'admin.faqs.edit').
                $this->getDeleteButtonAttribute('delete-faq', 'admin.faqs.destroy').
                $this->getStatusButtonAttribute().
                '</div>';
    }
}
