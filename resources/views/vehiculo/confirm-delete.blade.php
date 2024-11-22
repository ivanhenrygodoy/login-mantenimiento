<!-- resources/views/vehiculo/confirmar_eliminacion.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Confirmar eliminación de vehículo</h2>
        <p>¿Estás seguro de que deseas eliminar el vehículo <strong>{{ $vehiculo->modelo }}</strong>?</p>
        <p><strong>Marca:</strong> {{ $vehiculo->marca }}</p>
        <p><strong>Año:</strong> {{ $vehiculo->anio }}</p>

        <form action="{{ route('vehiculo.destroy', $vehiculo->id) }}" method="POST">
            @csrf
            @method('DELETE')
            
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="{{ route('vehiculo.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

