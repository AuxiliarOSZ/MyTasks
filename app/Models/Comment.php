<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'task_id',
        'user_id'
    ];

    // Relación de muchos a uno: muchos comentarios pueden pertenecer a una tarea
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // Relación de muchos a uno: muchos comentarios pueden pertenecer a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
