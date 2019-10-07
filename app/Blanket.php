<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blanket extends Model
{
    protected $fillable = [
        'template_id',
        'date',
        'examination_period',
    ];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
