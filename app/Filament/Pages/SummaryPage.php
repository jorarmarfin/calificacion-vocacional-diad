<?php

namespace App\Filament\Pages;

use App\Exports\SummaryExport;
use App\Filament\Pages\Tables\SummaryTable;
use App\Models\Summary;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SummaryPage extends Page implements HasTable
{
    use InteractsWithTable;
    protected string $view = 'filament.pages.summary-page';
    protected static ?int $navigationSort = 1;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::BookOpen;
    protected static ?string $title = 'Resumen de calificaciones';

    public function table(Table $table): Table
    {
        return SummaryTable::configure($table);
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('import_summary')
                ->label('Importar Resumen')
                ->color('primary')
                ->icon('heroicon-o-arrow-up-tray')
                ->action(fn () => $this->syncSummaries()),
            Action::make('delete_all_summary')
                ->label('Eliminar Resumen')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    Summary::truncate();
                    Notification::make()
                        ->title('Resumen eliminado')
                        ->success()
                        ->send();
                }),
            Action::make('export_summary')
                ->label('Exportar Resumen')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(fn()=> Excel::download(new SummaryExport(), 'summary.xlsx'))
                ->openUrlInNewTab(),
        ];
    }
    public function syncSummaries(): void
    {
        DB::transaction(function () {
            $rows = DB::table('scores')
                ->selectRaw("
                voca,
                COALESCE(MAX(note) FILTER (WHERE question = '05'), 0) AS p05,
                COALESCE(MAX(note) FILTER (WHERE question = '06'), 0) AS p06,
                COALESCE(MAX(note) FILTER (WHERE question = '07'), 0) AS p07,
                COALESCE(MAX(note) FILTER (WHERE question = '08'), 0) AS p08,
                COALESCE(MAX(note) FILTER (WHERE question = '09'), 0) AS p09,
                COALESCE(MAX(note) FILTER (WHERE question = '10'), 0) AS p10
            ")
                ->whereIn('question', ['05', '06', '07', '08', '09', '10'])
                ->groupBy('voca')
                ->get()
                ->map(fn ($r) => (array) $r)
                ->all();

            // upsert masivo: inserta o actualiza por 'voca'
            Summary::upsert(
                $rows,
                ['voca'],
                ['p05', 'p06', 'p07', 'p08', 'p09', 'p10'],
            );
        });

        Notification::make()
            ->title('Resumen actualizado')
            ->success()
            ->send();
    }


}
