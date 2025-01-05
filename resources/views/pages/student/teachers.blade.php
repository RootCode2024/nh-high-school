@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto p-10">
    <!-- Titre principal -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Mes Professeurs</h1>

    <!-- Informations sur l'étudiant -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Informations sur l'étudiant</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><span class="font-bold text-gray-600">Nom :</span> {{ $student->first_name }} {{ $student->last_name }}</p>
            <p><span class="font-bold text-gray-600">Classe :</span> {{ $student->classe->name }}</p>
        </div>
    </div>

    <!-- Informations sur l'école -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Informations sur l'école</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <p><span class="font-bold text-gray-600">Nom :</span> {{ $schoolInfo->name }}</p>
            <p><span class="font-bold text-gray-600">Adresse :</span> {{ $schoolInfo->address }}</p>
        </div>
    </div>

    <!-- Liste des enseignants -->
    <div class="bg-white shadow-md rounded-lg p-6">
        @if($teachers->isNotEmpty())
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Liste des Professeurs {{ $teachers->count() }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($teachers as $teacher)
                    <!-- Carte d'un professeur -->
                    <div class="bg-gray-50 border rounded-lg shadow-sm p-4 flex flex-col items-center">
                        <!-- Avatar du professeur -->
                        <div class="w-20 h-20 rounded-full bg-gray-200 mb-4 flex items-center justify-center">
                            <!-- Placeholder pour une image (peut être remplacé par une vraie photo si disponible) -->
                            @if ($teacher->profile_picture)
                                <span class="text-gray-500 text-2xl font-semibold">
                                    <img src="{{ asset($teacher->profile_picture) }}" alt="{{ $teacher->first_name }} {{ $teacher->last_name }}" class="rounded-full w-20 h-20 object-cover">
                                </span>
                            @else
                                <span class="text-gray-500 text-2xl font-semibold">
                                    {{ strtoupper(substr($teacher->first_name, 0, 1)) . strtoupper(substr($teacher->last_name, 0, 1)) }}
                                </span>
                            @endif
                        </div>
                        <!-- Infos du professeur -->
                        <h3 class="text-lg font-bold text-gray-800">{{ $teacher->getFullNameAttribute() }}</h3>
                        <p class="text-sm text-gray-600">{{ $teacher->teacherSubjectName($student->classe_id) }}</p>
                        <p class="text-sm text-gray-500">{{ $teacher->email }}</p>
                        <a href="mailto:{{ $teacher->email }}" class="mt-4 text-blue-600 hover:text-blue-800 text-sm">
                            Contacter
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Aucun professeur associé à votre classe.</p>
        @endif
    </div>
</div>
@endsection

