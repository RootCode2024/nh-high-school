@extends('layouts.dashboard')

@section('title', 'Matières')

@section('content')
<div classe="w-4xl mx-6 mt-5">
    <table class="mx-auto bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b border-gray-300 bg-gray-200 text-left text-sm leading-4 text-gray-600 tracking-wider">Matières</th>
                <th class="py-2 px-4 border-b border-gray-300 bg-gray-200 text-left text-sm leading-4 text-gray-600 tracking-wider">Professeur</th>
                <th class="py-2 px-4 border-b border-gray-300 bg-gray-200 text-left text-sm leading-4 text-gray-600 tracking-wider">Jours</th>
                <th class="py-2 px-4 border-b border-gray-300 bg-gray-200 text-left text-sm leading-4 text-gray-600 tracking-wider">Heures</th>
            </tr>
        </thead>
        <tbody>
            @foreach($timeTable as $entry)
                <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                    <td class="py-2 px-4 border-b border-gray-300 text-sm text-gray-700">
                    {{ $entry->matiere($entry->subject_id)->name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-sm text-gray-700">{{ $entry->teacher->first_name }} {{ $entry->teacher->last_name }}</td>
                    <td class="py-2 px-4 border-b border-gray-300 text-sm text-gray-700">
                        @switch($entry->day)
                            @case('monday')
                                Lundi
                                @break
                            @case('tuesday')
                                Mardi
                                @break
                            @case('wednesday')
                                Mercredi
                                @break
                            @case('thursday')
                                Jeudi
                                @break
                            @case('friday')
                                Vendredi
                                @break
                            @case('saturday')
                                Samedi
                                @break
                            @case('sunday')
                                Dimanche
                                @break
                            @default
                                {{ ucfirst($entry->day) }}
                        @endswitch
                    </td>
                    <td class="py-2 px-4 border-b border-gray-300 text-sm text-gray-700">
                        {{ date('H:i', strtotime($entry->start_time)) }} - {{ date('H:i', strtotime($entry->end_time)) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
