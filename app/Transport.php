<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable =[        
        'name',
        'description',
        'photo',
        'link',
        'link2',
        'transport_type_id',
        'language_id',
        'state'
    ];
    public function transport_type()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function language()
    {
        return $this->belongsTo(Catalogue::class);
    }
}
