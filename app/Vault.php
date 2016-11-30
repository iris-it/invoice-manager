<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vault extends Model
{

    protected $table = 'vaults';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];


    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'vault_pivot', 'vault_id', 'user_id')->withPivot('is_valid')->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }

}
