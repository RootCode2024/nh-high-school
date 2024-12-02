<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    public function run()
    {
        // Définition des classes avec niveaux et séries spécifiques, bâtiments et descriptions
        $classes = [
            ['name' => 'Sixième', 'level' => '6ème', 'description' => 'Classe de 6ème, premier niveau du collège.'],
            ['name' => 'Cinquième', 'level' => '5ème', 'description' => 'Classe de 5ème, niveau intermédiaire au collège.'],
            ['name' => 'Quatrième', 'level' => '4ème', 'description' => 'Classe de 4ème, niveau avancé au collège.'],
            ['name' => 'Troisième', 'level' => '3ème', 'description' => 'Classe de 3ème, dernière année avant le lycée.'],

            // Classes de lycée avec séries B1, B2, C1, C2, D1, D2 pour Seconde, Première et Terminale
            ['name' => 'Seconde', 'level' => '2nd B1', 'description' => 'Classe de Seconde, série B1.'],
            ['name' => 'Seconde', 'level' => '2nd B2', 'description' => 'Classe de Seconde, série B2.'],
            ['name' => 'Seconde', 'level' => '2nd C1', 'description' => 'Classe de Seconde, série C1.'],
            ['name' => 'Seconde', 'level' => '2nd C2', 'description' => 'Classe de Seconde, série C2.'],
            ['name' => 'Seconde', 'level' => '2nd D1', 'description' => 'Classe de Seconde, série D1.'],
            ['name' => 'Seconde', 'level' => '2nd D2', 'description' => 'Classe de Seconde, série D2.'],

            ['name' => 'Première', 'level' => '1ère B1', 'description' => 'Classe de Première, série B1.'],
            ['name' => 'Première', 'level' => '1ère B2', 'description' => 'Classe de Première, série B2.'],
            ['name' => 'Première', 'level' => '1ère C1', 'description' => 'Classe de Première, série C1.'],
            ['name' => 'Première', 'level' => '1ère C2', 'description' => 'Classe de Première, série C2.'],
            ['name' => 'Première', 'level' => '1ère D1', 'description' => 'Classe de Première, série D1.'],
            ['name' => 'Première', 'level' => '1ère D2', 'description' => 'Classe de Première, série D2.'],

            ['name' => 'Terminale', 'level' => 'Tle B1', 'description' => 'Classe de Terminale, série B1.'],
            ['name' => 'Terminale', 'level' => 'Tle B2', 'description' => 'Classe de Terminale, série B2.'],
            ['name' => 'Terminale', 'level' => 'Tle C1', 'description' => 'Classe de Terminale, série C1.'],
            ['name' => 'Terminale', 'level' => 'Tle C2', 'description' => 'Classe de Terminale, série C2.'],
            ['name' => 'Terminale', 'level' => 'Tle D1', 'description' => 'Classe de Terminale, série D1.'],
            ['name' => 'Terminale', 'level' => 'Tle D2', 'description' => 'Classe de Terminale, série D2.'],
        ];

        // Insertion des données dans la table 'classes'
        foreach ($classes as $class) {
            Classe::create([
                'name' => $class['name'],
                'level' => $class['level'],  // Niveau avec série (ex: 'Seconde B1', 'Première C2', etc.)
                'building_id' => Classe::all()->value('building_id'),  // Récupère l'id du bâtiment correspondant à la classe actuelle
                'description' => $class['description']
            ]);
        }
    }
}
