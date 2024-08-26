<?php

namespace Modules\Client\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Client\Models\Client;

class ClientObserver
{
    public function creating(Client $client)
    {
        $client->created_by = Auth::id();
        $client->updated_by = Auth::id();
    }

    public function updating(Client $client)
    {
        $client->updated_by = Auth::id();
    }

    public function deleting(Client $client)
    {
        $client->deleted_by = Auth::id();
        $client->save();
    }
}