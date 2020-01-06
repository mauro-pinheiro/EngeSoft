<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title', 'file'
    ];

    public function authors()
    {
        return $this->belongsToMany(User::class);
    }

    public function editions()
    {
        return $this->belongsToMany(Edition::class, 'submissions')->withPivot('number', 'status');
    }
}
