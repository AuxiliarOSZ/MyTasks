<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tareas') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Botón crear tarea --}}
                <div class="flex justify-end mb-4">
                    <a href="{{ route('tasks.create') }}"
                       class="inline-block px-4 py-2 text-violet-400 text-sm font-semibold rounded hover:bg-violet-100">
                        + Crear Tarea
                    </a>
                </div>

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- Tabla de tareas --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full w-full divide-y divide-gray-200 text-sm text-gray-800">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium uppercase">Tarea</th>
                                <th class="px-6 py-3 text-left font-medium uppercase">Estado</th>
                                <th class="px-6 py-3 text-left font-medium uppercase">Proyecto</th>
                                <th class="px-6 py-3 text-left font-medium uppercase">Fecha Límite</th>
                                <th class="px-6 py-3 text-left font-medium uppercase">Prioridad</th>
                                <th class="px-6 py-3 text-center font-medium uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($tasks as $task)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center">{{ $task->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $task->status->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ $task->project->name ?? '-' }}</td>
                                    <td class="px-6 py-4 text-center">{{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-block px-2 py-1 text-white text-xs rounded"
                                            style="background-color: {{ $task->priority->color ?? '#999' }}">
                                            {{ $task->priority->name ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('tasks.show', $task) }}"
                                           class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-50">
                                            Ver
                                        </a>
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline"
                                              onsubmit="return confirm('¿Estás segura de eliminar esta tarea?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 text-red-600 border border-red-600 rounded hover:bg-red-50">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">No hay tareas registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
