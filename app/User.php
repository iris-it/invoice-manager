<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;
use ReflectionFunction;

class User extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * this assign roles to an user (obvious isn'it ?)
     *
     * @param $role
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function assignRole($role)
    {
        $role = Role::where('name', $role)->firstOrFail();

        return $this->role()->associate($role)->save();
    }

    /**
     * check if user has role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->role->name == $role;
        }

        return false;
    }

    /**
     * check if user has role
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        if (is_string($permission)) {
            foreach ($this->role->permissions as $permissionRole) {
                if ($permissionRole->name == $permission) {
                    return true;
                }
            }
        }

        return false;
    }


    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function vaults()
    {
        return $this->hasMany('App\Vault');
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    public function public_vaults()
    {
        return $this->belongsToMany('App\Vault', 'vault_pivot', 'user_id', 'vault_id')->withPivot('is_valid')->withTimestamps();
    }


}
