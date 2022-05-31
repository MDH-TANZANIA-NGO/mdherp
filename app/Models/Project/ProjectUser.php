<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $guarded = ['id'];

    protected $table = 'project_user';
}
