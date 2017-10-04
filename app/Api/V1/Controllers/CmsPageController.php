<?php

namespace App\Api\V1\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Api\CmsPage\CmsPageRepository;

class CmsPageController extends Controller
{
    public function __construct(CmsPageRepository $cmsgpage) 
    {
        $this->cmsgpage=$cmsgpage;
    }
    
    public function showCmsPage($page_slug) 
    {
          $result = $this->cmsgpage->findBySlug($page_slug); 
          return response()
                    ->json([
	                'status' => 'ok',
	                'data' => $result
                    ]);
    }
}
