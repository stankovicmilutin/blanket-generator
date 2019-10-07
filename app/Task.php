<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        "domain_id",
        "type",
        "body"
    ];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }


    public function blankets()
    {
        return $this->belongsToMany(Blanket::class);
    }
}
