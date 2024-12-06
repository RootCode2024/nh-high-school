<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeacherResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeacherResource\RelationManagers;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Professeur';
    protected static ?string $label = 'Professeur';
    protected static ?string $pluralLabel = 'Professeurs';

    public static ?string $navigationGroup ='Gestion des Enseignants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Main Information Section
                Section::make('Informations principales')
                    ->schema([
                        Select::make('academic_year_id')
                            ->label('Année Scolaire')
                            ->options(AcademicYear::orderByDesc('created_at')->pluck('name', 'id'))
                            ->default(fn (): int => AcademicYear::orderByDesc('created_at')->first()->id)
                            ->searchable()
                            ->required(),
                        TextInput::make('uuid')
                            ->label('Identifiant unique')
                            ->readOnly()
                            ->default(fn (): string => (string) Str::uuid()),
                        Toggle::make('status')
                            ->label('Status')
                            ->default(true)
                            ->onIcon('heroicon-s-check')
                            ->offIcon('heroicon-s-x-mark')
                            ->onColor('success')
                            ->offColor('danger')
                            ->required(),
                ])
                ->columns(3),

                // Personal Information Section
                Section::make('Informations personnelles')
                    ->schema([
                        Section::make()
                            ->schema([
                                FileUpload::make('profile_picture')
                                    ->label('Photo de profil')
                                    ->image()
                                    ->disk('public')
                                    ->directory('teachers')
                                    ->downloadable()
                                    ->nullable(),
                            ])->columnSpan(1),
                        Section::make()
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('Prénom (s)')
                                    ->required(),
                                TextInput::make('last_name')
                                    ->label('Nom')
                                    ->required(),
                                TextInput::make('speciality')
                                    ->label('Spécialité')
                                    ->required(),

                            ])->columnSpan(1),

                ])
                ->columns(2),

                // Student Details Section
                Section::make('Informations de Naissance')
                    ->schema([
                        DatePicker::make('date_of_birth')
                            ->label('Date de naissance')
                            ->native(false)
                            ->displayFormat('d F Y') // Assuming you want the format day/month/year
                            ->required(),
                        Select::make('place_of_birth_id')
                            ->label('Lieu de naissance')
                            ->options(Country::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),
                        Select::make('nationality_id')
                            ->label('Nationalité')
                            ->options(Country::all()->pluck('nationality', 'id'))
                            ->searchable()
                            ->required(),
                ])
                ->columns(3),

                // Student Details Section
                Section::make('Informations supplémentaires')
                    ->schema([

                    TextInput::make('cni_number')
                        ->label('Numéro de la CNI')
                        ->nullable(),
                    TextInput::make('email')
                        ->label('Email')
                        ->unique(ignoreRecord: true)
                        ->email()
                        ->required(),
                    TextInput::make('phone')
                        ->label('Téléphone')
                        ->unique()
                        ->required(),
                ])
                ->columns(3),

                // Embauche & Paiements
                Section::make('Embauche & Paiements')
                    ->schema([
                        DatePicker::make('hire_date')
                            ->label('Depuis')
                            ->native(false)
                            ->displayFormat('d F Y')
                            ->default(now())
                            ->required(),
                        DatePicker::make('date_of_first_appointment')
                            ->label('Entrée en fonction')
                            ->native(false)
                            ->displayFormat('d F Y')
                            ->default(now())
                                ->required(),
                        TextInput::make('current_salary')
                            ->label('Salaire actuel')
                            ->numeric()
                            ->suffix('F CFA')
                            ->required(),
                ])
                ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_picture')
                    ->circular()
                    ->defaultImageUrl('/assets/default-profile.png')
                    ->label('Photo'),
                TextColumn::make('full_name')
                    ->label('Nom et Prénom (s)')
                    ->sortable()
                    ->searchable(query: function ($query, $search) {
                        $query->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', "%{$search}%");
                    })
                    ->formatStateUsing(fn (string $state): string => "{$state}"),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Téléphone')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('current_salary')
                    ->label('Salaire actuel')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => number_format((int) $state, 0, '', ' ') . ' CFA')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
