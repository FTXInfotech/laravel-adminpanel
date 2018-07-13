<?php

namespace App\Models\Settings;

use App\Models\BaseModel;

class Setting extends BaseModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['logo', 'favicon', 'seo_title', 'seo_keyword', 'seo_description', 'company_contact', 'company_address', 'from_name', 'from_email', 'footer_text', 'copyright_text', 'terms', 'disclaimer', 'google_analytics'];

    public function __construct()
    {
        $this->table = config('access.settings_table');
    }
}
