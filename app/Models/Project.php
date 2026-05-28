<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'unique_id',
        'title',
        'description',
        'user_id',
    ];

public function users()
{
    return $this->belongsToMany(User::class)->withPivot('role')->withTimestamps();
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function tasks()
{
    return $this->hasMany(Task::class);
}
    
}
