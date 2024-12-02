<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Subject;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SubjectResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SubjectResource\RelationManagers;

class SubjectResource extends Resource
{
    protected static ?string $model = Subject::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Matiere';
    protected static ?string $label = 'Matiere';
    protected static ?string $pluralLabel = 'Matieres';

    public static ?string $navigationGroup ='Gestion des Enseignants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Nouvelle Matière')
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
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Désignation')
                    ->description(fn (Subject $record): string => strip_tags(Str::limit($record->description, 100, '...'))),
                Tables\Columns\TextColumn::make('code')
                    ->label('Code'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie'),
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
            'index' => Pages\ListSubjects::route('/'),
            'create' => Pages\CreateSubject::route('/create'),
            'edit' => Pages\EditSubject::route('/{record}/edit'),
        ];
    }
}
