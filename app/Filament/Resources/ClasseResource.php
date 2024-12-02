<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Classe;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClasseResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClasseResource\RelationManagers;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';
    protected static ?string $navigationLabel = 'Salle de classe';
    protected static ?string $label = 'Salle de classe';
    protected static ?string $pluralLabel = 'Salles de classe';

    public static ?string $navigationGroup ='Gestion des Infrastructures';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nom de la classe')
                    ->unique('classes', 'name')
                    ->required(),
                Select::make('level')
                    ->options([
                        'sixieme' => 'Sixième',
                        'cinquieme' => 'Cinquième',
                        'quatrieme' => 'Quatrième',
                        'troisieme' => 'Troisième',
                        'seconde' => 'Seconde',
                        'premiere' => 'Première',
                        'terminal' => 'Terminal',
                    ])
                    ->native(false)
                    ->required(),
                Select::make('building_id')
                    ->relationship('building', 'name')
                    ->native(false)
                    ->required(),
                TextInput::make('description')
                    ->label('Description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('level')
                    ->label('Classe')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('building.name')
                    ->label('Bâtiment')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Description'),
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
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasse::route('/create'),
            'edit' => Pages\EditClasse::route('/{record}/edit'),
        ];
    }
}
