<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'path', 'album_id'
    ];

    public function album(){
        return $this->belongsTo(Album::class);
    }

}
