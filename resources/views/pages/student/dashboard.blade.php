@extends('layouts.dashboard')

@section('title', 'Tableau de bord')

@section('content')
<div class="p-6 space-y-8">
    {{-- Carte principale avec les informations utilisateur --}}
    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-md border border-indigo-200 p-6 shadow-lg">
        <div class="text-center mb-6 py-2">
            <h1 class="text-4xl font-bold text-indigo-800 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 21V7a2 2 0 00-2-2H6a2 2 0 00-2 2v14M9 14h6" />
                </svg>
                Bonjour, {{ auth()->user()->name }}
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Informations personnelles --}}
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM5 21v-2a4 4 0 014-4h6a4 4 0 014 4v2" />
                    </svg>
                    Informations personnelles
                </h2>
                <ul class="space-y-3">
                    <li><span class="font-bold text-gray-600">Nom complet :</span> {{ $datas['student']->first_name }} {{ $datas['student']->last_name }}</li>
                    <li><span class="font-bold text-gray-600">Date de naissance :</span> {{ $datas['student']->formatted_birth_date }}</li>
                    <li><span class="font-bold text-gray-600">Lieu de naissance :</span> {{ $datas['student']->place_of_birth->name }}</li>
                    <li><span class="font-bold text-gray-600">Nationalité :</span> {{ $datas['student']->nationality->nationality }}</li>
                    <li><span class="font-bold text-gray-600">Genre :</span>
                        {{  $datas['student']->gender === 'female' ? 'FEMININ' : 'MASCULIN' }}
                    </li>
                    <li><span class="font-bold text-gray-600">Adresse :</span> {{ $datas['student']->address }}</li>
                </ul>
            </div>

            {{-- Informations académiques --}}
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v-2a4 4 0 00-4-4H7a4 4 0 00-4 4v2a4 4 0 004 4h1a4 4 0 004-4z" />
                    </svg>
                    Informations académiques
                </h2>
                <ul class="space-y-3">
                    <li><span class="font-bold text-gray-600">Matricule :</span> {{ $datas['student']->matricule }}</li>
                    <li><span class="font-bold text-gray-600">Classe :</span> {{ $datas['classe']->name ?? 'Non assignée' }}</li>
                    <li><span class="font-bold text-gray-600">Club :</span> {{ $datas['club']->name ?? 'Aucun' }}</li>
                    <li><span class="font-bold text-gray-600">Bourse :</span>
                        <span class="px-2 py-1 rounded-full text-white {{ $datas['student']->scholarship == 'full' ? 'bg-green-500' : ($datas['student']->scholarship == 'partial' ? 'bg-yellow-500' : 'bg-gray-400') }}">
                            {{ ucfirst($datas['student']->scholarship) }}
                        </span>
                    </li>
                </ul>
            </div>

            {{-- Informations médicales --}}
            <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6" />
                    </svg>
                    Informations médicales
                </h2>
                <ul class="space-y-3">
                    <li><span class="font-bold text-gray-600">Groupe sanguin :</span> {{ $datas['student']->blood_group ?? 'Non renseigné' }}</li>
                    <li><span class="font-bold text-gray-600">Allergies :</span> {{ $datas['student']->alergies ?? 'Aucune' }}</li>
                    <li><span class="font-bold text-gray-600">Assurance :</span> {{ $datas['student']->assurance_number ?? 'Non renseigné' }}</li>
                    <li><span class="font-bold text-gray-600">Cantine :</span>
                        <span class="px-2 py-1 rounded-full text-white {{ $datas['student']->enable_for_canteen ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $datas['student']->enable_for_canteen ? 'Activé' : 'Désactivé' }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Planning du jour --}}
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-md border border-gray-200 p-6 shadow-lg">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01m-6.938 4a9 9 0 1113.856 0H5.062z" />
                </svg>
                Planning du jour
            </h2>
        </div>
        <div class="text-gray-700 text-lg">
            <ul class="space-y-2">
                <li>- Mathématiques : 08h00 - 10h00</li>
                <li>- Physique : 10h30 - 12h30</li>
                <li>- Anglais : 14h00 - 15h30</li>
            </ul>
        </div>
    </div>
</div>
@endsection
