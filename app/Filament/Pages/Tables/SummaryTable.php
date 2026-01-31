<?php

namespace App\Filament\Pages\Tables;

use App\Models\Summary;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SummaryTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(self::getQuery())
            ->columns(self::getColumns())
            ->filters(self::getFilters())
            ->recordActions(self::getRecordActions())
            ->toolbarActions(self::getToolbarActions());
    }
    private static function getQuery(): Builder
    {
        return Summary::query();
    }
    private static function getColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('voca')->label('Vocacional')->sortable()->searchable(),
            TextColumn::make('p05')->label('P05')->sortable()->searchable(),
            TextColumn::make('p06')->label('P06')->sortable()->searchable(),
            TextColumn::make('p07')->label('P07')->sortable()->searchable(),
            TextColumn::make('p08')->label('P08')->sortable()->searchable(),
            TextColumn::make('p09')->label('P09')->sortable()->searchable(),
            TextColumn::make('p10')->label('P10')->sortable()->searchable(),
        ];
    }
    public static function getFilters(): array
    {
        return [];
    }
    public static function getRecordActions(): array
    {
        return [];
    }
    public static function getToolbarActions(): array
    {
        return [];
    }

}
