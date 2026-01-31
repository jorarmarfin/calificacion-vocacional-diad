<?php

namespace App\Filament\Resources\Scores;

use App\Filament\Resources\Scores\Pages\ManageScores;
use App\Models\Score;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ScoreResource extends Resource
{
    protected static ?string $model = Score::class;
    protected static ?string $modelLabel= 'Puntaje';
    protected static ?string $pluralModelLabel = 'Puntajes';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calculator;

    protected static ?string $recordTitleAttribute = 'data';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                TextInput::make('data')
                    ->required(),
                TextInput::make('voca')
                    ->required(),
                TextInput::make('question')
                    ->required(),
                TextInput::make('note')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('data')
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('data')
                    ->searchable(),
                TextColumn::make('voca')
                    ->searchable(),
                TextColumn::make('question')
                    ->searchable(),
                TextColumn::make('note')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('question')
                    ->label('Pregunta')
                    ->options([
                        '05' => '05',
                        '06' => '06',
                        '07' => '07',
                        '08' => '08',
                        '09' => '09',
                        '10' => '10',
                    ]),

            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                Action::make('imprimir_img5')
                    ->label('Acta 5')
                    ->color('success')
                    ->url(fn() => route('report.grade.print',['id'=>5]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),
                //6,7,8,9,10
                Action::make('imprimir_img6')
                    ->label('Acta 6')
                    ->color('success')
                    ->url(fn() => route('report.grade.print',['id'=>6]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),
                Action::make('imprimir_img7')
                    ->label('Acta 7')
                    ->color('success')
                    ->url(fn() => route('report.grade.print',['id'=>7]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),
                Action::make('imprimir_img8')
                    ->label('Acta 8')
                    ->color('success')
                    ->url(fn() => route('report.grade.print',['id'=>8]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),
                Action::make('imprimir_img9')
                    ->label('Acta 9')
                    ->color('success')
                    ->url(fn() => route('report.grade.print',['id'=>9]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),
                Action::make('imprimir_img10')
                    ->label('Acta 10')
                    ->color('success')
                    ->url(fn() => route('report.grade.print',['id'=>10]))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-printer'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageScores::route('/'),
        ];
    }



}
