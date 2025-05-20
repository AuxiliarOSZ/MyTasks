<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear etiqueta') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Nueva etiqueta</h2>

                @if (session('message'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('message') }}
                    </div>
                @endif

                <form action="{{ route('tags.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <input type="text" name="name" id="name"
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
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
