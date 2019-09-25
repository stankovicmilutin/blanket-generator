<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        "name",
        "module_id",
        "department_id"
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
