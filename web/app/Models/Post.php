<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    use HasFactory;

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function translations()
    {
        return $this->morphMany('App\Models\Translation', 'translatable');
    }
}
