<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Note;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\NoteResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Models\AcademicYear;
use App\Models\ExamType;
use App\Models\Student;
use App\Models\Subject;
use Filament\Forms\Components\Section;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationLabel = 'Notes d\'évaluation';
    protected static ?string $label = 'Note d\'évaluation';
    protected static ?string $pluralLabel = 'Notes d\'évaluation';

    public static ?string $navigationGroup = 'Gestion des Étudiants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        Select::make('academic_year_id')
                            ->label('Année Académique')
                            ->default(fn (): ?int => AcademicYear::orderByDesc('created_at')->first()?->id)
                            ->relationship('academic_year', 'name')
                            ->required(),

                        Select::make('period_id')
                            ->label('Période')
                            ->native(false)
                            ->relationship('period', 'name')
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Désignation')
                                    ->required()
                                    ->maxLength(55),
                                Select::make('academic_year_id')
                                    ->label('Année académique')
                                    ->options(AcademicYear::all()->pluck('name', 'id'))
                                    ->searchable()
                                    ->native(false),
                            ])
                            ->required(),

                            TextInput::make('classe_level')
                            ->label('Classe')
                            ->disabled()
                            ->default('Non défini')
                            ->dehydrated(false), // Empêche l'envoi de ce champ lors de la sauvegarde
                        
                        TextInput::make('classe_id')
                            ->label('Classe ID'),

                    ])->columns(3),

                Section::make('')
                    ->schema([
                        Select::make('student_id')
                            ->label('Étudiant')
                            ->options(
                                Student::all()->mapWithKeys(fn ($student) => [
                                    $student->id => "{$student->last_name} {$student->first_name}"
                                ])
                            )
                            ->required()
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(function (callable $set, $state) {
                                $student = Student::find($state);
                                if ($student) {
                                    $set('classe_id', $student->classe->id ?? 0); // Assurez-vous que 0 est une valeur par défaut acceptable
                                    $set('classe_level', $student->classe->level ?? 'Non défini');
                                }
                            }),

                        Select::make('subject_id')
                            ->label('Matière')
                            ->relationship('subject', 'name')
                            ->required(),

                        Select::make('exam_type_id')
                            ->label('Type d\'Examen')
                            ->relationship('examType', 'name')
                            ->required(),
                    ])->columns(3),

                Section::make('')
                    ->schema([
                        DatePicker::make('day')
                            ->label('Jour de l\'Évaluation')
                            ->native(false)
                            ->displayFormat('d F Y')
                            ->default(now()),

                        TextInput::make('note')
                            ->label('Note')
                            ->numeric()
                            ->step(0.01)
                            ->required()
                            ->placeholder('Exemple : 12.50')
                            ->maxValue(20.00)
                            ->minValue(0)
                            ->default(0.00),

                        TextInput::make('max_note')
                            ->label('Note maximale')
                            ->numeric()
                            ->step(0.01)
                            ->required()
                            ->placeholder('Exemple : 20')
                            ->maxValue(20.00)
                            ->minValue(5)
                            ->default(20.00),

                        TextInput::make('comment')
                            ->label('Commentaire')
                            ->nullable()
                            ->maxLength(255),
                    ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.first_name')
                    ->label('Étudiant')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Matière')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('note')
                    ->label('Note')
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_note')
                    ->label('Note Max.')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relation managers here if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }
}
