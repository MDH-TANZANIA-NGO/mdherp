<?php

namespace App\Models\location;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{

    public $table = 'maps';

    protected $dates = [

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [

        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
