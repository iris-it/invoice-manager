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
        'vault_id',
        'document_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function vault()
    {
        return $this->belongsTo('App\Vault', 'vault_id');
    }

    public function validation_document()
    {
        return $this->hasOne('App\Document', 'document_id');
    }

}
