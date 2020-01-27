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

    public function submission()
    {
        return $this->hasMany(Submission::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
        // ->withPivot('originality', 'content', 'presentation')
        // ->withTimestamps();
    }
}
