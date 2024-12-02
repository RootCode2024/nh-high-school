<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Attendance;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Faker\Provider\ar_EG\Text;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\DateTimePicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Absences';
    protected static ?string $label = 'Absence';
    protected static ?string $pluralLabel = 'Absences';

    public static ?string $navigationGroup ='Gestion des Etudiants';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informations principales')
                    ->schema([
                        Select::make('academic_year_id')
                            ->label('Année scolaire')
                            ->native(false)
                            ->default(fn (): int => AcademicYear::orderByDesc('created_at')->first()->id)
                            ->relationship('academic_year', 'name')
                            ->required(),
                        Select::make('period_id')
                            ->label('Période')
                            ->native(false)
                            ->relationship('period', 'name')
                            ->required(),
                        DatePicker::make('day')
                            ->label('Jour')
                            ->native(false)
                            ->required(),
                    ])
                    ->columns(3),
                Select::make('student_id')
                    ->label('Etudiant')
                    ->native(false)
                    ->relationship('student', 'first_name')
                    ->required(),
                Select::make('subject_id')
                    ->label('Matière')
                    ->native(false)
                    ->relationship('subject', 'name')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('academic_year.name')
                    ->label('Année scolaire')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Etudiant')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->label('Matière')
                    ->searchable(),
                Tables\Columns\TextColumn::make('period.name')
                    ->label('Période')
                    ->searchable(),
                Tables\Columns\TextColumn::make('day')
                    ->label('Jour')
                    ->date(),
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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
