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
        return $this->belongsToMany('App\User', 'vault_pivot', 'vault_id', 'user_id')->withTimestamps();
    }

    public function documents()
    {
        return $this->hasMany('App\Document');
    }

    public function number_validated_documents()
    {
        return $this->documents()->get()->reduce(function ($carry, $item) {
            if ($item->validation_document) {
                return $carry + 1;
            }
            return $carry;
        }, 0);
    }

    public function fully_validated_documents()
    {
        return ($this->documents()->count() === $this->number_validated_documents());
    }

}
