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
        <div class="p-6 bg-white rounded-lg shadow-md">
            <div>

                <!-- Academic Information Tab -->
                <div class="mt-6">
                    <h5 class="text-lg font-semibold text-gray-800 mb-4">Informations académiques</h5>
                    <table class="min-w-full text-left text-gray-600">
                        <tbody>
                            <tr class="border-t border-gray-200">
                                <th class="py-3 px-4 font-medium text-gray-700">Année académique</th>
                                <td class="py-3 px-4">{{ $student->academic_year->name }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-3 px-4 font-medium text-gray-700">Statut</th>
                                <td class="py-3 px-4">
                                    <span class="flex items-center space-x-2">
                                        <div class="p-6 bg-white rounded-lg shadow-md">
                                            <div x-data="{ tab: 'personal' }">
                                                <!-- Tab navigation -->
                                                <div class="border-b border-gray-300">
                                                    <nav class="-mb-px flex space-x-8">
                                                        <a @click.prevent="tab = 'personal'" :class="{'border-indigo-600 text-indigo-600': tab === 'personal', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'personal'}" href="#" class="whitespace-nowrap pb-3 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Informations personnelles</a>
                                                        <a @click.prevent="tab = 'academic'" :class="{'border-indigo-600 text-indigo-600': tab === 'academic', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'academic'}" href="#" class="whitespace-nowrap pb-3 px-1 border-b-2 font-medium text-sm transition-colors duration-200">Informations académiques</a>
                                                    </nav>
                                                </div>

                                                <!-- Personal Information Tab -->
                                                <div class="mt-6" x-show="tab === 'personal'">
                                                    <h5 class="text-lg font-semibold text-gray-800 mb-4">Informations personnelles</h5>
                                                    <table class="min-w-full text-left text-gray-600">
                                                        <tbody>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Matricule</th>
                                                                <td class="py-3 px-4">{{ $student->matricule }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Nom complet</th>
                                                                <td class="py-3 px-4">{{ $student->first_name }} {{ $student->last_name }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Genre</th>
                                                                <td class="py-3 px-4">{{ $student->gender === 'female' ? 'Féminin' : 'Masculin' }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Email</th>
                                                                <td class="py-3 px-4">{{ $student->email }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Téléphone</th>
                                                                <td class="py-3 px-4">{{ $student->phone }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Adresse</th>
                                                                <td class="py-3 px-4">{{ $student->address }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Née le</th>
                                                                <td class="py-3 px-4">{{ \Carbon\Carbon::parse($student->date_of_birth)->translatedFormat('d F Y', 'en') }} à {{ $student->place_of_birth->name }} - {{ $student->nationality->nationality }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Numéro CNI</th>
                                                                <td class="py-3 px-4">{{ $student->cni_number ?? 'Non renseigné' }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Numéro d'assurance</th>
                                                                <td class="py-3 px-4">{{ $student->assurance_number ?? 'Non renseigné' }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Allergies</th>
                                                                <td class="py-3 px-4">{{ $student->alergies ?? 'Aucune' }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Accès cantine</th>
                                                                <td class="py-3 px-4">{{ $student->enable_for_canteen ? 'Oui' : 'Non' }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <!-- Academic Information Tab -->
                                                <div class="mt-6" x-show="tab === 'academic'">
                                                    <h5 class="text-lg font-semibold text-gray-800 mb-4">Informations académiques</h5>
                                                    <table class="min-w-full text-left text-gray-600">
                                                        <tbody>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Année académique</th>
                                                                <td class="py-3 px-4">{{ $student->academic_year->name }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Statut</th>
                                                                <td class="py-3 px-4">
                                                                    <span class="flex items-center space-x-2">
                                                                        <span class="font-semibold text-green-800" :class="{ 'text-red-600': !{{ $student->status }} }">
                                                                            {{ $student->status ? 'Actif' : 'Inactif' }}
                                                                        </span>
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" :stroke="$page.props.student.status ? 'green' : 'red'" class="w-5 h-5">
                                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                                                        </svg>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Classe</th>
                                                                <td class="py-3 px-4">{{ $student->classe->name }} ({{ $student->classe->level }})</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Club</th>
                                                                <td class="py-3 px-4">{{ $student->club->name }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Bus</th>
                                                                <td class="py-3 px-4">{{ $student->bus->bus_number ?? 'Non Assigné' }}</td>
                                                            </tr>
                                                            <tr class="border-t border-gray-200">
                                                                <th class="py-3 px-4 font-medium text-gray-700">Tuteur</th>
                                                                <td class="py-3 px-4">
                                                                    {{ $student->tutor->first_name . ' ' . $student->tutor->last_name }}
                                                                    <br>({{ ucfirst($student->tutor->type) }})
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" :stroke="student.status ? 'green' : 'red'" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>
                                    </span>
                                </td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-3 px-4 font-medium text-gray-700">Classe</th>
                                <td class="py-3 px-4">{{ $student->classe->name }} ({{ $student->classe->level }})</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-3 px-4 font-medium text-gray-700">Club</th>
                                <td class="py-3 px-4">{{ $student->club->name }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-3 px-4 font-medium text-gray-700">Bus</th>
                                <td class="py-3 px-4">{{ $student->bus->bus_number ?? 'Non Assigné' }}</td>
                            </tr>
                            <tr class="border-t border-gray-200">
                                <th class="py-3 px-4 font-medium text-gray-700">Tuteur</th>
                                <td class="py-3 px-4">
                                    {{ $student->tutor->first_name . ' ' . $student->tutor->last_name }}
                                    <br>({{ ucfirst($student->tutor->type) }})
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </divx-data=>
        </div>

    </div>
</div>
@endsection
