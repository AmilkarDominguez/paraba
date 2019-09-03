<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable =[
        
        'name',
        'description',
        'lat',
        'lng',
        'photo',
        'link',
        'location_type_id',
        'language_id',
        'state'
    ];
    public function location_type()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function language()
    {
        return $this->belongsTo(Catalogue::class);
    }
}
