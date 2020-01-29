<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'institution_id',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /** Relationships */

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function themes()
    {
        return $this->belongsToMany(Theme::class)->withTimestamps();
    }

    public function edition()
    {
        return $this->hasOne(Edition::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function conctactFor()
    {
        return $this->hasMany(Submission::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
        // ->withPivot(['originality', 'content', 'presentation'])
        // ->withTimestamps();
    }
}
