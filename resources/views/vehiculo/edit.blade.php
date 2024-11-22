@extends('layouts.app')

@section('content')
    <div class="container text-white flex flex-col items-center gap-4">
        <h1 class="text-lg font-bold mb-4">Editar Vehículo</h1>
        
        <!-- Mostrar errores de validación -->
        @if ($errors->any())
            <div class="bg-red-500 text-white rounded p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario para editar vehículo -->
        <form action="{{ route('vehiculo.update', $vehiculo->id) }}" method="POST" class="w-full max-w-lg space-y-4">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="marca" class="block text-sm font-medium">Marca</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="marca" id="marca" 
                    value="{{ old('marca', $vehiculo->marca) }}" required>
            </div>

            <div class="form-group">
                <label for="modelo" class="block text-sm font-medium">Modelo</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="modelo" id="modelo" 
                    value="{{ old('modelo', $vehiculo->modelo) }}" required>
            </div>

            <div class="form-group">
                <label for="año" class="block text-sm font-medium">Año</label>
                <input class="text-black form-input mt-1 block w-full" type="number" name="año" id="año" 
                    value="{{ old('año', $vehiculo->año) }}" required min="1900" max="{{ date('Y') }}">
            </div>

            <div class="form-group">
                <label for="placa" class="block text-sm font-medium">Placa</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="placa" id="placa" 
                    value="{{ old('placa', $vehiculo->placa) }}" required>
            </div>

            <div class="form-group">
                <label for="color" class="block text-sm font-medium">Color</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="color" id="color" 
                    value="{{ old('color', $vehiculo->color) }}" required>
            </div>

            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Actualizar Vehículo
            </button>
            <a href="{{ route('vehiculo.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
        </form>
    </div>
@endsection
