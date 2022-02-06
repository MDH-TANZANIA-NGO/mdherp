<?php


namespace App\Http\Controllers\Auth\Traits;


trait RedirectTo
{
    public function redirectTo()
    {
        $this->redirectTo = 'workspace';
        return $this->redirectTo;
    }
}
