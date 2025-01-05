@extends('layouts.dashboardTeacher')

@section('title', 'Tableau de bord')

@section('content')
<div class="p-6 space-y-6">
    <!-- Personal Information Section -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-lg border border-gray-200 p-6 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Informations personnelles</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-medium">Nom :{{ $datas['teacher']->title }} {{ $datas['teacher']->first_name }}  {{ $datas['teacher']->last_name }}</p>
                <p class="font-medium">Matricule (CNI) : {{ $datas['teacher']->cni_number }}</p>
                <p class="font-medium">Email : {{ auth()->user()->email }}</p>
            </div>
            <div>
                <p class="font-medium">Numéro de téléphone : {{ $datas['teacher']->phone }}</p>
                <p class="font-medium">Spécialité : {{ $datas['teacher']->speciality }}</p>
                <p class="font-medium">Date d'embauche : {{ $datas['teacher']->hire_date }}</p>
            </div>
        </div>
    </div>

    <!-- Dashboard Cards Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($cards as $card)
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ $card['label'] }}</h2>
                <p class="text-4xl font-bold text-blue-600">{{ $card['count'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Today's Schedule Section -->
    <div class="bg-gradient-to-r from-green-400 to-teal-500 text-white rounded-lg border border-gray-200 p-6 shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Planning du jour</h2>
        <ul class="list-disc list-inside">
            <li class="mb-2">Maths : 08:00 - 10:00</li>
            <!-- Ajoutez d'autres cours ici si nécessaire -->
        </ul>
        <p class="text-yellow-200 font-semibold mt-4">N'oubliez pas de préparer vos cours !</p>
    </div>
</div>
@endsection
