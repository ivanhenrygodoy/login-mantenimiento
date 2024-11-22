@extends('layouts.app')

@section('content')
    <div class="container text-white flex flex-col items-center gap-4">
        <h1 class="text-lg font-bold mb-4">Nuevo Vehículo</h1>
        <form action="{{ route('vehiculo.store') }}" method="POST" class="w-full max-w-lg space-y-4">
            @csrf

            <div class="form-group">
                <label for="marca" class="block text-sm font-medium">Marca</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="marca" id="marca" required>
            </div>

            <div class="form-group">
                <label for="modelo" class="block text-sm font-medium">Modelo</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="modelo" id="modelo" required>
            </div>

            <div class="form-group">
                <label for="año" class="block text-sm font-medium">Año</label>
                <input class="text-black form-input mt-1 block w-full" type="number" name="año" id="año" required>
            </div>

            <div class="form-group">
                <label for="placa" class="block text-sm font-medium">Placa</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="placa" id="placa" required>
            </div>

            <div class="form-group">
                <label for="color" class="block text-sm font-medium">Color</label>
                <input class="text-black form-input mt-1 block w-full" type="text" name="color" id="color" required>
            </div>

            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar
            </button>
            <a href="{{ route('vehiculo.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
        </form>
    </div>
@endsection
