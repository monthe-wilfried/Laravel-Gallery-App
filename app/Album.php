<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    //
    protected $fillable = [
        'name',
        'cover_image'
    ];

public function photos(){
    return $this->hasMany(Photo::class);
}

}
