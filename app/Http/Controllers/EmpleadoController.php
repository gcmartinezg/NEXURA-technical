<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Empleado::with('area')->get();
        
        return view('empleado.listar-empleados', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = Area::all();
        $roles = Rol::all();

        return view('empleado.crear-modificar-empleado', [
            'areas' => $areas,
            'roles' => $roles,
            'employee' => null,
        ]);
    }

    /**
     * Validates employee data from the request object
     */
    protected function validate(Request $request)
    {
        return $request->validate([
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'gender'      => 'required|in:M,F',
            'area'        => 'required|exists:areas,id',
            'description' => 'required|string',
            'roles'       => 'required|array|min:1',
            'roles.*'     => 'exists:roles,id',
            'newsletter'  => 'nullable|boolean',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validated = EmpleadoController::validate($request);

        // Create employee
        $employee = Empleado::create([
            'nombre'   => $validated['full_name'],
            'email'       => $validated['email'],
            'sexo'      => $validated['gender'],
            'area_id'     => $validated['area'],
            'descripcion' => $validated['description'],
            'boletin'  => $request->has('newsletter'),
        ]);

        // Attach roles (many-to-many)
        $employee->roles()->attach($validated['roles']);

        return redirect()->route('employees.create')
            ->with('success', 'Empleado creado satisfactoriamente!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Empleado::with('roles')->where('id', $id)->firstOrFail();

        $areas = Area::all();
        $roles = Rol::all();

        return view('empleado.crear-modificar-empleado', [
            'areas' => $areas,
            'roles' => $roles,
            'employee' => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Empleado::findOrFail($id);

        $validated = EmpleadoController::validate($request);

        $employee->update([
            'nombre'   => $validated['full_name'],
            'email'       => $validated['email'],
            'sexo'      => $validated['gender'],
            'area_id'     => $validated['area'],
            'descripcion' => $validated['description'],
            'boletin'  => $request->has('newsletter'),
        ]);

        $employee->roles()->sync($validated['roles']);

        return redirect()->route('employees.index')
            ->with('success', 'Información de empleado actualizada satisfactoriamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Empleado::findOrFail($id);

        $employee->roles()->detach();
        $employee->delete();

        return redirect()->route('employees.index')
            ->with('success', 'Empleado eliminado satisfactioriamente!');
    }
}
