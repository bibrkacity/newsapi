<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'title',
        'description',
        'content',
        'translatable_id'

    ];

    public function translatable()
    {
        return $this->morphTo();
    }
}
