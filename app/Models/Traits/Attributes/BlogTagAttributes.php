<?php

namespace App\Models\Traits\Attributes;

trait BlogTagAttributes
{
    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group action-btn">
                    '.$this->getEditButtonAttribute('edit-blog-tag', 'admin.blog-tags.edit').'
                    '.$this->getDeleteButtonAttribute('delete-blog-tag', 'admin.blog-tags.destroy').'
                </div>';
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
     * Get Display Status Attribute.
     *
     * @var string
     */
    public function getDisplayStatusAttribute(): string
    {
        return $this->isActive() ? 'Active' : 'InActive';
    }
}
