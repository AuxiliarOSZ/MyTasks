<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Priority;
use App\Models\Status;
use App\Models\Tag;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Muestra una lista de tareas.
     */
    public function index()
    {
        $tasks = Task::with(['status', 'priority', 'project'])
            ->orderBy('completed')
            ->orderBy('due_date', 'asc')
            ->orderByDesc('priority_id')
            ->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create()
    {
        return view('tasks.create', [
            'projects' => Project::all(),
            'priorities' => Priority::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Guarda una nueva tarea en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
            'priority_id' => 'required|exists:priorities,id',
        ]);

        // Asignar estado por defecto como "Pendiente"
        $validated['status_id'] = Status::where('name', 'Pendiente')->value('id');
        $validated['completed'] = false;

        $task = Task::create($validated);

        if ($request->filled('tags')) {
            $task->tags()->sync($request->input('tags'));
        }

        return redirect()->route('tasks.index')->with('message', 'Tarea creada exitosamente.');
    }


    /**
     * Muestra los detalles de una tarea específica.
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task->load('project', 'priority', 'status', 'tags'),
            'projects' => Project::all(),
            'priorities' => Priority::all(),
            'statuses' => Status::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task->load('tags'),
            'projects' => Project::all(),
            'priorities' => Priority::all(),
            'statuses' => Status::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Actualiza una tarea existente en la base de datos.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'project_id' => 'required|exists:projects,id',
            'priority_id' => 'required|exists:priorities,id',
            'status_id' => 'required|exists:statuses,id',
        ]);

        $validated['completed'] = $validated['status_id'] == 4;

        $task->update($validated);

        // Sync etiquetas (o limpia si no vienen)
        if ($request->filled('tags')) {
            $task->tags()->sync($request->input('tags'));
        } else {
            $task->tags()->sync([]);
        }

        return redirect()->route('tasks.index')->with('message', 'Tarea actualizada exitosamente.');
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
