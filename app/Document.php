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
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function vault()
    {
        return $this->belongsTo('App\Vault');
    }

}
