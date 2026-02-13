<?php

namespace App\Filament\Grading\Pages\Tables;

use App\Models\Score;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ScoreTable
{
    public static function configure(Table $table,$pregunta): Table
    {
        return $table
            ->query(self::getQuery($pregunta))
            ->columns(self::getColumns())
            ->filters(self::getFilters())
            ->recordActions(self::getRecordActions())
            ->toolbarActions(self::getToolbarActions())
            ->paginated([100, 150, 200, 250, 'all']);
    }
    private static function getQuery($pregunta): Builder
    {
        return Score::query()->where('question',str_pad($pregunta,2,0,STR_PAD_LEFT))->orderByDesc('id');
    }
    public static function getColumns(): array
    {
        return [
            TextColumn::make('id'),
            TextColumn::make('voca')->label('Voca')->sortable()->searchable(),
            TextColumn::make('question')->label('Pregunta')->sortable()->searchable(),
            TextColumn::make('note')->label('Nota')->sortable()->searchable(),
            TextColumn::make('data')->label('Datos')->toggleable(isToggledHiddenByDefault:true),
            TextColumn::make('created_at')->label('Creado')->dateTime()->toggleable(isToggledHiddenByDefault: true)->searchable(),
            TextColumn::make('updated_at')->label('Actualizado')->dateTime()->toggleable(isToggledHiddenByDefault: true)->searchable(),
        ];
    }
    public static function getFilters(): array
    {
        return [
            //
        ];
    }
    public static function getRecordActions(): array
    {
        return [
//            Action::make('edit')
//                ->label('Editar')
//                ->icon('heroicon-m-pencil-square')
//                ->modalHeading('Editar puntaje')
//                ->schema([
//                    TextInput::make('note')
//                        ->label('Nota')
//                        ->numeric()
//                        ->required(),
//                ])
//                // 👇 Pre-llenar el modal con datos del record
//                ->fillForm(fn ($record) => [
//                    'note' => $record->note,
//                ])
//                // 👇 Guardar cambios
//                ->action(function (array $data, $record): void {
//                    $f_data = $record->voca.$record->question.str_pad($record->note, 2, '0', STR_PAD_LEFT);
//                    $record->update([
//                        'data' => $f_data,
//                        'note' => $data['note'],
//                    ]);
//
//                    Notification::make()
//                        ->title('Guardado')
//                        ->success()
//                        ->send();
//                }),
        ];
    }
    public static function getToolbarActions(): array
    {
        return [
            //
        ];
    }

}
