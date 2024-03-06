<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Idioma;

class AlumnoSeeder extends Seeder  {


private function get_idiomas(): array
{
    $idiomas = ["Francés", "Inglés", "Alemán", "Ruso", "Rumano", "Portugués",
        "Catalán", "Gallego", "Fabla", "Vasco", "Italiano", "Chino"];
    $idiomas_hablados = [];
    $numero_idiomas = rand(0, 4);
    if ($numero_idiomas == 0)
        return [];
    $posiciones_idiomas = array_rand($idiomas, $numero_idiomas);
    dump ($posiciones_idiomas);
    if (!is_array($posiciones_idiomas))
        $idiomas_hablados[] = $idiomas[$posiciones_idiomas];
    else
        foreach ($posiciones_idiomas as $pos)
            $idiomas_hablados[] = $idiomas[$pos];
    return $idiomas_hablados;
}
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Alumno::factory()->count(50)->create()->each(function ($alumno) {
        $idiomas_hablados = $this->get_idiomas();
        foreach ($idiomas_hablados as $idioma_hablado) {
            $idioma = new Idioma();
            $idioma->idioma = $idioma_hablado;
            $idioma->alumno_id = $alumno->id;
            $idioma->save();
        }
    });


    //
}
}
