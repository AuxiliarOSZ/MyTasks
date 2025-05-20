<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles de tarea') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Editar Tarea</h2>

                @if (session('message'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('tasks.update', $task) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" value="{{ old('name', $task->name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                               required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                                  placeholder="Descripción...">{{ old('description', $task->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Proyecto --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Proyecto</label>
                        <select name="project_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300" required>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('project_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Etiquetas --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Etiquetas</label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            @foreach ($tags as $tag)
                                <label class="flex items-center space-x-2 text-sm text-gray-700">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}"
                                        class="rounded text-violet-600 border-gray-300 focus:ring-violet-500"
                                        {{ $task->tags->pluck('id')->contains($tag->id) ? 'checked' : '' }}>
                                    <span>{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>

                        @error('tags')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Fecha Límite --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Fecha Límite</label>
                        <input type="date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300">
                        @error('due_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Prioridad --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Prioridad</label>
                        <select name="priority_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300" required>
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}" {{ $task->priority_id == $priority->id ? 'selected' : '' }}>
                                    {{ $priority->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Estado --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select name="status_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                                required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}" {{ $task->status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Botones --}}
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('tasks.index') }}"
                           class="px-4 py-2 bg-violet-600 text-black rounded hover:bg-violet-700">
                            Volver
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
