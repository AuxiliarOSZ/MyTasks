<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Etiquetas') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Encabezado con botón --}}
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold"></h2>
                    <a href="{{ route('tags.create') }}"
                       class="inline-block px-4 py-2 bg-violet-600 text-black text-sm font-semibold rounded hover:bg-violet-700 transition">
                        + Crear etiqueta
                    </a>
                </div>

                {{-- Mensaje de éxito --}}
                @if (session()->has('message'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- Tabla --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full w-full divide-y divide-gray-200 text-sm text-gray-800">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left font-medium uppercase">Nombre</th>
                                <th class="px-6 py-3 text-center font-medium uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($tags as $tag)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 text-left">{{ $tag->name }}</td>
                                    <td class="px-6 py-4 text-center space-x-2">
                                        <a href="{{ route('tags.edit', $tag->id) }}"
                                           class="px-3 py-1 text-yellow-600 border border-yellow-600 rounded hover:bg-yellow-50">
                                            Editar
                                        </a>
                                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('¿Estás segura de eliminar esta etiqueta?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 text-red-600 border border-red-600 rounded hover:bg-red-50"
                                                    title="Eliminar etiqueta">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
