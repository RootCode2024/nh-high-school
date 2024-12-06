@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h4 class="text-xl font-semibold text-gray-800">Profil de l'étudiant</h4>
            @if($student->profile_picture)
                <img src="{{ asset($student->profile_picture) }}" alt="Photo de profil" class="rounded-full w-20 h-20 object-cover">
            @else
                <img src="{{ asset('/assets/images/default-profile.png') }}" alt="Photo de profil" class="rounded-full w-20 h-20 object-cover">
            @endif
        </div>
        <div class="p-6">
            <div x-data="{ tab: 'personal' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <a @click.prevent="tab = 'personal'" :class="{'border-indigo-500 text-indigo-600': tab === 'personal', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'personal'}" href="#" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Informations personnelles</a>
                        <a @click.prevent="tab = 'academic'" :class="{'border-indigo-500 text-indigo-600': tab === 'academic', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'academic'}" href="#" class="whitespace-nowrap pb-4 px-1 border-b-2 font-medium text-sm">Informations académiques</a>
                    </nav>
                </div>

                <div class="mt-6" x-show="tab === 'personal'">
                    <h5 class="text-lg font-medium text-gray-700 mb-4">Informations personnelles</h5>
                    <table class="w-full text-left text-gray-600">
                        <tbody>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Matricule</th>
                                <td class="py-2 px-4">{{ $student->matricule }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Nom complet</th>
                                <td class="py-2 px-4">{{ $student->first_name }} {{ $student->last_name }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Genre</th>
                                <td class="py-2 px-4">
                                    @if ($student->gender === 'female')
                                        {{ ucfirst('feminin') }}
                                    @else
                                        {{ ucfirst('masculin') }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Email</th>
                                <td class="py-2 px-4">{{ $student->email }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Téléphone</th>
                                <td class="py-2 px-4">{{ $student->phone }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Adresse</th>
                                <td class="py-2 px-4">{{ $student->address }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Née le </th>
                                <td class="py-2 px-4">
                                    {{ \Carbon\Carbon::parse($student->date_of_birth)->translatedFormat('d F Y', 'en') }}
                                    à {{ $student->place_of_birth->name }}
                                    - {{ $student->nationality->nationality }}
                                </td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Numéro CNI</th>
                                <td class="py-2 px-4">{{ $student->cni_number ?? 'Non renseigné' }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Numéro d'assurance</th>
                                <td class="py-2 px-4">{{ $student->assurance_number ?? 'Non renseigné' }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Allergies</th>
                                <td class="py-2 px-4">{{ $student->alergies ?? 'Aucune' }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Accès cantine</th>
                                <td class="py-2 px-4">{{ $student->enable_for_canteen ? 'Oui' : 'Non' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-6" x-show="tab === 'academic'">
                    <h5 class="text-lg font-medium text-gray-700 mb-4">Informations académiques</h5>
                    <table class="w-full text-left text-gray-600">
                        <tbody>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Année académique</th>
                                <td class="py-2 px-4">{{ $student->academic_year->name }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Statut</th>
                                <td class="py-2 px-4">
                                    @if ($student->status == false)
                                    <span class="flex block-inline">
                                        <span class="text-green-800">Inactif</span> 
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>                                            
                                    </span> 
                                    @else
                                    <span class="flex block-inline">
                                        <span class="text-green-800">Actif</span> 
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                          </svg>    
                                    </span>                                      
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Classe</th>
                                <td class="py-2 px-4">{{ $student->classe->name }} ({{  $student->classe->level}})</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Club</th>
                                <td class="py-2 px-4">{{ $student->club->name }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Bus</th>
                                <td class="py-2 px-4">{{ $student->bus->bus_number ?? 'Non Assigné' }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-2 px-4 font-medium">Tuteur</th>
                                <td class="py-2 px-4">
                                    {{ $student->tutor->first_name . ' ' . $student->tutor->last_name }}
                                    <br>(
                                    @if ($student->tutor->type == 'father')
                                        Père
                                    @elseif ($student->tutor->type == 'mother')
                                        Mère
                                    @elseif ($student->tutor->type == 'sister')
                                        Soeur 
                                    @elseif ($student->tutor->type == 'brother')
                                        Frère
                                    @elseif ($student->tutor->type == 'uncle')
                                        Oncle
                                    @elseif ($student->tutor->type == 'aunt')
                                        Tante
                                    @elseif ($student->tutor->type == 'grand_father')
                                        Grand Père
                                    @elseif ($student->tutor->type == 'grand_mother')
                                        Grand Mère
                                    @endif
                                    )
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection