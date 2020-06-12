<?php

namespace App\Models\EmailTemplates\Traits\Attribute;

/**
 * Class EmailTemplateAttribute.
 */
trait EmailTemplateAttribute
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-email-template', 'admin.email-template.edit').'
                    '.$this->getViewButtonAttribute().'                    
                    '.$this->getDeleteButtonAttribute('delete-email-template', 'admin.email-template.destroy').'
                </div>';
    }

    /**
     * @return string
     */
    public function getViewButtonAttribute()
    {
        return '<a target="_blank" href="'.route('frontend.email-template.show', $this->email_template_slug).'" class="btn btn-flat btn-default">
                    <i data-toggle="tooltip" data-placement="top" title="View Page" class="fa fa-eye"></i>
                </a>';
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
}
