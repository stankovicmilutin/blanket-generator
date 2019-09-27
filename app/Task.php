<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "domain_id",
        "task_type",
        "body",
        "points"
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
