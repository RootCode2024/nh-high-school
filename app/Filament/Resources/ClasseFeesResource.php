<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\ClassesFees;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClasseFeesResource\Pages;
use App\Filament\Resources\ClasseFeesResource\RelationManagers;
use App\Models\Classe;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class ClasseFeesResource extends Resource
{
    protected static ?string $model = ClassesFees::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Frais de classe';
    protected static ?string $label = 'Frais de classe';

    public static ?string $navigationGroup ='Gestion Administrative et Financière';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('classesFees')
                    ->schema([
                        Section::make('Informations principales')
                            ->schema([
                                Select::make('academic_year_id')
                                    ->options(\App\Models\AcademicYear::pluck('name', 'id'))
                                    ->default(fn (): ?int => AcademicYear::orderByDesc('created_at')->first()?->id ?? null)
                                    ->label('Année scolaire')
                                    ->required(),

                                Select::make('classe_id')
                                    ->label('Classe')
                                    ->options(\App\Models\Classe::pluck('level', 'id'))
                                    ->searchable()
                                    ->required(),
                            ])->columns(2),

                        Section::make('Informations supplémentaires')
                            ->schema([
                                TextInput::make('school_fee_amount')
                                    ->label('Frais scolaire')
                                    ->suffix('F CFA')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(1000000)
                                    ->required(),

                                TextInput::make('transport_fee_amount')
                                    ->label('Frais de transport')
                                    ->suffix('F CFA')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(1000000)
                                    ->required(),

                                TextInput::make('registration_fee_amount')
                                    ->label('Frais d\'inscription')
                                    ->suffix('F CFA')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(1000000)
                                    ->required(),
                            ])->columns(3),
                    ])
                    ->reorderableWithButtons()
                    ->cloneable()
            ])->columns(1);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('academic_year.name')
                    ->label('Année scolaire'),
                TextColumn::make('classe.level')
                    ->label('Classe'),
                TextColumn::make('school_fee_amount')
                    ->label('Frais scolaire'),
                TextColumn::make('transport_fee_amount')
                    ->label('Frais de transport'),
                TextColumn::make('registration_fee_amount')
                    ->label('Frais d\'inscription'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('academic_year_id')
                    ->label('Année scolaire')
                    ->relationship('academic_year', 'name'),
                Tables\Filters\SelectFilter::make('classe_id')
                    ->label('Classe')
                    ->relationship('classe', 'name'),
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
            'index' => Pages\ListClasseFees::route('/'),
            'create' => Pages\CreateClasseFees::route('/create'),
            'edit' => Pages\EditClasseFees::route('/{record}/edit'),
        ];
    }
}
