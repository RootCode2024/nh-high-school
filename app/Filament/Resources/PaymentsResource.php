<?php

namespace App\Filament\Resources;

use DateTime;
use Filament\Forms;
use Filament\Tables;
use App\Models\Payment;
use App\Models\Student;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\Resources\PaymentsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PaymentsResource\RelationManagers;
use App\Models\Classe;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;

class PaymentsResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Paiement';
    protected static ?string $label = 'Paiement';
    protected static ?string $pluralLabel = 'Paiements';

    public static ?string $navigationGroup ='Gestion Administrative et Financière';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    Select::make('academic_year_id')
                        ->label('Année scolaire')
                        ->native(false)
                        ->default(fn (): int => AcademicYear::orderByDesc('created_at')->first()->id)
                        ->relationship('academic_year', 'name')
                        ->required()
                        ->columnSpan(1),
                    Select::make('period_id')
                        ->label('Période')
                        ->native(false)
                        ->relationship('period', 'name')
                        ->required()
                        ->columnSpan(1),

                    Select::make('student_id')
                        ->label('Etudiant')
                        ->native(false)
                        ->searchable()
                        ->options(
                        Student::all()->mapWithKeys(function ($student) {

                            $classe = \App\Models\Classe::where('id', '=', $student->classe_id)->first();
                            $displayName = "{$student->first_name} {$student->last_name} - {$classe->level}";

                            return [$student->id => $displayName];
                        })
                    )
                    ->required()
                    ->columnSpan(1),
                ])->columns(3),

                DateTimePicker::make('date')
                    ->label('Date')
                    ->native(false)
                    ->required(),
                Section::make('Informations de la Transaction')
                    ->schema([
                        Select::make('payment_mode')
                            ->label('Mode de paiement')
                            ->native(false)
                            ->options([
                                'cash' => 'Espèce',
                                'wave' => 'Wave',
                                'bank' => 'Virement Banque',
                                'OM' => 'Orange Money',
                            ])
                            ->required(),
                        Select::make('payment_for')
                            ->label('Motif')
                            ->native(false)
                            ->options([
                                'registration_fees' => 'Frais d\'inscription',
                                'bus_fees' => 'Transport (Bus)',
                                'school_fees' => 'Frais scolaire',
                                'other' => 'Autre',
                            ])
                            ->required(),
                        TextInput::make('amount')
                            ->label('Montant')
                            ->numeric()
                            ->suffix('F CFA')
                            ->required(),
                    ])->columns(3),

                RichEditor::make('comment')
                    ->label('Informations Supplementaires')
                    ->nullable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('academic_year.name')
                    ->label('Année Scolaire')
                    ->sortable(),

                TextColumn::make('period.name')
                    ->label('Période')
                    ->sortable(),
                TextColumn::make('student_id')
                    ->label('Elève')
                    ->searchable()
                    ->formatStateUsing(
                        function ($state)
                        {
                            $student = Student::where('id', '=', $state)->first();
                            $classe = Classe::where('id', '=', $student->classe_id)->first();
                            return $student->first_name . ' ' . $student->last_name . ' ' . $classe->level;
                        }
                    )
                    ->sortable(),

                TextColumn::make('amount')
                    ->label('Montant')
                    ->money('CFA')
                    ->description(fn($record) => Payment::payment($record))
                    ->sortable(),
                TextColumn::make('payment_mode')
                    ->label('Mode de Paiement'),
                TextColumn::make('date')
                    ->date('d F Y')
                    ->searchable()
                    ->sortable()
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayments::route('/create'),
            'edit' => Pages\EditPayments::route('/{record}/edit'),
        ];
    }
}
