<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'ClientID',
        'FirstName',
        'LastName',
        'Email',
        'Phone',
        'Address',
        'NIN',
        'PInsured',
        'PType',
        'entity_id',
        'NewVisit',
        'NewVisitNumber',

        

    ];


    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
}
