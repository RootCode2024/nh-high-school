<?php

namespace App\Http\Controllers;

use App\Models\SchoolInfo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function homePage()
    {
        $schoolInfo = SchoolInfo::first();
        return view('pages.home', compact('schoolInfo'));
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

    public function login() {
        return view('auth.login');
    }
}
