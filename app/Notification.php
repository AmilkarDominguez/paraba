<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable =[        
        'name',
        'description',
        'photo',
        'link',
        'link2',
        'state'
    ];
}
