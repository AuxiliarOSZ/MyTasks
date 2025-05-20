<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'task_id'
    ];

    // Relación uno a muchos: pueden haber muchos archivos adjuntos para una tarea
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
