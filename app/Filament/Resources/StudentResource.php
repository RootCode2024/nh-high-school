<?php

namespace App\Filament\Resources;

use App\Models\Bus;
use Filament\Forms;
use App\Models\Club;
use App\Models\User;
use Filament\Tables;
use App\Models\Tutor;
use App\Models\Classe;
use App\Models\Country;
use App\Models\Student;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\StudentResource\Pages;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Etudiants';
    protected static ?string $label = 'Etudiant';
    protected static ?string $pluralLabel = 'Etudiants';

    public static ?string $navigationGroup ='Gestion des Etudiants';

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
                        TextInput::make('matricule')
                            ->label('Matricule')
                            ->default(fn (): string => (string) 'ST-' . Str::random(8) . '-' . now()->year)
                            ->unique(ignoreRecord: true)
                            ->readOnly()
                            ->required(),
                ])
                ->columns(3),

                // Personal Information Section
                Section::make('Informations personnelles')
                    ->schema([
                        Section::make()
                            ->schema([
                                FileUpload::make('profile-picture')
                                    ->label('Photo de profil')
                                    ->image()
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
                                    Select::make('tutor_id')
                                    ->label('Tuteur')
                                    ->options(
                                        Tutor::all()->mapWithKeys(function ($tutor) {

                                            $displayName = "{$tutor->first_name} {$tutor->last_name} - {$tutor->work}";
                                            return [$tutor->id => $displayName];
                                        })
                                    )
                                    ->searchable()
                                    ->native(false)
                                    ->createOptionForm([
                                        TextInput::make('uuid')
                                            ->label('Identifiant unique')
                                            ->default(fn (): string => (string) Str::uuid())
                                            ->readOnly(),
                                        TextInput::make('first_name')
                                            ->label('Prénom(s)')
                                            ->required(),
                                        TextInput::make('last_name')
                                            ->label('Nom')
                                            ->required(),
                                        TextInput::make('phone')
                                            ->label('Téléphone')
                                            ->unique()
                                            ->required(),
                                        TextInput::make('email')
                                            ->label('Email')
                                            ->unique()
                                            ->email()
                                            ->required(),
                                        TextInput::make('cni_number')
                                            ->label('Numéro CNI')
                                            ->unique()
                                            ->required(),
                                        TextInput::make('work')
                                            ->label('Profession')
                                            ->nullable(),
                                        Select::make('type')
                                            ->label('Type')
                                            ->options([
                                                'father' => 'Père',
                                                'mother' => 'Mère',
                                                'sister' => 'Sœur',
                                                'brother' => 'Frère',
                                                'uncle' => 'Oncle',
                                                'aunt' => 'Tante',
                                                'grand_father' => 'Grand-père',
                                                'grand_mother' => 'Grand-mère',
                                            ])
                                            ->required(),
                                        DatePicker::make('date_of_birth')
                                            ->label('Date de naissance')
                                            ->required(),
                                        Select::make('place_of_birth_id')
                                            ->label('Lieu de naissance')
                                            ->options(Country::all()->pluck('name', 'id'))
                                            ->required(),
                                        Select::make('nationality_id')
                                            ->label('Nationalité')
                                            ->options(Country::all()->pluck('nationality', 'id'))
                                            ->required(),
                                        FileUpload::make('profile-picture')
                                            ->label('Photo de profil')
                                            ->image()
                                            ->nullable(),
                                    ])
                                    ->createOptionUsing(function ($data) {
                                        $tutor = Tutor::create([
                                            'uuid' => $data['uuid'],
                                            'first_name' => $data['first_name'],
                                            'last_name' => $data['last_name'],
                                            'phone' => $data['phone'],
                                            'email' => $data['email'],
                                            'cni_number' => $data['cni_number'],
                                            'work' => $data['work'],
                                            'type' => $data['type'],
                                            'date_of_birth' => $data['date_of_birth'],
                                            'place_of_birth_id' => $data['place_of_birth_id'],
                                            'nationality_id' => $data['nationality_id'],
                                            'profile_picture' => $data['profile-picture'] ?? null,
                                        ]);
                                        return $tutor->id;
                                    })
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

                // Transport & Classe Section
                Section::make('Transport & Classe')
                    ->schema([
                        Select::make('bus_id')
                            ->label('Bus')
                            ->options(Bus::all()->pluck('bus_number', 'id'))
                            ->searchable()
                            ->nullable(),
                        Select::make('classe_id')
                            ->label('Classe')
                            ->options(Classe::all()->pluck('level', 'id'))
                            ->searchable()
                            ->required(),
                        Select::make('club_id')
                            ->label('Club')
                            ->options(Club::all()->pluck('name', 'id'))
                            ->searchable()
                            ->default(fn (): int => Club::orderByDesc('created_at')->first()->id)
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nom du Club')
                                    ->required(),
                                RichEditor::make('description')
                                    ->label('Description')
                                    ->nullable(),
                                FileUpload::make('image')
                                    ->label('Logo')
                                    ->image()
                                    ->imageEditor()
                                    ->nullable(),
                                TextInput::make('created_by')
                                    ->label('Créé par')
                                    ->default('1')
                                    ->numeric(),
                                DatePicker::make('since')
                                    ->label('Depuis')
                                    ->native(false)
                                    ->default(now())
                                    ->required(),
                            ])
                            ->createOptionUsing(function (array $data) {
                                $club = Club::create([
                                    'name' => $data['name'],
                                    'description' => $data['description'],
                                    'image' => $data['image'],
                                    'created_by' => $data['created_by'],
                                    'since' => $data['since'],
                                ]);
                                return $club->id;
                            }),
                        Toggle::make('status')
                            ->label('Statut')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(true),
                ])
                ->columns(3),

                // Health & Nutrition
                Section::make('Santé & Alimentation')
                    ->schema([
                        TextInput::make('assurance_number')
                            ->label('Numéro d\'assurance')
                            ->nullable(),
                        TextInput::make('alergies')
                            ->label('Alergies')
                            ->nullable(),
                        Toggle::make('enable_for_canteen')
                            ->label('Autoriser pour la cantine')
                            ->onColor('success')
                            ->offColor('danger')
                            ->default(false),
                ])
                ->columns(3),

                    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile-picture')
                    ->circular()
                    ->defaultImageUrl('/assets/default-profile.png')
                    ->label('Photo'),
                TextColumn::make('full_name')
                    ->label('Nom et Prénom (s)')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn (string $state): string => "{$state}"),

                TextColumn::make('matricule')
                    ->label('Matricule')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('Téléphone')
                    ->sortable()
                    ->searchable(),

                IconColumn::make('status')
                    ->label('Statut')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tutor_id')
                    ->label('Tuteur')
                    ->options(
                        Tutor::all()->mapWithKeys(function ($tutor) {
                            return [$tutor->id => "{$tutor->first_name} {$tutor->last_name}"];
                        })
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
                ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define relation managers here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
