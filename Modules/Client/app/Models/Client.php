<?php

namespace Modules\Client\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

class Client extends Model
{
    use SoftDeletes;

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
}
