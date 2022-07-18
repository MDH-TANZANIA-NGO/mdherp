<?php

namespace App\Models\Interval;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Driver\Driver;


class Interval extends Model
{


    use SoftDeletes;

    public $table = 'intervals';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'from',
        'to',
        'user_id',
        'duration',
        'driving_distance',
        'user_id_id',
        'fleet_id_id',
        'vehicle',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

}
