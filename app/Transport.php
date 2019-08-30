<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable =[
        
        'name','description', 'photo','link','transport_type_id','language_id'
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
