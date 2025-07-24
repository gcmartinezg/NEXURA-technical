<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['nombre'];

    public function empleados()
    {
        return $this->belongsToMany(Empleado::class, 'empleado_roles');
    }
}