@extends('layouts.app')

@section('title', 'Lista de empleados')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Lista de empleados</h1>

    <!-- Create Button -->
    <a href="{{ route('employees.create') }}"
        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 mb-4 inline-block">
        <button type="button">Crear nuevo empleado</button>
    </a>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded shadow text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Employees Table -->
    <table class="min-w-full bg-white border border-gray-200">
        <thead class="bg-gray-100 text-left">
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Area</th>
                <th class="px-4 py-2">Sexo</th>
                <th class="px-4 py-2">Boletín</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $employee->nombre }}</td>
                    <td class="px-4 py-2">{{ $employee->email }}</td>
                    <td class="px-4 py-2">{{ $employee->area->nombre ?? 'N/A' }}</td>
                    <td class="px-4 py-2">{{ $employee->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                    <td class="px-4 py-2">{{ $employee->boletin ? 'Sí' : 'No' }}</td>
                    <td class="px-4 py-2">
                        <!-- Modify Button -->
                        <a href="{{ route('employees.edit', $employee->id) }}">
                            <button type="button" class="bg-blue-600 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700">Modificar</button>
                        </a>

                        <!-- Remove Button -->
                        <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 mx-2 rounded hover:bg-red-700">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No se han encontrado empleados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection