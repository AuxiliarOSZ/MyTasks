<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'owner_id',
    ];

    // Relación de muchos a muchos: miembros del proyecto
    public function members()
    {
        return $this->belongsToMany(User::class, 'project_user', 'project_id', 'user_id');
    }

    // Relación de uno a muchos: un proyecto puede tener muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relación de uno a uno: un proyecto puede tener un usuario propietario
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
