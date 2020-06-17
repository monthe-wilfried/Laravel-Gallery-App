<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getNameAttribute($value){
        return Str::title($value);
    }

}
