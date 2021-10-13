<?php

namespace App\Models;

use Approval\Traits\ApprovesChanges;
use Approval\Traits\RequiresApproval;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasFactory, Notifiable;
    use RequiresApproval;
    use ApprovesChanges;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function receivedMessages() {
        return $this->belongsTo(\App\Models\ChMessage::class, 'id', 'to_id');
    }

    public function operator() {
        return $this->hasOne(Operator::class);
    }

    public function applicant() {
        return $this->hasOne(Applicant::class);
    }
}
