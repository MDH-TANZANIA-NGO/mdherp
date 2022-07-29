<?php

namespace App\Http\Controllers\Api\MdhStaff;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\Access\UserRepository;
use Illuminate\Http\Request;

class MdhStaffController extends BaseController
{
    //
    protected $user;
    public function __construct()
    {
        $this->user = (new UserRepository());
    }

    public function getActiveUsers()
    {
        $users =  $this->user->getActive()->get();
        $data['users'] = $users;

        return $this->sendResponse($data, 'All active users retrieved successfully');
    }
}
