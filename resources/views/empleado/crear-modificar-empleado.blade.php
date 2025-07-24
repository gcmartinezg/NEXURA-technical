<!DOCTYPE html>
<html>
<head>
    <title>Crear/Modificar empleado</title>
</head>
<body>

    @php
        $isEdit = isset($employee);
    @endphp

    <h1>{{ $isEdit ? 'Editar empleado' : 'Crear empleado' }}</h1>

    <form method="POST" action="{{ $isEdit ? route('employees.update', $employee->id): route('employees.store') }}">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div>
            <label for="full_name">Nombre completo:</label>
            <input type="text" id="full_name" name="full_name" 
                value="{{ old('full_name', $employee->nombre ?? '') }}" required>
        </div>

        <div>
            <label for="email">Correo electrónico:</label>
            <input type="email" id="email" name="email" 
                value="{{ old('email', $employee->email ?? '') }}" required>
        </div>

        <div>
            <label>Sexo:</label>
            <label><input type="radio" name="gender" value="M" 
                {{ old('gender', $employee->sexo ?? '') == 'M' ? 'checked' : '' }}> Masculino</label>
            <label><input type="radio" name="gender" value="F" 
                {{ old('gender', $employee->sexo ?? '') == 'F' ? 'checked' : '' }}> Femenino</label>
        </div>

        <div>
            <label for="area">Área:</label>
            <select id="area" name="area" required>
                <option value="">-- Seleccionar área --</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" 
                        {{ old('area', $employee->area_id ?? '') == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description">Descripción:</label><br>
            <textarea id="description" name="description" rows="4" required>
                {{ old('description', $employee->descripcion ?? '') }}
            </textarea>
        </div>

        <div>
            <label>
                <input type="checkbox" name="newsletter" value="1" 
                    {{ old('newsletter', $employee->boletin ?? '') ? 'checked' : '' }}>
                Deseo recibir boletín informativo
            </label>
        </div>

        <div>
            <label>Roles:</label><br>
            @foreach ($roles as $role)
                <label>
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                        {{ in_array($role->id, old('roles', $employee?->roles->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                    {{ $role->nombre }}
                </label><br>
            @endforeach
        </div>

        <div>
            <button type="submit">{{$isEdit ? 'Actualizar' : 'Guardar'}}</button>
        </div>

    </form>

</body>
</html>