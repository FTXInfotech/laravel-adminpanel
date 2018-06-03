<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class ViewResponse implements Responsable
{
    /**
     * @var string
     */
    protected $view;

    /**
     * @var array
     */
    protected $with;

    /**
     * @param string $view
     * @param array  $with
     */
    public function __construct($view, $with = [])
    {
        $this->view = $view;
        $this->with = $with;
    }

    /**
     * In Response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        if (!empty($this->with)) {
            return view($this->view)->with($this->with);
        }

        return view($this->view);
    }
}
