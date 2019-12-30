<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['nome'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
