<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Database\Seeders\FamiliasProfesionalesTableSeeder;
use Database\Seeders\CiclosFormativosTableSeeder;
use Database\Seeders\ResultadosAprendizajeTableSeeder;
use Database\Seeders\CriteriosEvaluacionTableSeeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\EvidenciasTableSeeder;
use Database\Seeders\TareaTableSeeder;
use Database\Seeders\EvaluacionesTableSeeder;
use Database\Seeders\ModuloFormativoTableSeeder;
use Database\Seeders\MatriculaTableSeeder;
use Database\Seeders\CriteriosTareasTableSeeder;
use Database\Seeders\ComentariosTableSeeder;
use Database\Seeders\AsignacionesTableSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        Model::unguard();
        Schema::disableForeignKeyConstraints();

        User::truncate();
        User::factory()->create([
            'name' => 'Test User',
            'email' => config('app.admin.email', 'test@example.com'),
            'password' => config('app.admin.password', 'password'),
        ]);

        $this->call(FamiliasProfesionalesTableSeeder::class);
        $this->call(CiclosFormativosTableSeeder::class);
        $this->call(ResultadosAprendizajeTableSeeder::class);
        $this->call(CriteriosEvaluacionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(EvidenciasTableSeeder::class);
        $this->call(TareaTableSeeder::class);
        $this->call(EvaluacionesTableSeeder::class);
        $this->call(ModuloFormativoTableSeeder::class);
        $this->call(MatriculaTableSeeder::class);
        $this->call(ComentariosTableSeeder::class);
        $this->call(AsignacionesTableSeeder::class);
        $this->call(CriterioTareasTableSeeder::class);

        Model::reguard();

        Schema::enableForeignKeyConstraints();
    }
}
