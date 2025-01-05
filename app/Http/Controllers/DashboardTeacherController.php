<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Classe, ClassesFees, Payment, SchoolInfo, Student, Teacher, TimeTable, User};

class DashboardTeacherController extends Controller
{
    public function index()
    {
        $schoolInfo = SchoolInfo::first();
        $datas = $this->collectDatas(auth()->user()->uuid);

        $cards = [
            ['label' => 'Elèves tenus', 'count' => $datas['students']],
            ['label' => 'Spécialité', 'count' => $datas['teacher']->speciality ?? 'Non défini'],
            ['label' => 'Nombre de classes', 'count' => count($datas['classes'])],
        ];

        return view('pages.teacher.dashboard', compact('schoolInfo', 'datas', 'cards'));
    }

    public function profile()
    {
        $schoolInfo = SchoolInfo::first();
        $teacher = Teacher::where('uuid', auth()->user()->uuid)->firstOrFail();

        return view('pages.teacher.profile', compact('teacher', 'schoolInfo'));
    }

    public function collectDatas(string $uuid)
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        if ($user->role === 'teacher') {
            $teacher = Teacher::where('uuid', $uuid)->firstOrFail();
            $timeTables = TimeTable::where('teacher_id', $teacher->id)->get();

            // Récupération des classes
            $classesIds = $timeTables->pluck('classe_id')->unique();
            $classes = Classe::whereIn('id', $classesIds)->get();

            // Calcul du nombre total d'élèves
            $studentsCount = Student::whereIn('classe_id', $classesIds)->count();

            return [
                'teacher' => $teacher,
                'classes' => $classes,
                'students' => $studentsCount,
            ];
        }

        return [];
    }

    public function myClasses()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();
        $classe = Classe::findOrFail($student->classe_id);

        $students = Student::where('classe_id', $classe->id)->orderBy('last_name')->get();

        return view('pages.teacher.myclasses', compact('classe', 'students', 'schoolInfo'));
    }

    public function subjects()
    {
        $schoolInfo = SchoolInfo::first();
        $teacher = Teacher::where('uuid', auth()->user()->uuid)->firstOrFail();

        $timeTable = TimeTable::where('classe_id', $teacher->classe_id)->orderBy('day')->get();

        return view('pages.teacher.subjects', compact('timeTable', 'teacher', 'schoolInfo'));
    }

    public function teachers()
    {
        $schoolInfo = SchoolInfo::first();
        $student = Student::where('uuid', auth()->user()->uuid)->firstOrFail();

        $timeTable = TimeTable::where('classe_id', $student->classe_id)->orderBy('day')->get();

        return view('pages.teacher.subjects', compact('timeTable', 'student', 'schoolInfo'));
    }

    public function payments()
    {
        $schoolInfo = SchoolInfo::first();
        $teacher = Teacher::where('uuid', auth()->user()->uuid)->firstOrFail();

        $payments = Payment::where('teacher_id', $teacher->id)->orderBy('created_at')->get();

        $classe = Classe::find($teacher->classe_id);
        $classeFees = $classe ? ClassesFees::where('classe_id', $classe->level)->first() : null;

        return view('pages.teacher.payments', compact('teacher', 'payments', 'classeFees', 'schoolInfo'));
    }

    public function notes()
    {
        $schoolInfo = SchoolInfo::first();
        $teacher = Teacher::where('uuid', auth()->user()->uuid)->firstOrFail();
        $classes = DB::table('time_tables')
        ->join('classes', 'time_tables.classe_id', '=', 'classes.id')
        ->where('time_tables.teacher_id', $teacher->id)
        ->select('classes.id', 'classes.name') // Ajouter d'autres colonnes si nécessaire
        ->distinct()
        ->get();

        $classess = [];
        foreach ($classes as $value) {
            $classess[] = $value->name;
        }
        // dd($classess);

        return view('pages.teacher.notes', compact('teacher', 'schoolInfo', 'classess'));
    }
}
