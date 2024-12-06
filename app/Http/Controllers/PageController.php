<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Classe;
use App\Models\Student;
use App\Models\SchoolInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function homePage()
    {
        $schoolInfo = SchoolInfo::first();
        return view('pages.website.home', compact('schoolInfo'));
    }

    public function aboutPage() {
        return view('pages.about');
    }

    public function programmesPage() {
        return view('pages.programmes');
    }

    public function blogPage() {
        return view('pages.blog');
    }

    public function contactPage() {
        return view('pages.contact');
    }


}
