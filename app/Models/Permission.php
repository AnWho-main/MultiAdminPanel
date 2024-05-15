<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table            = 'permissions';

    protected $fillable = [
        'name',
        'name_slug',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $hidden           = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_live',
        'status'
    ];

    protected $dates            = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $casts            = [
        'created_at'            => "datetime:d-M-Y h:i A",        
        'updated_at'            => "datetime:d-M-Y h:i A",
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    // public function permissionRoles($roleId)
    public function permissionRoles()
    {
        return $this->hasMany(PermissionRole::class, 'permission_id', 'id')
            // ->where(function ($query) use ($roleId) {
            //     $query->where('role_id', $roleId);
            // });
            ;
    }
}
