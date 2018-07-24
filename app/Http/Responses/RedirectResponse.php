<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class RedirectResponse implements Responsable
{
    protected $route;
    protected $message;

    public function __construct($route, $message)
    {
        $this->route = $route;
        $this->message = $message;
    }

    public function toResponse($request)
    {
        return redirect()
            ->to($this->route)
            ->with($this->message);
    }
}
