<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PermissionRole extends Model
{
    use HasFactory;
    

    protected $table            = 'permission_role';

    protected $fillable = [
        'role_id',
        'permission_id',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $hidden           = [
        'created_at',
        'updated_at',
        'deleted_at',
        'is_active',
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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
} 
