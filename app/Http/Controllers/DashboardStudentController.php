<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Classe;
use App\Models\Payment;
use App\Models\Student;
use App\Models\TimeTable;
use App\Models\SchoolInfo;
use App\Models\ClassesFees;
use Illuminate\Http\Request;

class DashboardStudentController extends Controller
{
    public function index()
    {
        $schoolInfo = SchoolInfo::first();
        $datas = $this->collectDatas(auth()->user()->uuid);

        $cards = [
            ['label' => 'Élèves dans la classe', 'count' => $datas['studentsCount']],
            ['label' => 'Matières', 'count' => $datas['timeTable']],
            ['label' => 'Événements à venir', 'count' => '...'], // Vous pouvez gérer cela dynamiquement plus tard
        ];

        return view('pages.student.dashboard', compact('schoolInfo', 'datas', 'cards'));
    }

    public function profile()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        return view('pages.student.profile', compact('student', 'schoolInfo'));
    }

    private function collectDatas(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if ($user->role === 'student') {
            $student = Student::where('uuid', $uuid)->firstOrFail();
            $tutor = Tutor::find($student->tutor_id);
            $classe = Classe::find($student->classe_id);
            $club = Club::find($student->club_id);
            $timeTableCount = TimeTable::where('classe_id', $student->classe_id)->count();
            $studentsCount = Student::where('classe_id', $student->classe_id)->count();

            return [
                'student' => $student,
                'studentsCount' => $studentsCount,
                'tutor' => $tutor,
                'classe' => $classe,
                'club' => $club,
                'timeTable' => $timeTableCount,
            ];
        }

        abort(403, 'Unauthorized action.');
    }

    public function myClasse()
    {
        $schoolInfo = SchoolInfo::first();

        // Vérification de l'élève
        $student = Student::where('uuid', auth()->user()->uuid)->first();
        if (!$student) {
            abort(404, 'Étudiant non trouvé.');
        }

        // Vérification de la classe
        $classe = Classe::find($student->classe_id);
        if (!$classe) {
            abort(404, 'Classe non trouvée.');
        }

        // Récupérer tous les étudiants de la même classe
        $students = Student::where('classe_id', $student->classe_id)
            ->orderBy('last_name')
            ->get();

        // Retourner la vue avec les données
        return view('pages.student.myclasse', compact('classe', 'students', 'schoolInfo'));
    }

    public function subjects()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        // Récupérer les matières pour la classe de l'élève via la table time_tables
        $timeTable = TimeTable::where('classe_id', $student->classe_id)
            ->with('subject') // Charger les matières associées
            ->orderBy('day')
            ->get();

        return view('pages.student.subjects', compact('timeTable', 'student', 'schoolInfo'));
    }

    public function teachers()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        // Récupérer les professeurs uniques associés à la classe
        $teachers = TimeTable::where('classe_id', $student->classe_id)
            ->with('teacher') // Charger les professeurs associés
            ->orderBy('day')
            ->get()
            ->pluck('teacher') // Extraire les professeurs
            ->unique(); // Supprimer les doublons

        return view('pages.student.teachers', compact('teachers', 'student', 'schoolInfo'));
    }

    public function payments()
    {
        // Récupération des informations générales de l'école
        $schoolInfo = SchoolInfo::first();

        // Récupération de l'étudiant connecté
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        // Récupération des paiements effectués par l'étudiant
        $payments = Payment::where('student_id', $student->id)
            ->orderBy('created_at')
            ->get();

        // Récupération des informations de la classe de l'étudiant
        $classe = Classe::find($student->classe_id);

        // Récupération des frais liés à la classe
        $classeFees = ClassesFees::where('classe_id', $classe->level)->first();

        // Calcul des montants totaux payés par catégorie
        $paidFees = [
            'registration_fee_paid' => $payments->where('payment_for', 'registration_fees')->sum('amount'),
            'transport_fee_paid' => $payments->where('payment_for', 'bus_fees')->sum('amount'),
            'school_fee_paid' => $payments->where('payment_for', 'school_fees')->sum('amount'),
        ];

        return view('pages.student.payments', compact('student', 'payments', 'classeFees', 'schoolInfo', 'paidFees'));
    }

}
