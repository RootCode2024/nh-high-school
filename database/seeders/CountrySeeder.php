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
            ['id' => 1, 'name' => 'Algérie', 'nationality' => 'Algérien(ne)', 'code' => 'DZ'],
            ['id' => 2, 'name' => 'Angola', 'nationality' => 'Angolais(e)', 'code' => 'AO'],
            ['id' => 3, 'name' => 'Bénin', 'nationality' => 'Béninois(e)', 'code' => 'BJ'],
            ['id' => 4, 'name' => 'Botswana', 'nationality' => 'Botswanais(e)', 'code' => 'BW'],
            ['id' => 5, 'name' => 'Burkina Faso', 'nationality' => 'Burkinabé', 'code' => 'BF'],
            ['id' => 6, 'name' => 'Burundi', 'nationality' => 'Burundais(e)', 'code' => 'BI'],
            ['id' => 7, 'name' => 'Cameroun', 'nationality' => 'Camerounais(e)', 'code' => 'CM'],
            ['id' => 8, 'name' => 'Cap-Vert', 'nationality' => 'Cap-Verdien(ne)', 'code' => 'CV'],
            ['id' => 9, 'name' => 'République Centrafricaine', 'nationality' => 'Centrafricain(e)', 'code' => 'CF'],
            ['id' => 10, 'name' => 'Tchad', 'nationality' => 'Tchadien(ne)', 'code' => 'TD'],
            ['id' => 11, 'name' => 'Comores', 'nationality' => 'Comorien(ne)', 'code' => 'KM'],
            ['id' => 12, 'name' => 'République du Congo', 'nationality' => 'Congolais(e)', 'code' => 'CG'],
            ['id' => 13, 'name' => 'République Démocratique du Congo', 'nationality' => 'Congolais(e)', 'code' => 'CD'],
            ['id' => 14, 'name' => 'Côte d\'Ivoire', 'nationality' => 'Ivoirien(ne)', 'code' => 'CI'],
            ['id' => 15, 'name' => 'Djibouti', 'nationality' => 'Djiboutien(ne)', 'code' => 'DJ'],
            ['id' => 16, 'name' => 'Égypte', 'nationality' => 'Égyptien(ne)', 'code' => 'EG'],
            ['id' => 17, 'name' => 'Guinée Équatoriale', 'nationality' => 'Équato-guinéen(ne)', 'code' => 'GQ'],
            ['id' => 18, 'name' => 'Érythrée', 'nationality' => 'Érythréen(ne)', 'code' => 'ER'],
            ['id' => 19, 'name' => 'Eswatini', 'nationality' => 'Swazi(e)', 'code' => 'SZ'],
            ['id' => 20, 'name' => 'Éthiopie', 'nationality' => 'Éthiopien(ne)', 'code' => 'ET'],
            ['id' => 21, 'name' => 'Gabon', 'nationality' => 'Gabonais(e)', 'code' => 'GA'],
            ['id' => 22, 'name' => 'Gambie', 'nationality' => 'Gambien(ne)', 'code' => 'GM'],
            ['id' => 23, 'name' => 'Ghana', 'nationality' => 'Ghanéen(ne)', 'code' => 'GH'],
            ['id' => 24, 'name' => 'Guinée', 'nationality' => 'Guinéen(ne)', 'code' => 'GN'],
            ['id' => 25, 'name' => 'Guinée-Bissau', 'nationality' => 'Bissau-guinéen(ne)', 'code' => 'GW'],
            ['id' => 26, 'name' => 'Kénya', 'nationality' => 'Kényan(e)', 'code' => 'KE'],
            ['id' => 27, 'name' => 'Lesotho', 'nationality' => 'Lesothan(e)', 'code' => 'LS'],
            ['id' => 28, 'name' => 'Liberia', 'nationality' => 'Libérien(ne)', 'code' => 'LR'],
            ['id' => 29, 'name' => 'Libye', 'nationality' => 'Libyen(ne)', 'code' => 'LY'],
            ['id' => 30, 'name' => 'Madagascar', 'nationality' => 'Malgache', 'code' => 'MG'],
            ['id' => 31, 'name' => 'Malawi', 'nationality' => 'Malawien(ne)', 'code' => 'MW'],
            ['id' => 32, 'name' => 'Mali', 'nationality' => 'Malien(ne)', 'code' => 'ML'],
            ['id' => 33, 'name' => 'Mauritanie', 'nationality' => 'Mauritanien(ne)', 'code' => 'MR'],
            ['id' => 34, 'name' => 'Maurice', 'nationality' => 'Mauricien(ne)', 'code' => 'MU'],
            ['id' => 35, 'name' => 'Maroc', 'nationality' => 'Marocain(e)', 'code' => 'MA'],
            ['id' => 36, 'name' => 'Mozambique', 'nationality' => 'Mozambicain(e)', 'code' => 'MZ'],
            ['id' => 37, 'name' => 'Namibie', 'nationality' => 'Namibien(ne)', 'code' => 'NA'],
            ['id' => 38, 'name' => 'Niger', 'nationality' => 'Nigerien(ne)', 'code' => 'NE'],
            ['id' => 39, 'name' => 'Nigeria', 'nationality' => 'Nigérian(e)', 'code' => 'NG'],
            ['id' => 40, 'name' => 'Rwanda', 'nationality' => 'Rwandais(e)', 'code' => 'RW'],
            ['id' => 41, 'name' => 'Sao Tomé-et-Principe', 'nationality' => 'São-toméen(ne)', 'code' => 'ST'],
            ['id' => 42, 'name' => 'Sénégal', 'nationality' => 'Sénégalais(e)', 'code' => 'SN'],
            ['id' => 43, 'name' => 'Seychelles', 'nationality' => 'Seychellois(e)', 'code' => 'SC'],
            ['id' => 44, 'name' => 'Sierra Leone', 'nationality' => 'Sierra-léonais(e)', 'code' => 'SL'],
            ['id' => 45, 'name' => 'Somalie', 'nationality' => 'Somalien(ne)', 'code' => 'SO'],
            ['id' => 46, 'name' => 'Soudan', 'nationality' => 'Soudanais(e)', 'code' => 'SD'],
            ['id' => 47, 'name' => 'Soudan du Sud', 'nationality' => 'Sud-soudanais(e)', 'code' => 'SS'],
            ['id' => 48, 'name' => 'Tanzanie', 'nationality' => 'Tanzanien(ne)', 'code' => 'TZ'],
            ['id' => 49, 'name' => 'Togo', 'nationality' => 'Togolais(e)', 'code' => 'TG'],
            ['id' => 50, 'name' => 'Tunisie', 'nationality' => 'Tunisien(ne)', 'code' => 'TN'],
            ['id' => 51, 'name' => 'Ouganda', 'nationality' => 'Ougandais(e)', 'code' => 'UG'],
            ['id' => 52, 'name' => 'Zambie', 'nationality' => 'Zambien(ne)', 'code' => 'ZM'],
            ['id' => 53, 'name' => 'Zimbabwe', 'nationality' => 'Zimbabwéen(ne)', 'code' => 'ZW']
        ];

        // Insertion dans la base de données
        DB::table('countries')->insert($countries);
    }
}
