<?php

namespace App\Http\Controllers\Web\Employee;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\User\Datatables\UserDatatables;
use App\Models\Auth\User;
use App\Repositories\Access\UserRepository;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    use UserDatatables;


    protected $users;


    public function __construct()
    {
        $this->users = (new UserRepository());
    }

    public function index()
    {
        return view('employee.datatables.all')
            ->with('active_user_count', $this->users->getActive()->get()->count())
            ->with('inactive_user_count', $this->users->getInactive()->get()->count());
    }
}
