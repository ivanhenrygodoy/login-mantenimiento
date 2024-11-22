<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Vehículos') }}
        </h2>
    </x-slot>

    @section('content')
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto border-b border-gray-200 bg-white p-6">
                    <a href="{{ route('vehiculo.create') }}"
                       class="mb-4 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                        Nuevo Vehículo
                    </a>
                    
                    <!-- Formulario de Búsqueda -->
                    <form method="GET" action="{{ route('vehiculo.index') }}" class="mb-4 flex items-center space-x-4">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Buscar por marca, modelo, placa, etc."
                            class="form-input w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        >
                        <button 
                            type="submit"
                            class="rounded-md bg-blue-500 px-4 py-2 text-white hover:bg-blue-700 focus:outline-none">
                            Buscar
                        </button>
                        <a 
                            href="{{ route('vehiculo.index') }}"
                            class="rounded-md bg-gray-500 px-4 py-2 text-white hover:bg-gray-700 focus:outline-none">
                            Limpiar
                        </a>
                    </form>

                    <div class="min-w-full align-middle">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Marca</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Modelo</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Año</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Placa</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Color</span>
                                    </th>
                                    <th class="px-6 py-3 text-left">
                                        <span class="text-xs font-medium uppercase leading-4 tracking-wider text-gray-500">Acciones</span>
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                                @forelse ($vehiculos as $vehiculo)
                                    <tr>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $vehiculo->marca }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $vehiculo->modelo }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $vehiculo->año }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $vehiculo->placa }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            {{ $vehiculo->color }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                                            <a href="{{ route('vehiculo.edit', $vehiculo) }} "
                                               class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25">
                                                Editar
                                            </a>
                                            <button onclick="confirmDeletion({{ $vehiculo->id }})"
                                                    class="inline-flex items-center rounded-md border border-gray-300 bg-red-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-sm transition duration-150 ease-in-out hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                Eliminar
                                            </button>
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-sm leading-5 text-gray-500 text-center">
                                            No se encontraron vehículos.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                        <!-- Enlaces de paginación -->
                        <div class="py-4">
                            {{ $vehiculos->appends(request()->query())->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 z-50 overflow-auto bg-gray-600 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg p-8">
            <h2 class="mb-4 text-xl font-bold">Confirmar eliminación</h2>
            <p>¿Estás seguro de que deseas eliminar este vehículo?</p>
            <div class="mt-6 flex justify-end space-x-4">
                <button onclick="cancelDeletion()" class="rounded-md bg-gray-500 px-4 py-2 text-white hover:bg-gray-700">Cancelar</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700">Eliminar</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let deleteModal = document.getElementById('deleteModal');
        let deleteForm = document.getElementById('deleteForm');

        function confirmDeletion(id) {
            deleteForm.action = `/vehiculo/${id}`;
            deleteModal.classList.remove('hidden');
        }

        function cancelDeletion() {
            deleteModal.classList.add('hidden');
        }
    </script>
    @endsection
</x-app-layout>
