<?php

namespace App\Events\Backend;

use App\Models\Page;
use Illuminate\Queue\SerializesModels;

class PageUpdated
{
    use SerializesModels;

    /**
     * Instance of Page Model
     * 
     * @var \App\Models\Page
     */
    public $page;

    /**
     * @param \App\Models\Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }
}
