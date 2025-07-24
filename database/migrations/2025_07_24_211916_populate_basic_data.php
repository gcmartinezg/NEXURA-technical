<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('areas')->insert([
            ['nombre' => 'Ventas', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Calidad', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Producción', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('roles')->insert([
            ['nombre' => 'Profesional de proyectos - Desarrollador', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Gerente estratégico', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Auxiliar administrativo', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('areas')->truncate();
        DB::table('roles')->truncate();
    }
};
