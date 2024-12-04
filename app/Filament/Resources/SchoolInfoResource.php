<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\SchoolInfo;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SchoolInfoResource\Pages;
use App\Filament\Resources\SchoolInfoResource\RelationManagers;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;

class SchoolInfoResource extends Resource
{
    protected static ?string $model = SchoolInfo::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Information de l\'école';
    protected static ?string $label = 'Information de l\'école';
    protected static ?string $pluralLabel = 'Informations de l\'école';

    public static ?string $navigationGroup ='Configuration Générale';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Infos de base')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nom')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),
                            TextInput::make('address')
                                ->label('Adresse')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),
                            TextInput::make('phone')
                                ->label('Téléphone')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),
                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),
                        ])->columns(4),
                    Wizard\Step::make('Fondateur (trice)')
                        ->schema([
                            TextInput::make('website')
                                ->label('Site web')
                                ->prefix('https://')
                                ->maxLength(255)
                                ->columnSpan(1),
                            TextInput::make('director_name')
                                ->label('Nom du directeur')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(1),
                            TextInput::make('devise')
                                ->label('Devise')
                                ->maxLength(255)
                                ->columnSpan(1),
                            FileUpload::make('logo')
                                ->label('Logo')
                                ->required()
                                ->image()
                                ->columnSpan(1),
                            FileUpload::make('favicon')
                                ->label('Favicon')
                                ->image()
                                ->columnSpan(1),

                            TextInput::make('director_signature')
                                ->label('Signature du directeur')
                                ->maxLength(255)
                                ->columnSpan(1),

                        ])->columns(3),
                    Wizard\Step::make('Descriptions')
                        ->schema([
                            RichEditor::make('small_description')
                                ->label('Petite description')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            RichEditor::make('long_description')
                                ->label('Description détails ')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),
                            RichEditor::make('internal_regulations')
                                ->label('Règlementation interne')
                                ->maxLength(255)
                                ->columnSpanFull(),
                        ])->columns(1),
                    Wizard\Step::make('Socials')
                        ->schema([
                            TextInput::make('facebook')
                                ->label('Facebook')
                                ->prefix('https://')
                                ->maxLength(255)
                                ->columnSpan(2),
                            TextInput::make('twitter')
                                ->label('Twitter')
                                ->prefix('https://')
                                ->maxLength(255)
                                ->columnSpan(2),
                            TextInput::make('instagram')
                                ->label('Instagram')
                                ->prefix('https://')
                                ->maxLength(255)
                                ->columnSpan(2),
                        ])
                ])->columns(1),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('address')
                    ->label('Adresse')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('phone')
                    ->label('Téléphone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('website')
                    ->label('Site web')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('favicon')
                    ->label('Favicon')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('director_name')
                    ->label('Nom du directeur')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('director_signature')
                    ->label('Signature du directeur')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('devise')
                    ->label('Devise')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('facebook')
                    ->label('Facebook')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('twitter')
                    ->label('Twitter')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('instagram')
                    ->label('Instagram')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListSchoolInfos::route('/'),
            'create' => Pages\CreateSchoolInfo::route('/create'),
            'edit' => Pages\EditSchoolInfo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
