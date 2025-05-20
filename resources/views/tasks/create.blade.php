<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Tarea') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-xl mx-auto sm:px-4 lg:px-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Nueva Tarea</h2>

                @if (session('message'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    {{-- Nombre --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                               required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                                  placeholder="Describe brevemente la tarea">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Proyecto --}}
                    <div class="mb-4">
                        <label for="project_id" class="block text-sm font-medium text-gray-700 mb-1">Proyecto</label>
                        <select name="project_id" id="project_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                                required>
                            <option value="">Selecciona un proyecto</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
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
                                        {{ collect(old('tags'))->contains($tag->id) ? 'checked' : '' }}>
                                    <span>{{ $tag->name }}</span>
                                </label>
                            @endforeach
                        </div>

                        @error('tags')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Fecha límite --}}
                    <div class="mb-4">
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha límite</label>
                        <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300">
                        @error('due_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Prioridad --}}
                    <div class="mb-4">
                        <label for="priority_id" class="block text-sm font-medium text-gray-700 mb-1">Prioridad</label>
                        <select name="priority_id" id="priority_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                                required>
                            <option value="">Selecciona una prioridad</option>
                            @foreach ($priorities as $priority)
                                <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                    {{ $priority->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('priority_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>



                    {{-- Botones --}}
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('tasks.index') }}"
                           class="px-4 py-2 bg-violet-600 text-black rounded hover:bg-violet-700">
                            Cancelar
                        </a>
                        <button type="submit"
                                class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
