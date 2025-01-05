@extends('layouts.dashboard')

@section('title', 'Détail de la classe et liste des étudiants')

@section('content')
<div class="max-w-6xl mx-auto mt-6">
    <!-- Détails de la classe -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-extrabold text-gray-800">📘 Détail de la classe</h1>
        <div class="mt-4 space-y-3">
            <p><span class="font-semibold text-gray-700">Nom de la classe :</span> {{ $classe->name }} ({{ $classe->classeLevel($classe->level) }})</p>
            <p><span class="font-semibold text-gray-700">Professeur Principal :</span> {{ $classe->mainTeacher()->title }} {{ $classe->mainTeacher()->last_name }} {{ $classe->mainTeacher()->first_name }} ({{ $classe->mainTeacher()->speciality }})</p>
            <p><span class="font-semibold text-gray-700">Nombre d'étudiants :</span> {{ $students->count() }}</p>
        </div>
    </div>

    <!-- Liste des étudiants -->
    <div class="mt-6 bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-800">👨‍🎓 Liste des étudiants</h2>
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full border border-gray-200 divide-y divide-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Anniversaire</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($students as $index => $student)
                        @php
                            $isCurrentUser = $student->uuid === auth()->user()->uuid;
                            $rowClass = $isCurrentUser ? 'bg-green-100 font-bold' : '';
                            $textClass = $isCurrentUser ? 'text-green-600' : 'text-gray-800';

                            $now = \Carbon\Carbon::now();
                            $date_of_birth = \Carbon\Carbon::parse($student->date_of_birth)->setYear($now->year);
                            if ($date_of_birth->isPast()) {
                                $date_of_birth->addYear();
                            }
                            $months = $now->diffInMonths($date_of_birth);
                            $days = $now->diffInDays($date_of_birth->copy()->subMonths($months));
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td class="px-4 py-2 border text-sm {{ $textClass }}">{{ $index + 1 }}</td>
                            <td class="px-4 py-2 border text-sm {{ $textClass }}">{{ strtoupper($student->last_name) }} {{ $student->first_name }}</td>
                            <td class="px-4 py-2 border text-sm {{ $textClass }}">{{ $student->email }}</td>
                            <td class="px-4 py-2 border text-sm {{ $textClass }}">
                                @if (round($months) === 0 && round($days) <= 2)
                                    <span class="text-green-500">🎉 Joyeux Anniversaire !</span>
                                @else
                                    <span>Dans {{ round($months) }} mois et {{ round($days) }} jours</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">
                                Aucun étudiant trouvé pour cette classe.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
