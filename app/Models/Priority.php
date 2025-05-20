<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = [
        'name',
        'color',
    ];

    // Relacion de uno a muchos: una prioridad puede tener muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
