<?php


namespace App\Http\Controllers\Api\Facility\Auth\Traits;


trait RedirectTo
{
    public function redirectTo()
    {
        $this->redirectTo = 'workspace';
        return $this->redirectTo;
    }
}
