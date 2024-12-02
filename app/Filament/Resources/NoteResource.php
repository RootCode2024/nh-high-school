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

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $navigationLabel = 'Notes d\'evaluation';
    protected static ?string $label = 'Note d\'evaluation';
    protected static ?string $pluralLabel = 'Notes d\'evaluation';

    public static ?string $navigationGroup ='Gestion des Etudiants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('academic_year_id')
                    ->label('Année Académique')

                    ->default(fn (): int => AcademicYear::orderByDesc('created_at')->first()->id)
                    ->relationship('academic_year', 'name')
                    ->required(),

                Select::make('student_id')
                    ->label('Etudiant')
                    ->native(false)
                    ->options(function () {
                        return \App\Models\Student::query()
                            ->selectRaw("CONCAT(first_name, ' ', last_name) AS full_name, id")
                            ->orderBy('full_name') // Order by the full name
                            ->pluck('full_name', 'id'); // Use `full_name` as the display value and `id` as the value
                    })
                    ->required(),


                // Select for subject
                Select::make('subject_id')
                    ->label('Matière')
                    ->native(false)
                    ->relationship('subject', 'name') // 'name' is the display value for Subject
                    ->required(),

                // Select for period
                Select::make('period_id')
                    ->label('Periode')
                    ->native(false)
                    ->relationship('period', 'name')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->label('Désignation')
                            ->required()
                            ->maxLength(55),
                        Select::make('academic_year_id')
                            ->label('Année académic')
                            ->options(AcademicYear::all()->pluck('name', 'id'))
                            ->searchable()
                            ->native(false),
                    ])
                    ->required(),

                // Select for class
                Select::make('classe_id')
                    ->label('Classe')
                    ->native(false)
                    ->relationship('classe', 'name') // 'name' is the display value for Classe
                    ->required(),

                // Select for exam type
                Select::make('exam_type_id')
                    ->label('Type d\'Examen')
                    ->native(false)
                    ->relationship('examType', 'name') // 'name' is the display value for ExamType
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            //
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
