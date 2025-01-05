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
use App\Http\Controllers\Controller;

class DashboardParentController extends Controller
{
    public function index()
    {
        $schoolInfo = SchoolInfo::first();

        $datas = $this->collectDatas(auth()->user()->uuid);

        $cards = [
            ['label' => 'Elèves dans la classe.', 'count' => $datas['studentsCount']],
            ['label' => 'Matières', 'count' => $datas['timeTable']],
            ['label' => 'Evenements à venir', 'count' => '...'],
        ];

        return view('pages.student.dashboard', compact('schoolInfo', 'datas', 'cards'));
    }

    public function profile()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        return view('pages.student.profile', compact('student', 'schoolInfo'));
    }

    public function collectDatas(string $uuid)
    {
        $role = User::where('uuid', $uuid)->firstOrFail();

        if ($role->role === 'student')
        {
            $student = Student::where('uuid', $uuid)->firstOrFail();
            $tutor = Tutor::where('id', $student->tutor_id)->firstOrFail();
            $classe = Classe::where('id', $student->classe_id)->firstOrFail();
            $club = Club::where('id', $student->club_id)->firstOrFail();
            $timeTable = TimeTable::where('classe_id', $student->classe_id)->count();
            $allStudentsCount = Student::where('classe_id', $student->classe_id)->count();

            //Quoi de prévu aujourd'hui


            return [
                'student' => $student,
                'studentsCount' => $allStudentsCount,
                'tutor' => $tutor,
                'classe' => $classe,
                'club' => $club,
                'timeTable' => $timeTable
            ];
        }
    }

    public function myClasse()
    {
        $schoolInfo = SchoolInfo::first();

        $student = Student::where('uuid', auth()->user()->uuid)->first();

        $classe = Classe::where('id', $student->classe_id)->firstOrFail();

        $students = Student::orderBy('last_name')->where('classe_id', $student->classe_id)->get();

        return view('pages.student.myclasse', compact('classe', 'students', 'schoolInfo'));
    }

    public function subjects()
    {
        $schoolInfo = SchoolInfo::first();

        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        $timeTable = TimeTable::orderBy('day')->where('classe_id', $student->classe_id)->get();

        return view('pages.student.subjects', compact('timeTable', 'student', 'schoolInfo'));
    }

    public function teachers()
    {
        $schoolInfo = SchoolInfo::first();

        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        $timeTable = TimeTable::orderBy('day')->where('classe_id', $student->classe_id)->get();

        return view('pages.student.subjects', compact('timeTable', 'student', 'schoolInfo'));
    }

    public function payments()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();
        $payments = Payment::orderBy('created_at')->where('student_id', $student->id)->get();
        $classe = Classe::where('id', $student->classe_id)->first();
        $classeFees = ClassesFees::where('classe_id', $classe->level)->first();

        return view('pages.student.payments', compact('student', 'payments', 'classeFees', 'schoolInfo'));
    }
}
