<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'volume', 'number', 'month', 'year', 'theme_id', 'user_id'
    ];

    public function setThemeIdAttribute($theme)
    {
        if ($theme != null) {
            $this->attributes['theme_id'] = Theme::firstOrCreate([
                'name' => $theme
            ])->id;
        }
    }

    // public function setUserIdAttribute($user_email)
    // {
    //     if ($user_email != null) {
    //         $user = User::where('email', $user_email)->first();
    //         if ($user != null)
    //             $this->attributes['user_id'] = $user->id;
    //     }
    // }

    public function leadEditor()
    {
        return $this->belongsTo(User::class);
    }
}
