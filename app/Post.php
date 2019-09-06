<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =[
        
        'title',
        'content',
        'photo',
        'link',
        'link2',
        'tag_id',
        'language_id',
        'state'
    ];
    public function tag()
    {
        return $this->belongsTo(Catalogue::class);
    }
    public function language()
    {
        return $this->belongsTo(Catalogue::class);
    }
}
