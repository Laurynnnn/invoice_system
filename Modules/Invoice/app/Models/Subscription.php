<?php

namespace Modules\Invoice\Models;

use Modules\User\Models\User;
use Modules\Client\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Invoice\Database\Factories\SubscriptionFactory;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'client_id',
        'billing_cycle_years',
        'amount',
        'payment_status',
        'start_date',
        'end_date',
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

    public function client(){
        return $this->belongsTo(Client::class);
    }

    // protected static function newFactory(): SubscriptionFactory
    // {
    //     //return SubscriptionFactory::new();
    // }
}
