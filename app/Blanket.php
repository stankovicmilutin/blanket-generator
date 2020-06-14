<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blanket extends Model
{
    protected $fillable = [
        'template_id',
        'user_id',
        'date',
        'examination_period',
        'file_path'
    ];

    protected $dates = ["date"];

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
