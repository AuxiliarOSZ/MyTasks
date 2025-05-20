<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'name',
        'description',
        'due_date',
        'project_id',
        'priority_id',
        'status_id',
        'completed',
    ];

    
    // Relación de muchos a muchos: una tarea puede tener muchas etiquetas
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }


    // Relación de muchos a uno: muchas tareas pueden tener una prioridad
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    // Relación de muchos a uno: muchas tareas pueden tener un estado
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Relación de uno a muchos: una tarea puede tener muchos adjuntos
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    // Relación de muchos a muchos: muchas tareas pueden pertener a un usuario
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relación de muchos a uno: muchas tareas pueden pertenecer a un proyectoº
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    
}
