<?php

namespace App\Models\GOfficer;

use App\Models\Facility\Facility;
use App\Models\GOfficer\Traits\Attribute\GOfficerAttribute;
use App\Models\GOfficer\Traits\Relationship\GOfficerRelationship;
use App\Models\Requisition\Training\requisition_training_cost;
use App\Models\System\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable;
use Webpatser\Uuid\Uuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use App\Notifications\Auth\ResetPasswordNotification;
//use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class GOfficer extends Authenticatable implements AuditableContract
{
    use Notifiable, HasApiTokens, GOfficerAttribute, GOfficerRelationship, Auditable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['uuid'];

    protected $guard = 'g_officer';

    protected $table = 'g_officers';

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
//        $this->notify((new ResetPasswordNotification($token))->onQueue('reset-password-link'));
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class)->withPivot('id');
    }
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function Training()
    {
        return $this->belongsTo(requisition_training_cost::class, 'id', 'participant_uid');
    }
}
