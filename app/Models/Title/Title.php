<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $table = 'titles';

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


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}