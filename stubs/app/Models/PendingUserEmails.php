<?php

namespace Jersyfi\VerifyEmail\Models;

use Illuminate\Database\Eloquent\Model;

class PendingUserEmails extends Model
{
    const UPDATED_AT = null;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pending_user_emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'email'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
}
