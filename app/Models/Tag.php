<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
    ];

    // Relación de muchos a muchos: una etiqueta puede pertenecer a muchas tareas
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_tag');
    }
}
