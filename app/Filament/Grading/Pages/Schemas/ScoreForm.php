<?php

namespace App\Filament\Grading\Pages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ScoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('currentScore')
                    ->label('Puntaje Actual')
                    ->placeholder('Ingrese el puntaje')
                    ->autofocus()
                    ->required(),
            ]);
    }

}
