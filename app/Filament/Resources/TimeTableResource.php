<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Subject;
use Filament\Forms\Form;
use App\Models\TimeTable;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TimeTableResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TimeTableResource\RelationManagers;

class TimeTableResource extends Resource
{
    protected static ?string $model = TimeTable::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Emploie du temps';
    protected static ?string $label = 'Emploie du temps';
    protected static ?string $pluralLabel = 'Emplois du temps';

    public static ?string $navigationGroup ='Gestion Académique';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations principales')
                    ->schema([
                    Select::make('academic_year_id')
                        ->label('Année scolaire')
                        ->native(false)
                        ->relationship('academicYear', 'name')
                        ->default(fn (): int => AcademicYear::orderByDesc('created_at')->first()->id)
                        ->required(),
                    Select::make('period_id')
                        ->label('Période')
                        ->native(false)
                        ->relationship('period', 'name')
                        ->required(),
                ])
                ->columns(2),

                Section::make('Informations supplémentaires')
                    ->schema([
                    Select::make('classe_id')
                        ->label('Classe')
                        ->native(false)
                        ->relationship('classe', 'level')
                        ->required(),

                        Select::make('subject_id')
                        ->label('Matière')
                        ->options(Subject::all()->pluck('name', 'id'))
                        ->searchable()
                        ->createOptionForm([
                            Section::make('Créer une Nouvelle Matière')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Désignation')
                                        ->required(),
                                    TextInput::make('code')
                                        ->label('Code'),
                                    Select::make('category')
                                        ->label('Categorie')
                                        ->native(false)
                                        ->default('science')
                                        ->options([
                                            'science' => 'SCIENCE',
                                            'literal' => 'LITERAL',
                                            'art' => 'ARTS',
                                            'sport' => 'SPORT',
                                        ])
                                        ->required(),
                                ])->columns(3),

                            RichEditor::make('description')
                                ->label('Description')
                                ->nullable(),

                        ])
                        ->createOptionUsing(function (array $data) {
                            $subject = Subject::create([
                                'name' => $data['name'],
                                'code' => $data['code'],
                                'category' => $data['category'],
                                'description' => $data['description'],
                            ]);
                            return $subject->id;
                        }),
                    Select::make('teacher_id')
                        ->label('Enseignant')
                        ->native(false)
                        ->relationship('teacher', 'first_name')
                        ->required(),
                ])
                ->columns(3),

                Repeater::make('Informations Horaires')
                    ->schema([
                        Section::make('Informations Horaires')
                            ->schema([
                                TextInput::make('coefficient')
                                    ->label('Coefficient')
                                    ->default(1)
                                    ->numeric()
                                    ->required(),
                                Select::make('day')
                                    ->label('Jours')
                                    ->placeholder('Jours')
                                    ->native(false)
                                    ->options([
                                        'monday' => 'Lundi',
                                        'tuesday' => 'Mardi',
                                        'wednesday' => 'Mercredi',
                                        'thursday' => 'Jeudi',
                                        'friday' => 'Vendredi',
                                        'saturday' => 'Samedi',
                                        'sunday' => 'Dimanche'
                                        ])
                                    ->required(),
                                TimePicker::make('start_time')
                                    ->label('Heure de debut')
                                    ->seconds(false)
                                    ->required(),
                                TimePicker::make('end_time')
                                    ->label('Heure de fin')
                                    ->seconds(false)
                                    ->required(),
                        ])
                        ->columns(4),
                ])->columns(1)
            ])->columns(1);
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
            'index' => Pages\ListTimeTables::route('/'),
            'create' => Pages\CreateTimeTable::route('/create'),
            'edit' => Pages\EditTimeTable::route('/{record}/edit'),
        ];
    }
}
