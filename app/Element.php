<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = [
        "template_id",
        "domain_id",
        "domain_type",
        "type",
        "text"
    ];
}
