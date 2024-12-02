<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Tutor;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TutorResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TutorResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;

class TutorResource extends Resource
{
    protected static ?string $model = Tutor::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Tuteur';
    protected static ?string $label = 'Tuteur';
    protected static ?string $pluralLabel = 'Tuteurs';

    public static ?string $navigationGroup ='Gestion des Etudiants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('uuid')
                    ->label('Identifiant unique')
                    ->default(fn (): string => (string) Str::uuid())
                    ->readOnly(),

                TextInput::make('first_name')
                    ->label('Prénom (s)')
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
                    ->label('Travail')
                    ->nullable(),

                Select::make('type')
                    ->label('Type')
                    ->native(false)
                    ->searchable()
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
                    ->searchable()
                    ->native(false)
                    ->relationship('place_of_birth', 'name')
                    ->required(),

                Select::make('nationality_id')
                    ->label('Nationalité')
                    ->searchable()
                    ->native(false)
                    ->relationship('nationality', 'nationality')
                    ->required(),

                FileUpload::make('profile_picture')
                    ->label('Photo de profil')
                    ->image()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile-picture')
                    ->label('Photo de profil'),
                Tables\Columns\TextColumn::make('first_name')
                    ->label('Nom et Prénom (s)')
                    ->formatStateUsing(fn (Tutor $record): string => "{$record->first_name} {$record->last_name}")
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Téléphone')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('work')
                    ->label('Profession')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('students')
                    ->label('Enfants')
                    ->formatStateUsing(fn (int $state): string => "$state enfant(s)")
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListTutors::route('/'),
            'create' => Pages\CreateTutor::route('/create'),
            'edit' => Pages\EditTutor::route('/{record}/edit'),
        ];
    }
}
