<?php

namespace App\Http\Controllers;

use App\Models\MntVehiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class MntVehiculoController extends Controller
{
    // Mostrar todos los vehículos
    public function index(Request $request)
    {
        $search = $request->get('search');

        $vehiculos = MntVehiculo::query()
        ->when($search, function ($query, $search) {
            $query->where('marca', 'like', "%{$search}%")
                  ->orWhere('modelo', 'like', "%{$search}%")
                  ->orWhere('placa', 'like', "%{$search}%")
                  ->orWhere('color', 'like', "%{$search}%")
                  ->orWhere('año', 'like', "%{$search}%");

        })
        ->paginate(5);

        return view('vehiculo.index', compact('vehiculos'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('vehiculo.create');
    }

    // Almacenar un nuevo vehículo
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|digits:4|gt:1900',
            'placa' => 'required|unique:mnt_vehiculo,placa|string|max:10',
            'color' => 'required|string|max:255',
        ]);

        try {
           $vehiculo = MntVehiculo::create($request->all());

           if($vehiculo instanceof Model){
            toastr()->success('Vehiculo creado exitosamente', 'Creación');
            return redirect()->route('vehiculo.index');
           }
        } catch (\Exception $e) {
            toastr()->error('Hubo un error al crear el vehículo.');
        }
    }

    // Mostrar el formulario de edición
    public function edit(MntVehiculo $vehiculo)
    {
        return view('vehiculo.edit', compact('vehiculo'));
    }

    // Actualizar un vehículo
    public function update(Request $request, MntVehiculo $vehiculo)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|digits:4|gt:1900',
            'placa' => 'required|unique:mnt_vehiculo,placa,' . $vehiculo->id,
            'color' => 'required|string|max:255',
        ]);

        try {

           $isCreated =  $vehiculo->update($request->all());

           if($isCreated){
            toastr()->success('Vehiculo actualizado exitosamente', 'Actualizacion');
            return redirect()->route('vehiculo.index');
           }

        } catch (\Exception $e) {
            toastr()->error('Hubo un error al actualizar el vehículo.');
        }

        return redirect()->route('vehiculo.index');
    }

    // Eliminar un vehículo
    public function destroy(MntVehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculo.index');
    }

}
