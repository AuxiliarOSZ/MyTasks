<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar etiqueta') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if (session()->has('message'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('tags.update', $tag->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre de la etiqueta</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $tag->name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-violet-300"
                               placeholder="Nombre de la etiqueta" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('tags.index') }}"
                           class="px-4 py-2 bg-violet-600 text-black rounded hover:bg-violet-700">
                            Cancelar
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
