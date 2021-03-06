<?php

namespace App;

use App\Tenant\Traits\ForTenants;
use Illuminate\Database\Eloquent\Model;

class AccountPayable extends Model
{
    protected  $fillable = ['entity_id', 'bill_id','payment_amount','payment_date'];

    protected $dates = ['payment_date'];

    use ForTenants;

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
