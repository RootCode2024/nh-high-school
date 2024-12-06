<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['id' => 1, 'name' => 'Algérie', 'nationality' => 'Algérien(ne)'],
            ['id' => 2, 'name' => 'Angola', 'nationality' => 'Angolais(e)'],
            ['id' => 3, 'name' => 'Bénin', 'nationality' => 'Béninois(e)'],
            ['id' => 4, 'name' => 'Botswana', 'nationality' => 'Botswanais(e)'],
            ['id' => 5, 'name' => 'Burkina Faso', 'nationality' => 'Burkinabé'],
            ['id' => 6, 'name' => 'Burundi', 'nationality' => 'Burundais(e)'],
            ['id' => 7, 'name' => 'Cameroun', 'nationality' => 'Camerounais(e)'],
            ['id' => 8, 'name' => 'Cap-Vert', 'nationality' => 'Cap-Verdien(ne)'],
            ['id' => 9, 'name' => 'République Centrafricaine', 'nationality' => 'Centrafricain(e)'],
            ['id' => 10, 'name' => 'Tchad', 'nationality' => 'Tchadien(ne)'],
            ['id' => 11, 'name' => 'Comores', 'nationality' => 'Comorien(ne)'],
            ['id' => 12, 'name' => 'République du Congo', 'nationality' => 'Congolais(e)'],
            ['id' => 13, 'name' => 'République Démocratique du Congo', 'nationality' => 'Congolais(e)'],
            ['id' => 14, 'name' => 'Côte d\'Ivoire', 'nationality' => 'Ivoirien(ne)'],
            ['id' => 15, 'name' => 'Djibouti', 'nationality' => 'Djiboutien(ne)'],
            ['id' => 16, 'name' => 'Égypte', 'nationality' => 'Égyptien(ne)'],
            ['id' => 17, 'name' => 'Guinée Équatoriale', 'nationality' => 'Équato-guinéen(ne)'],
            ['id' => 18, 'name' => 'Érythrée', 'nationality' => 'Érythréen(ne)'],
            ['id' => 19, 'name' => 'Eswatini', 'nationality' => 'Swazi(e)'],
            ['id' => 20, 'name' => 'Éthiopie', 'nationality' => 'Éthiopien(ne)'],
            ['id' => 21, 'name' => 'Gabon', 'nationality' => 'Gabonais(e)'],
            ['id' => 22, 'name' => 'Gambie', 'nationality' => 'Gambien(ne)'],
            ['id' => 23, 'name' => 'Ghana', 'nationality' => 'Ghanéen(ne)'],
            ['id' => 24, 'name' => 'Guinée', 'nationality' => 'Guinéen(ne)'],
            ['id' => 25, 'name' => 'Guinée-Bissau', 'nationality' => 'Bissau-guinéen(ne)'],
            ['id' => 26, 'name' => 'Kénya', 'nationality' => 'Kényan(e)'],
            ['id' => 27, 'name' => 'Lesotho', 'nationality' => 'Lesothan(e)'],
            ['id' => 28, 'name' => 'Liberia', 'nationality' => 'Libérien(ne)'],
            ['id' => 29, 'name' => 'Libye', 'nationality' => 'Libyen(ne)'],
            ['id' => 30, 'name' => 'Madagascar', 'nationality' => 'Malgache'],
            ['id' => 31, 'name' => 'Malawi', 'nationality' => 'Malawien(ne)'],
            ['id' => 32, 'name' => 'Mali', 'nationality' => 'Malien(ne)'],
            ['id' => 33, 'name' => 'Mauritanie', 'nationality' => 'Mauritanien(ne)'],
            ['id' => 34, 'name' => 'Maurice', 'nationality' => 'Mauricien(ne)'],
            ['id' => 35, 'name' => 'Maroc', 'nationality' => 'Marocain(e)'],
            ['id' => 36, 'name' => 'Mozambique', 'nationality' => 'Mozambicain(e)'],
            ['id' => 37, 'name' => 'Namibie', 'nationality' => 'Namibien(ne)'],
            ['id' => 38, 'name' => 'Niger', 'nationality' => 'Nigerien(ne)'],
            ['id' => 39, 'name' => 'Nigeria', 'nationality' => 'Nigérian(e)'],
            ['id' => 40, 'name' => 'Rwanda', 'nationality' => 'Rwandais(e)'],
            ['id' => 41, 'name' => 'Sao Tomé-et-Principe', 'nationality' => 'São-toméen(ne)'],
            ['id' => 42, 'name' => 'Sénégal', 'nationality' => 'Sénégalais(e)'],
            ['id' => 43, 'name' => 'Seychelles', 'nationality' => 'Seychellois(e)'],
            ['id' => 44, 'name' => 'Sierra Leone', 'nationality' => 'Sierra-léonais(e)'],
            ['id' => 45, 'name' => 'Somalie', 'nationality' => 'Somalien(ne)'],
            ['id' => 46, 'name' => 'Soudan', 'nationality' => 'Soudanais(e)'],
            ['id' => 47, 'name' => 'Soudan du Sud', 'nationality' => 'Sud-soudanais(e)'],
            ['id' => 48, 'name' => 'Tanzanie', 'nationality' => 'Tanzanien(ne)'],
            ['id' => 49, 'name' => 'Togo', 'nationality' => 'Togolais(e)'],
            ['id' => 50, 'name' => 'Tunisie', 'nationality' => 'Tunisien(ne)'],
            ['id' => 51, 'name' => 'Ouganda', 'nationality' => 'Ougandais(e)'],
            ['id' => 52, 'name' => 'Zambie', 'nationality' => 'Zambien(ne)'],
            ['id' => 53, 'name' => 'Zimbabwe', 'nationality' => 'Zimbabwéen(ne)']
        ];

        // Insertion dans la base de données
        DB::table('countries')->insert($countries);
    }
}

