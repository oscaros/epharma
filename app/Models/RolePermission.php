<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'permission_id',
    ];

    // a role has many permissions
    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    // a role has many permissions
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
