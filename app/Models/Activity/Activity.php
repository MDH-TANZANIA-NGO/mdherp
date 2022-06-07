<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Activity extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'activities';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

   

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function meetings()
    {
        return $this->belongsToMany(Meeting::class);
    }

}
