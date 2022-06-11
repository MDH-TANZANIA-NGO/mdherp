<?php

namespace App\Models\location;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Location extends Model
{

    public $table = 'locations';

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
