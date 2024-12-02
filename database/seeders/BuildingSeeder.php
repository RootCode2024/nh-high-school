<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    public function run()
    {
        // Liste des noms de bâtiments à insérer dans la table 'buildings'
        $buildings = [
            'Bâtiment A',
            'Bâtiment B',
            'Bâtiment C',
            'Bâtiment D',
            'Bâtiment E',
            'Bâtiment F',
            'Bâtiment G',
            'Bâtiment H',
            'Bâtiment I',
            'Bâtiment J',
            'Bâtiment K',
            'Bâtiment L',
            'Bâtiment M',
            'Bâtiment N',
            'Bâtiment O',
            'Bâtiment P',
            'Bâtiment Q',
            'Bâtiment R',
            'Bâtiment S',
            'Bâtiment T',
            'Bâtiment U',
            'Bâtiment V',
            'Bâtiment W',
            'Bâtiment X',
            'Bâtiment Y',
            'Bâtiment Z',
        ];

        // Insertion des bâtiments dans la table 'buildings'
        foreach ($buildings as $building) {
            DB::table('buildings')->insert([
                'name' => $building,
            ]);
        }
    }
}
