@extends('layouts.dashboard')

@section('title', 'Matières')

@section('content')
<div class="w-full max-w-6xl mx-auto mt-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full table-auto bg-gray-100">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="py-4 px-6 text-left text-sm font-semibold">Matière</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Lundi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Mardi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Mercredi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Jeudi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Vendredi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Samedi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold">Dimanche</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($timeTable->groupBy('subject_id') as $subjectId => $entries)
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-6 text-sm text-gray-700">{{ $entries->first()->subject->name }}</td>

                        @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'] as $day)
                            <td class="py-3 px-6 text-sm text-gray-700">
                                @foreach($entries as $entry)
                                    @if($entry->day == $day)
                                        <div class="bg-blue-100 rounded-md p-2 mb-1">
                                            <span class="block font-semibold text-sm">{{ date('H:i', strtotime($entry->start_time)) }} - {{ date('H:i', strtotime($entry->end_time)) }}</span>
                                            <span class="block text-xs">Prof: {{ $entry->teacher->first_name }} {{ $entry->teacher->last_name }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
