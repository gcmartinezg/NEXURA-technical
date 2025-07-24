<!DOCTYPE html>
<html>
<head>
    <title>Employees</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table, th, td { border: 1px solid black; border-collapse: collapse; padding: 6px; }
    </style>
</head>
<body>

    <h1>Employee List</h1>

    <!-- Create Button -->
    <a href="{{ route('employees.create') }}">
        <button type="button">Crear nuevo empleado</button>
    </a>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <!-- Employees Table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Area</th>
                <th>Sexo</th>
                <th>Boletín</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
                <tr>
                    <td>{{ $employee->nombre }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->area->nombre ?? 'N/A' }}</td>
                    <td>{{ $employee->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                    <td>{{ $employee->boletin ? 'Sí' : 'No' }}</td>
                    <td>
                        <!-- Modify Button -->
                        <a href="{{ route('employees.edit', $employee->id) }}">
                            <button type="button">Modificar</button>
                        </a>

                        <!-- Remove Button -->
                        <form method="POST" action="{{ route('employees.destroy', $employee->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this employee?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red;">Eliminar</button>
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

</body>
</html>