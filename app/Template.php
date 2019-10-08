<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        "course_id",
        "name"
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function elements()
    {
        return $this->hasMany(Element::class);
    }

    public function blankets()
    {
        return $this->hasMany(Blanket::class);
    }
}
