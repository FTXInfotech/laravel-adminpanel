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
        return '<div class="btn-group action-btn">'.$this->getEditButtonAttribute('edit-email-template', 'admin.emailtemplates.edit').'</div>';
    }
}
