@extends('layouts.app')

@php
    $isEdit = isset($employee);
@endphp

@section('title', $isEdit ? 'Editar empleado' : 'Crear empleado')

@section('content')
    <h1 class="text-2xl font-bold mb-6">{{ $isEdit ? 'Editar empleado' : 'Crear empleado' }}</h1>

    @if ($errors->any())
        <div class="text-red-500 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-100 text-green-800 rounded shadow text-sm">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ $isEdit ? route('employees.update', $employee->id): route('employees.store') }}"
        class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div>
            <label for="full_name" class="block font-semibold">Nombre completo:</label>
            <input type="text" id="full_name" name="full_name" required
                value="{{ old('full_name', $employee->nombre ?? '') }}" 
                class="p-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
            >
        </div>

        <div>
            <label for="email" class="block font-semibold">Correo electrónico:</label>
            <input type="email" id="email" name="email" required
                value="{{ old('email', $employee->email ?? '') }}" 
                class="p-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
            >
        </div>

        <div>
            <label class="block font-semibold">Sexo:</label>
            <div class="flex flex-row">
                <label class="basis-1/2"><input type="radio" name="gender" value="M"
                    {{ old('gender', $employee->sexo ?? '') == 'M' ? 'checked' : '' }}>
                    Masculino
                </label>
                <label class="basis-1/2"><input type="radio" name="gender" value="F"
                    {{ old('gender', $employee->sexo ?? '') == 'F' ? 'checked' : '' }}> 
                    Femenino
                </label>
            </div>
        </div>

        <div>
            <label for="area" class="block font-semibold">Área:</label>
            <select id="area" name="area" required 
                class="p-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300">
                <option value=""> Seleccionar área...</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" 
                        {{ old('area', $employee->area_id ?? '') == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="description" class="block font-semibold">Descripción:</label><br>
            <textarea id="description" name="description" rows="4" required
                class="p-1 w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300"
                >{{ old('description', $employee->descripcion ?? '') }}</textarea>
        </div>

        <div>
            <label>
                <input type="checkbox" name="newsletter" value="1" 
                    {{ old('newsletter', $employee->boletin ?? '') ? 'checked' : '' }}>
                Deseo recibir boletín informativo
            </label>
        </div>

        <div>
            <label class="block font-semibold">Roles:</label>
            @foreach ($roles as $role)
                <label>
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                        {{ in_array($role->id, old('roles', $employee?->roles->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                    {{ $role->nombre }}
                </label><br>
            @endforeach
        </div>

        <div class="flex justify-stretch">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 mx-2 rounded hover:bg-blue-700 basis-1/2">
                {{$isEdit ? 'Actualizar' : 'Guardar'}}
            </button>
            <a href="{{ route('employees.index') }}" class="bg-gray-500 text-white text-center px-4 py-2 mx-2 rounded basis-1/2">Regresar</a>
        </div>

    </form>
@endsection