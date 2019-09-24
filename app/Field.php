<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        "name",
        "type",
        "course_id"
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
