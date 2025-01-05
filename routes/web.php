<?php

use App\Models\Student;
use Illuminate\Http\Request;
// use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DashboardParentController;
use App\Http\Controllers\DashboardStudentController;
use App\Http\Controllers\DashboardTeacherController;

//Website Pages
Route::get('/', [PageController::class, 'homePage'])->name('home');
Route::get('/about', [PageController::class, 'aboutPage'])->name('about');
Route::get('/programmes', [PageController::class, 'programmesPage'])->name('programmes');
Route::get('/blog', [PageController::class, 'blogPage'])->name('blog');
Route::get('/contact', [PageController::class, 'contactPage'])->name('contact');


//Student Pages
Route::prefix('student/')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardStudentController::class, 'index'])->name('student.dashboard');
    Route::get('profile', [DashboardStudentController::class, 'profile'])->name('student.profile');
    Route::get('myclasse', [DashboardStudentController::class, 'myClasse'])->name('student.myclasse');
    Route::get('subjects', [DashboardStudentController::class, 'subjects'])->name('student.subjects');
    Route::get('teachers', [DashboardStudentController::class, 'teachers'])->name('student.teachers');
    Route::get('payments', [DashboardStudentController::class, 'payments'])->name('student.payments');
});

//Tutor Pages
Route::prefix('parent/')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardParentController::class, 'index'])->name('parent.dashboard');
    Route::get('profile', [DashboardParentController::class, 'profile'])->name('parent.profile');
    Route::get('children', [DashboardParentController::class, 'myClasse'])->name('parent.children');
    Route::get('bulletin', [DashboardParentController::class, 'subjects'])->name('parent.bulletin');
    Route::get('teachers', [DashboardParentController::class, 'teachers'])->name('parent.teachers');
    Route::get('payments', [DashboardParentController::class, 'payments'])->name('parent.payments');
});

//Teacher Pages
Route::prefix('teacher/')->middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardTeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('profile', [DashboardTeacherController::class, 'profile'])->name('teacher.profile');
    Route::get('notes', [DashboardTeacherController::class, 'notes'])->name('teacher.notes');
    Route::get('myclasses', [DashboardTeacherController::class, 'myClasses'])->name('teacher.myclasses');
    Route::get('subjects', [DashboardTeacherController::class, 'subjects'])->name('teacher.subjects');
    Route::get('students', [DashboardTeacherController::class, 'teachers'])->name('teacher.students');
    Route::get('payments', [DashboardTeacherController::class, 'payments'])->name('teacher.payments');
});
Route::get('/api/students', function (Request $request) {
    // dd($request);
    // $className = $request->query('class');
    // $students = Student::where('classe_id', 2)->get(['id', 'name']);
    // return response()->json($students);
    return response()->json($request->all());
});
Route::post('/api/save-notes', function (Request $request) {
    $className = $request->input('class');
    $notes = $request->input('notes');

    dd($notes);
    // foreach ($notes as $note) {
    //     StudentNote::updateOrCreate(
    //         ['student_id' => $note['student_id'], 'class_name' => $className],
    //         ['note' => $note['note']]
    //     );
    // }

    return response()->json(['message' => 'Notes enregistrées avec succès!']);
});


// Route::fallback([PageController::class, 'notFound']);

Route::get('/settings', [PageController::class, 'settingsPage'])->name('settings');
Route::get('/notifications', [PageController::class, 'settingsPage'])->name('notifications');

require __DIR__.'/auth.php';
