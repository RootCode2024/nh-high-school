<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\AcademicYear;
use App\Models\Classe;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Database\Factories\StudentFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AcademicYear::create([
            'name' => '2024-2025',
            'start_date' => '2024-09-01',
            'end_date' => '2025-06-10',
            'status' => 1,
        ]);

        \App\Models\SchoolInfo::create([
            'name' => 'Ecole Bilingue Les Cerisiers',
            'address' => 'Avenue de la Paix, 1202 Gen ve, Dakar, Sénégal',
            'phone' => '+221 33 731 00 40',
            'email' => 'info@ecolecerisiers.ch',
            'logo' => 'cerisiers-logo.png',
            'favicon' => 'favicon.png',
            'director_name' => 'Mme. Khadidiatou BA',
            'devise' => 'La qualité  au service des Enfant',
            'small_description' => 'Nous sommes une école bilingue qui propose un enseignement de qualité dans un environnement sain et sûr  pour les enfants. Nous sommes situées à Dakar au Sénégal.',
            'long_description' => 'Nous sommes convaincus que chaque enfant est unique et a des besoins spécifiques. Nous offrons un enseignement personnalisé qui permet aux enfants d\'apprendre  leur propre rythme. Nous sommes fier de notre communauté scolaire ouverte et accueillante. Nous croyons que l\'apprentissage est une aventure qui devrait être amusante et enrichissante pour les enfants.',
            'internal_regulations' => 'pdf/reglement_internes.pdf',
            'facebook' => 'https://www.facebook.com/ecolecerisiers',
            'twitter' => 'https://twitter.com/ecolecerisiers',
            'instagram' => 'https://www.instagram.com/ecolecerisiers/',
        ]);

        \App\Models\Bus::factory()->count(10)->create();
        
        \App\Models\Subject::create([
            'name' => 'Mathematiques',
            'code' => 'MATH101',
            'category' => 'science',
            'description' => 'Mathematics is the study of numbers, shapes, and patterns.',
        ]);

        \App\Models\Subject::create([
            'name' => 'Français',
            'code' => 'FRA101',
            'category' => 'literature',
            'description' => 'Le français est la literature et la littérature des pays francophones.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Anglais',
            'code' => 'ENG102',
            'category' => 'literature',
            'description' => 'L\'anglais est une literature vivante enseignée pour la communication internationale.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Espagnol',
            'code' => 'SPA103',
            'category' => 'literature',
            'description' => 'L\'espagnol est une langue vivante utilisée dans de nombreux pays hispanophones.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Économie',
            'code' => 'ECO104',
            'category' => 'science',
            'description' => 'L\'économie étudie les systèmes de production, de distribution et de consommation.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Mathématiques',
            'code' => 'MATH105',
            'category' => 'science',
            'description' => 'Les mathématiques étudient les nombres, les structures et les relations.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Histoire-Géographie',
            'code' => 'HISTGEO106',
            'category' => 'literature',
            'description' => 'L\'histoire-géographie explore les événements passés et l\'organisation de l\'espace.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Sociologie',
            'code' => 'SOC107',
            'category' => 'science',
            'description' => 'La sociologie analyse les comportements humains dans la société.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Physique-Chimie',
            'code' => 'PHYCHM108',
            'category' => 'science',
            'description' => 'La physique-chimie explore les lois de la nature et les propriétés de la matière.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Informatique',
            'code' => 'INFO109',
            'category' => 'science',
            'description' => 'L\'informatique enseigne les bases des technologies numériques et de la programmation.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Arts',
            'code' => 'ART110',
            'category' => 'art',
            'description' => 'Les arts permettent de développer la créativité et l\'expression personnelle.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Allemand',
            'code' => 'GER111',
            'category' => 'literature',
            'description' => 'L\'allemand est une literature vivante enseignée pour découvrir la culture germanique.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Latin',
            'code' => 'LAT112',
            'category' => 'literature',
            'description' => 'Le latin est une literature ancienne qui aide à comprendre les racines des literatures modernes.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Philosophie',
            'code' => 'PHIL113',
            'category' => 'literature',
            'description' => 'La philosophie est l\'étude des concepts fondamentaux sur la vie, la morale et la connaissance.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Sciences de la Vie et de la Terre (SVT)',
            'code' => 'SVT114',
            'category' => 'science',
            'description' => 'Les SVT explorent les organismes vivants et leur environnement.',
        ]);
        
        \App\Models\Subject::create([
            'name' => 'Éducation Physique et Sportive (EPS)',
            'code' => 'EPS115',
            'category' => 'sport',
            'description' => 'L\'EPS vise à développer les capacités physiques et le bien-être des élèves.',
        ]);

        
        \App\Models\Building::factory()->count(20)->create();

        // Création des classes pour le collège
        \App\Models\Classe::create([
            'name' => '6ème A',
            'level' => 'Sixieme',
            'building_id' => 1, // Assurez-vous d'avoir un bâtiment avec cet ID
            'description' => 'Classe de 6ème A, niveau débutant.',
        ]);

        \App\Models\Classe::create([
            'name' => '6ème B',
            'level' => 'Sixieme',
            'building_id' => 1,
            'description' => 'Classe de 6ème B, niveau débutant.',
        ]);

        \App\Models\Classe::create([
            'name' => '5ème A',
            'level' => 'Cinqieme',
            'building_id' => 1,
            'description' => 'Classe de 5ème A, cycle intermédiaire.',
        ]);

        \App\Models\Classe::create([
            'name' => '5ème B',
            'level' => 'Cinqieme',
            'building_id' => 1,
            'description' => 'Classe de 5ème B, cycle intermédiaire.',
        ]);

        \App\Models\Classe::create([
            'name' => '4ème A',
            'level' => 'Quatrieme',
            'building_id' => 1,
            'description' => 'Classe de 4ème A, cycle avancé.',
        ]);

        \App\Models\Classe::create([
            'name' => '4ème B',
            'level' => 'Quatrieme',
            'building_id' => 1,
            'description' => 'Classe de 4ème B, cycle avancé.',
        ]);

        \App\Models\Classe::create([
            'name' => '3ème A',
            'level' => 'Troisieme',
            'building_id' => 1,
            'description' => 'Classe de 3ème A, préparation au brevet.',
        ]);

        \App\Models\Classe::create([
            'name' => '3ème B',
            'level' => 'Troisieme',
            'building_id' => 1,
            'description' => 'Classe de 3ème B, préparation au brevet.',
        ]);

        for ($i = 1; $i <= Classe::count(); $i++)
        {    
            \App\Models\ClassesFees::create([
                'classe_id' => Classe::all()->random()->id,
                'school_fee_amount' => rand(300000, 1500000),
                'transport_fee_amount' => rand(50000, 75000),
                'registration_fee_amount' => rand(150000, 250000),
            ]);
        }

        // Création des classes pour le lycée
        foreach (['A', 'B', 'C', 'D'] as $suffix) {
            \App\Models\Classe::create([
                'name' => "2nd $suffix",
                'level' => 'Seconde',
                'building_id' => 2, // Assurez-vous d'avoir un bâtiment pour le lycée
                'description' => "Classe de 2nd $suffix, niveau général.",
            ]);
        }

        foreach (['A', 'B', 'C', 'D'] as $suffix) {
            \App\Models\Classe::create([
                'name' => "1ère $suffix",
                'level' => 'Premiere',
                'building_id' => 2,
                'description' => "Classe de 1ère $suffix, spécialisation en cours.",
            ]);
        }

        foreach (['A', 'B', 'C', 'D'] as $suffix) {
            \App\Models\Classe::create([
                'name' => "Tle $suffix",
                'level' => 'Terminale',
                'building_id' => 2,
                'description' => "Classe de Terminale $suffix, préparation au baccalauréat.",
            ]);
        }

        // Migrer les Pays
        $this->call(CountrySeeder::class);

        DB::table('clubs')->insert([
            [
                'name' => 'Club de Débat',
                'description' => 'Un club où les élèves participent à des débats sur des sujets variés, développant ainsi leur esprit critique et leur éloquence.',
                'image' => 'debate_club.jpg', // Remplacez par le chemin de l'image
                'created_by' => 1,
                'since' => Carbon::now()->subYears(2), // Date d'exemple
            ],
            [
                'name' => 'Club de Théâtre',
                'description' => 'Un club où les élèves explorent l’art dramatique, jouent des pièces et apprennent la mise en scène.',
                'image' => 'theater_club.jpg', // Remplacez par le chemin de l'image
                'created_by' => 1,
                'since' => Carbon::now()->subYears(3), // Date d'exemple
            ],
            [
                'name' => 'Club de Musique',
                'description' => 'Un club dédié aux amateurs de musique, pour jouer en groupe, apprendre des morceaux et organiser des concerts.',
                'image' => 'music_club.jpg', // Remplacez par le chemin de l'image
                'created_by' => 1,
                'since' => Carbon::now()->subYears(1), // Date d'exemple
            ],
            [
                'name' => 'Club de Football',
                'description' => 'Un club pour pratiquer le football, organiser des matchs et des compétitions sportives.',
                'image' => 'football_club.jpg', // Remplacez par le chemin de l'image
                'created_by' => 1,
                'since' => Carbon::now()->subYears(4), // Date d'exemple
            ],
            [
                'name' => 'Club de Lecture',
                'description' => 'Un club pour les passionnés de lecture, où l’on partage des livres, discute de romans et organise des séances de lecture.',
                'image' => 'reading_club.jpg', // Remplacez par le chemin de l'image
                'created_by' => 1,
                'since' => Carbon::now()->subYears(2), // Date d'exemple
            ],
            [
                'name' => 'Club de Photographie',
                'description' => 'Un club pour les passionnés de photographie, avec des ateliers, des sorties photo et des expositions.',
                'image' => 'photography_club.jpg', // Remplacez par le chemin de l'image
                'created_by' => 1,
                'since' => Carbon::now()->subYears(1), // Date d'exemple
            ],
        ]);

        \App\Models\Tutor::factory()->count(120)->create();

        \App\Models\Student::factory()->count(600)->create()->each(function ($student) {
            \App\Models\User::factory()->create([
                'uuid' => $student->uuid,
                'name' => $student->first_name . ' ' . $student->last_name,
                'email' => $student->email,
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);
        });

        \App\Models\Teacher::factory()->count(30)->create()->each(function ($teacher) {
            \App\Models\User::factory()->create([
                'uuid' => $teacher->uuid,
                'name' => $teacher->first_name . ' ' . $teacher->last_name,
                'email' => $teacher->email,
                'password' => Hash::make('password'),
                'role' => 'teacher',
            ]);
        });

        DB::table('periods')->insert([
            [
                'name' => 'Semestre 1',
                'academic_year_id' => 1,
            ],
            [
                'name' => 'Semestre 2',
                'academic_year_id' => 1,
            ],
        ]);

        DB::table('exam_types')->insert([
            [
                'name' => 'Examen',
                'description' => 'Examen de la classe',
            ],
            [
                'name' => 'Devoir',
                'description' => 'Devoir de la classe',
            ],
            [
                'name' =>'Interrogation',
                'description' => 'Interrogation de la classe',
            ],
            [
                'name' => 'Rattrapage',
                'description' => 'Rattrapage de la classe',
            ],
        ]);
    }
}
