<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeCatalogue extends Model
{
    protected $fillable =[
        'name',
        'description',
        'state',
    ];

    public function catalogues()
    {
        return $this->hasMany(Catalogue::class);
    }
}
