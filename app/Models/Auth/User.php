<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\UserAttribute;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\Auth\UserAccess;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use OwenIt\Auditing\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Webpatser\Uuid\Uuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use App\Notifications\Auth\ResetPasswordNotification;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements AuditableContract, HasMedia
{
    use HasApiTokens, Notifiable, UserAccess, UserRelationship, UserAttribute, Auditable, SoftDeletes, InteractsWithMedia;


    public function registerMediaConversions(Media $media = null): void
    {
        // TODO: Implement registerMediaConversions() method.
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(400);
    }


    protected $guard = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['uuid'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var array
     */
    protected $auditableEvents = [
        'deleted',
        'updated',
        'restored',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify((new ResetPasswordNotification($token))->onQueue('reset-password-link'));
    }
}
