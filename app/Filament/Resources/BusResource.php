<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusResource\Pages;
use App\Filament\Resources\BusResource\RelationManagers;
use App\Models\Bus;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BusResource extends Resource
{
    protected static ?string $model = Bus::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Bus';
    protected static ?string $label = 'Bus';
    protected static ?string $pluralLabel = 'Buses';

    public static ?string $navigationGroup ='Gestion des Infrastructures';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                    ->schema([
                        TextInput::make('bus_number')
                            ->label('Numéro de bus')
                            ->integer()
                            ->required(),
                        TextInput::make('capacity')
                            ->label('Capacité')
                            ->integer()
                            ->required(),
                        Toggle::make('status')
                            ->label('Statut')
                            ->onColor('success')
                            ->offColor('danger')
                            ->required(),
                    ])->columns(3),
                TextInput::make('route')
                    ->label('Itinéraire')
                    ->required(),
                Section::make('')
                    ->schema([
                        TextInput::make('driver_fullname')
                            ->label('Nom du chauffeur')
                            ->required(),
                        TextInput::make('driver_phone')
                            ->label('Téléphone du chauffeur')
                            ->required(),
                        TextInput::make('driver_cni_number')
                            ->label('Numéro de CNI du chauffeur')
                            ->required(),
                    ])->columns(3),
                    Section::make('')
                        ->schema([
                            TextInput::make('helper_fullname')
                                ->label('Nom du second chauffeur')
                                ->required(),
                            TextInput::make('helper_phone')
                                ->label('Téléphone du second chauffeur')
                                ->required(),
                            TextInput::make('helper_cni_number')
                                ->label('Numéro de CNI du second chauffeur')
                                ->required(),
                        ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('')
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
            'index' => Pages\ListBuses::route('/'),
            'create' => Pages\CreateBus::route('/create'),
            'edit' => Pages\EditBus::route('/{record}/edit'),
        ];
    }
}
