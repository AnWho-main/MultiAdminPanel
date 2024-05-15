<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Admin extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role_id', // Add role_id to the fillable attributes
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates            = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    
    protected $casts            = [
        'created_at'            => "datetime:d-M-Y h:i A",        
        'updated_at'            => "datetime:d-M-Y h:i A",
        'email_verified_at' => 'datetime',
        'password'=>'hashed',
    ];



    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Update the hasPermission method to check if the user has the required permission
    public function hasPermission($permissionName)
    {
        return $this->role->permissions->contains('name', $permissionName);
    }
    
}
