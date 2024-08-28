<?php

namespace Modules\Client\Models;

use Modules\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

// use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;

class Client extends Model
{
    use SoftDeletes, Notifiable;

    protected $fillable = [
        'client_name',
        'facility_level',
        'location',
        'contact_person_name',
        'contact_person_phone',
        'email',
        'support_engineer_name',
        'support_engineer_phone',
        'support_engineer_email',
        'billing_cycle_years',
    ];

    protected $dates = ['deleted_at'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // You may also define the updatedBy and deletedBy relationships similarly
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    //  // Implement MustVerifyEmail methods

    // public function hasVerifiedEmail()
    // {
    //     return !is_null($this->email_verified_at);
    // }

    // public function markEmailAsVerified()
    // {
    //     $this->email_verified_at = now();
    //     $this->save();
    // }

    // public function sendEmailVerificationNotification()
    // {
    //     $this->notify(new ClientEmailVerificationNotification($this));
    // }
}
