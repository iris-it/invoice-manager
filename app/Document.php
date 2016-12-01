<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{

    protected $table = 'documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'path',
        'uuid',
        'user_id',
        'vault_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function vault()
    {
        return $this->belongsTo('App\Vault', 'vault_id');
    }

    public function validated_by_users()
    {
        return $this->belongsToMany('App\User', 'document_pivot', 'document_id', 'user_id')->withPivot('is_valid')->withTimestamps();
    }

}
