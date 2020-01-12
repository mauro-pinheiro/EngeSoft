<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'volume', 'number', 'month', 'year', 'theme_id', 'user_id', 'publicada'
    ];

    // public function setThemeIdAttribute($theme)
    // {
    //     if ($theme != null) {
    //         $this->attributes['theme_id'] = Theme::firstOrCreate([
    //             'name' => $theme
    //         ])->id;
    //     }
    // }

    // public function setUserIdAttribute($user_id)
    // {
    //     if ($user_id != null) {
    //         $user = User::where('email', $user_id)->first();
    //         if ($user != null)
    //             $this->attributes['user_id'] = $user->id;
    //     }
    // }

    public function leadEditor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
