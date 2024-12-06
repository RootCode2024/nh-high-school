<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Classe;
use App\Models\Student;
use App\Models\SchoolInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    public function index()
    {
        $schoolInfo = SchoolInfo::first();

        if (auth()->check()) {
            $datas = $this->collectDatas(auth()->user()->uuid);
            
            $cards = [
                ['label' => 'Elèves dans la classe.', 'count' => 20],
                ['label' => 'Matières', 'count' => '...'],
                ['label' => 'Evenements à venir', 'count' => '...'],
            ];

            return view('pages.student.dashboard', compact('schoolInfo', 'datas', 'cards'));
        }

        return redirect()->route('login');
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

            $allStudentsCount = Student::where('classe_id', $student->classe_id)->count();

            return [
                'student' => $student,
                'studentsCount' => $allStudentsCount,
                'tutor' => $tutor,
                'classe' => $classe,
                'club' => $club
            ];
        }
    }
}
