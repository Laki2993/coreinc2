<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable =([
        'message',
        'project_id',
        'user_id',
    ]);

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
