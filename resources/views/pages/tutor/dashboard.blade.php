@extends('layouts.dashboard')

@section('title', 'Tableau de bord')

@section('content')
<div class="p-6 space-y-6">
    {{-- Carte principale avec les informations utilisateur --}}
    <div class="bg-gradient-to-r from-white to-gray-50 rounded-md border border-gray-200 p-6 shadow-lg">
        <div class="flex flex-col items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Hey, {{ auth()->user()->name }}</h1>
        </div>

        <div class="flex flex-col md:flex-row items-center">
            {{-- Informations utilisateur --}}
            <div class="md:w-2/3 space-y-4">
                <div class="flex flex-col md:flex-row space-x-0 md:space-x-6">
                    <div class="w-full md:w-1/2">
                        <ul class="space-y-3">
                            <li class="text-gray-700 font-medium text-base">
                                <span class="text-gray-500">Matricule :</span> {{ $datas['student']->matricule }}
                            </li>
                            <li class="text-gray-700 font-medium text-base">
                                <span class="text-gray-500">Classe :</span> {{ $datas['classe']->name ?? 'Non assignée' }}
                            </li>
                        </ul>
                    </div>
                    <div class="w-full md:w-1/2">
                        <ul class="space-y-3">
                            <li class="text-gray-700 font-medium text-base">
                                <span class="text-gray-500">Téléphone :</span> {{ $datas['student']->phone }}
                            </li>
                            <li class="text-gray-700 font-medium text-base">
                                <span class="text-gray-500">Club :</span> {{ $datas['club']->name ?? 'Aucun' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Image de profil --}}
            <div class="md:w-1/3 flex justify-center md:justify-end mt-6 md:mt-0">
                @if($datas['student']->profile_picture)
                    <img src="{{ asset($datas['student']->profile_picture) }}" alt="Photo de profil" class="rounded-full w-20 h-20 object-cover">
                @else
                    <img src="{{ asset('/assets/images/default-profile.png') }}" alt="Photo de profil" class="rounded-full w-20 h-20 object-cover">
                @endif
            </div>
        </div>
    </div>

    {{-- Cartes supplémentaires --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($cards as $card)
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-md transition-transform transform hover:scale-105">
                <div class="flex justify-between mb-4">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-700">{{ $card['count'] }}</h2>
                        <p class="text-gray-500 text-sm">{{ $card['label'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Horaire du jour --}}
    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-md border border-gray-200 p-6 shadow-lg">
        <div class="flex flex-col items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Aujourd'hui :</h2>
        </div>

        <div class="flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-gray-700 text-lg">
                <p>Math de 08h à 10h</p>
            </div>
            <div class="md:w-1/2 flex justify-center md:justify-end text-red-500 font-semibold text-lg">
                <p>N'oubliez pas</p>
            </div>
        </div>
    </div>
</div>
@endsection
