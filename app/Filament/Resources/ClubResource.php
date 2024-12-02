<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Club;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ClubResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ClubResource\RelationManagers;
use App\Models\Classe;
use App\Models\Student;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;

class ClubResource extends Resource
{
    protected static ?string $model = Club::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-4';
    protected static ?string $navigationLabel = 'Activités extrascolaires';
    protected static ?string $label = 'Club';
    protected static ?string $pluralLabel = 'Clubs';

    public static ?string $navigationGroup ='Activités Extrascolaires';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Information Principale')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom du Club')
                            ->required(),
                        Select::make('created_by')
                            ->label('Président')
                            ->options(
                                Student::all()->mapWithKeys(function ($student) {

                                    $classe = \App\Models\Classe::where('id', '=', $student->classe_id)->first();
                                    $displayName = "{$student->first_name} {$student->last_name} - {$classe->level}";

                                    return [$student->id => $displayName];
                                })
                            )
                            ->searchable()
                            ->native(false),
                        DatePicker::make('since')
                            ->label('Depuis')
                            ->native(false)
                            ->displayFormat('d F Y')
                            ->hint(
                                function($state) {
                                     return \Carbon\Carbon::today()->diffForHumans($state);
                                }
                            )
                            ->default(now())
                            ->required(),
                ])->columns(3),
                Section::make('Informations Supplémentaires')
                        ->schema([
                            RichEditor::make('description')
                                ->label('Description')
                                ->nullable(),
                            FileUpload::make('image')
                                ->label('Logo')
                                ->image()
                                ->imageEditor()
                                ->nullable(),
                ])->columns(2)
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
            'index' => Pages\ListClubs::route('/'),
            'create' => Pages\CreateClub::route('/create'),
            'edit' => Pages\EditClub::route('/{record}/edit'),
        ];
    }
}
