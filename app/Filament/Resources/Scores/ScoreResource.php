<?php

namespace App\Filament\Resources\Scores;

use App\Filament\Resources\Scores\Pages\ManageScores;
use App\Models\Score;
use BackedEnum;
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
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
