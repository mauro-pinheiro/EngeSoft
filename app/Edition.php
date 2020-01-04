<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edition extends Model
{
    protected $fillable = [
        'volume', 'number', 'month', 'year', 'theme_id'
    ];

    public function setThemeIdAttribute($theme)
    {
        if ($theme != null) {
            $this->attributes['theme_id'] = Theme::firstOrCreate([
                'name' => $theme
            ])->id;
        }
    }

    public function leadEditor()
    {
        return $this->belongsTo(User::class);
    }
}
