<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    protected $fillable = [
        'name',
        'type_catalogue_id',
        'description',
        'state'
    ];
    public function transports_for_type()
    {
        return $this->hasMany(Transport::class);
    }
    public function transports_for_language()
    {
        return $this->hasMany(Transport::class);
    }
}
