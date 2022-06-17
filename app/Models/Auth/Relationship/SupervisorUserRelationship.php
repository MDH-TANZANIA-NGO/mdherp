<?php


namespace App\Models\Auth\Relationship;


use App\Models\Auth\User;

trait SupervisorUserRelationship
{
        public function users()
        {
            return $this->hasMany(User::class);
        }
}
