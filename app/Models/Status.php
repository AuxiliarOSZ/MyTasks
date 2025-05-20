<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];
    
    // Relacion de uno a muchos: un estado puede tener muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
