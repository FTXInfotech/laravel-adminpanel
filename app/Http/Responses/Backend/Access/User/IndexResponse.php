<?php

namespace App\Http\Responses\Backend\Access\User;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    /**
     * In Response
     *
     * @param \App\Http\Requests\Request $request
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function toResponse($request)
    {
        return view('backend.access.users.index');
    }
}
