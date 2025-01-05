@extends('layouts.dashboard')

@section('title', 'Détail de la classe et liste desétudiants')

@section('content')
<div class="w-4xl mx-6 mt-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-xl font-bold text-gray-800">Détail de la classe</h1>
        <div class="mt-4 space-y-3">
            <p><span class="font-semibold text-gray-700">Nom de la classe :</span> {{ $classe->name }} ( {{ $classe->classeLevel($classe->level) }} )</p>
            <p><span class="font-semibold text-gray-700">Professeur Principale :</span> {{ $classe->mainTeacher()->title }} {{ $classe->mainTeacher()->last_name }} {{ $classe->mainTeacher()->first_name }} ( {{ $classe->mainTeacher()->speciality }} )</p>
            <p><span class="font-semibold text-gray-700">Nombre d'étudiants :</span> {{ $students->count() }}</p>
        </div>
    </div>

    <div class="mt-6 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-lg font-bold text-gray-800">Liste des étudiants</h2>
        <table class="min-w-full mt-4 border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">#</th>
                    <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Nom</th>
                    <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Email</th>
                    <th class="px-4 py-2 border border-gray-300 text-left text-sm font-semibold text-gray-700">Anniversaire</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $index => $student)
                    <tr class="{{ $index % 2 === 0 ? 'bg-gray-50' : '' }}">
                        @if ($student->uuid === auth()->user()->uuid)
                        <td class="px-4 py-2 border border-gray-300 bg-green-500 text-sm text-gray-800">

                        @else
                        <td class="px-4 py-2 border border-gray-300 text-sm text-gray-800">

                        @endif{{ $index + 1 }}</td>
                        @if ($student->uuid === auth()->user()->uuid)
                        <td class="px-4 py-2 border border-gray-300 bg-green-500 text-sm text-gray-800">

                        @else
                        <td class="px-4 py-2 border border-gray-300 text-sm text-gray-800">

                        @endif
                        {{ strtoupper($student->last_name) }} {{ $student->first_name }}</td>
                        @if ($student->uuid === auth()->user()->uuid)
                        <td class="px-4 py-2 border border-gray-300 bg-green-500 text-sm text-gray-800">

                        @else
                        <td class="px-4 py-2 border border-gray-300 text-sm text-gray-800">

                        @endif
                        {{ $student->email }}</td>
                        @if ($student->uuid === auth()->user()->uuid)
                        <td class="px-4 py-2 border border-gray-300 bg-green-500 text-sm text-gray-800">

                        @else
                        <td class="px-4 py-2 border border-gray-300 text-sm text-gray-800">

                        @endif
                            @php
                                $now = \Carbon\Carbon::now();
                                $date_of_birth = \Carbon\Carbon::parse($student->date_of_birth)->setYear($now->year);
                                if ($date_of_birth->isPast()) {
                                    $date_of_birth->addYear();
                                }
                                $months = $now->diffInMonths($date_of_birth);
                                $days = $now->diffInDays($date_of_birth->copy()->subMonths($months));
                            @endphp
                            @if (round($months) == 0 & round($days) <= 2)
                                <span class="text-green-500">Joyeux Anniversaire</span>
                            @else
                                Dans {{ round($months) }} mois et {{ round($days) }} jours
                            @endif
                            </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 border border-gray-300 text-center text-sm text-gray-800">No students found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

