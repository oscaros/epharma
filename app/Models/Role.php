<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'permissions',

        'user_id',
        'entity_id',
    ];

    // a role belongs to a user
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

     // a role has many permissions
     public function permissions()
     {
         return $this->belongsToMany(Permission::class, 'role_permissions');
     }
}
