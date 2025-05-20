<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Muestra una lista de proyectos.
     */
    public function index()
    {
        // Obtener proyectos donde el usuario es propietario
        $projects = Project::where('owner_id', Auth::id())->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Guarda un nuevo proyecto en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar el nombre del proyecto
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Crear el proyecto con el usuario autenticado como propietario
        Project::create([
            'name' => $validated['name'],
            'owner_id' => Auth::id(),
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Muestra los detalles de un proyecto específico.
     */
    public function show($id)
    {
        // Buscar el proyecto y verificar que pertenezca al usuario
        $project = Project::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        return view('projects.show', compact('project'));
    }

    /**
     * Muestra el formulario para editar un proyecto existente.
     */
    public function edit($id)
    {
        // Buscar el proyecto y verificar que pertenezca al usuario
        $project = Project::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        return view('projects.edit', compact('project'));
    }

    /**
     * Actualiza un proyecto existente en la base de datos.
     */
    public function update(Request $request, $id)
    {
        // Validar el nombre del proyecto
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Buscar el proyecto y verificar que pertenezca al usuario
        $project = Project::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        // Actualizar el nombre del proyecto
        $project->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Elimina un proyecto de la base de datos.
     */
    public function destroy($id)
    {
        // Buscar el proyecto y verificar que pertenezca al usuario
        $project = Project::where('id', $id)
            ->where('owner_id', Auth::id())
            ->firstOrFail();

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}
