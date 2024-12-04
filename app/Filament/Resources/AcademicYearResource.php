<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\Boolean;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AcademicYearResource\Pages;
use App\Filament\Resources\AcademicYearResource\RelationManagers;
use Filament\Tables\Columns\ToggleColumn;

class AcademicYearResource extends Resource
{
    protected static ?string $model = AcademicYear::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Année Académique';
    protected static ?string $label = 'Année Académique';
    protected static ?string $pluralLabel = 'Années Académiques';

    public static ?string $navigationGroup ='Gestion Académique';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Année scolaire')
                    ->hint('Ex: 2012-2013')
                    ->required()
                    ->maxLength(55),

                DatePicker::make('start_date')
                    ->label('Date de debut')
                    ->default(now())
                    ->displayFormat('d F Y')
                    ->native(false)
                    ->required(),

                DatePicker::make('end_date')
                    ->label('Date de fin')
                    ->default(now()->addYear())
                    ->displayFormat('d F Y')
                    ->native(false)
                    ->required(),

                Toggle::make('status')
                    ->label('Status')
                    ->default(true)
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check-badge')
                    ->offIcon('heroicon-o-x-mark')
                    ->inline(false)
                    ->required(),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->label('Année scolaire')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->label('Date de debut')
                    ->date('d F Y')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->label('Date de fin')
                    ->date('d F Y')
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger')
                    ->onIcon('heroicon-o-check-badge')
                    ->offIcon('heroicon-o-x-mark'),
                TextColumn::make('created_at')
                    ->label('Date de création')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Date de mise à jour')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
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
            'index' => Pages\ListAcademicYears::route('/'),
            'create' => Pages\CreateAcademicYear::route('/create'),
            'edit' => Pages\EditAcademicYear::route('/{record}/edit'),
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
