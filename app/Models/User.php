<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Proyectos donde el usuario es miembro
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user', 'user_id', 'project_id');
    }

    // Relación de uno a muchos: un usuario puede tener muchos comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relación de uno a muchos: un usuario puede ser propietario de muchos proyectos
    public function ownedProjects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }

    // Relación de uno a muchos: un usuario puede tener muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
