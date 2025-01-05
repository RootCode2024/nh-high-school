@extends('layouts.dashboardTeacher')

@section('content')
<div class="container mx-auto p-6" x-data="notesData">
    <!-- En-tête -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ $schoolInfo->name }}</h1>
        <h2 class="text-xl text-gray-600">Gestion des notes - {{ $teacher->name }}</h2>
    </div>

    <!-- Liste des classes -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold mb-4">Liste des classes</h3>
        <div class="grid grid-cols-2 gap-4">
            <template x-if="classes.length > 0">
                <template x-for="(classe, index) in classes" :key="index">
                    <button
                        @click="selectClass(classe)"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        x-text="classe">
                    </button>
                </template>
            </template>
        </div>
    </div>

    <!-- Liste des élèves pour la classe sélectionnée -->
    <div x-show="selectedClass" class="mt-6">
        <h3 class="text-lg font-semibold mb-4" x-text="'Classe sélectionnée : ' + selectedClass"></h3>

        <!-- Liste des élèves -->
        <div class="mb-6">
            <template x-if="students.length > 0">
                <ul class="list-none">
                    <template x-for="(student, index) in students" :key="index">
                        <li class="mb-2 flex items-center">
                            <span class="w-1/2" x-text="student.name"></span>
                            <input
                                type="number"
                                x-model="student.note"
                                class="border border-gray-300 rounded px-2 py-1 w-1/4"
                                placeholder="Note">
                        </li>
                    </template>
                </ul>
                <button
                    @click="saveNotes()"
                    class="mt-4 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Enregistrer les notes
                </button>
            </template>
            <p x-show="students.length === 0" class="text-red-500">Aucun élève trouvé pour cette classe.</p>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('notesData', () => ({
            classes: @json($classess), // Liste des classes (injectée depuis le backend)
            selectedClass: null,
            students: [],

            selectClass(classe) {
                this.selectedClass = classe;
                this.fetchStudents(classe);
            },

            fetchStudents(classe) {
                // Remplacez l'URL par celle de votre API pour récupérer les élèves
                fetch(`/api/students?class=${classe}`)
                    .then(response => response.json())
                    .then(data => {
                        this.students = data.map(student => ({
                            id: student.id,
                            name: student.name,
                            note: null, // Initialise les notes à null
                        }));
                    })
                    .catch(error => console.error('Erreur lors de la récupération des élèves:', error));
            },

            saveNotes() {
                // Prépare les données pour l'envoi
                const notesData = this.students.map(student => ({
                    student_id: student.id,
                    note: student.note,
                }));

                // Envoie les notes au backend
                fetch('/api/save-notes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        class: this.selectedClass,
                        notes: notesData,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    alert('Notes enregistrées avec succès!');
                })
                .catch(error => {
                    console.error('Erreur lors de l\'enregistrement des notes:', error);
                });
            },
        }));
    });

</script>


