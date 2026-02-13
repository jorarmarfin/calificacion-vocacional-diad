<?php

namespace App\Filament\Grading\Pages;
use App\Filament\Grading\Pages\Schemas\ScoreForm;
use App\Filament\Grading\Pages\Tables\ScoreTable;
use App\Models\Professor;
use App\Models\Score;
use Filament\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use BackedEnum;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class ScorePage extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected string $view = 'filament.grading.pages.score-page';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calculator;
    public int $pregunta;
    //constructor
    public function __construct()
    {
        $this->pregunta = Str::of(auth()->user()->name)->after('Pregunta')->value;
    }


    public ?array $data = [];

    public function getTitle(): string | Htmlable
    {
        return 'Calificación de la pregunta '.$this->pregunta;
    }


    public function form(Schema $schema): Schema
    {
        return ScoreForm::configure($schema)->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $puntaje = substr($data['currentScore'],0,8);
        $nota = 0;
        if($data['currentScore']){
            $question = Score::firstOrNew([
                'voca'=>str_pad(substr($puntaje, 0, 3), 3, '0', STR_PAD_LEFT),
                'question'=>substr($puntaje,3,2)
            ]);
            $nota = substr($puntaje,5,3);
            $question->user_id = auth()->id();
            $question->data = $puntaje;
            $question->note = $nota;
            $question->save();
        }

        // Notificación de éxito (opcional)
         Notification::make()
             ->title('Puntaje guardado '.$nota)
             ->success()
             ->send();
        $this->form->fill(['currentScore' => '']);
    }

    public function table(Table $table): Table
    {
        return ScoreTable::configure($table,$this->pregunta);
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('imprimir_img1')
                ->label('Acta de Calificacion')
                ->color('success')
                ->url(fn() => route('report.grade.print',['id'=>$this->pregunta]))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer'),

            Action::make('deleteAll')
                ->label('Eliminar Todos')
                ->color('danger')
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    Score::where('user_id', auth()->id())->delete();
                    Notification::make()
                        ->title('Todos los puntajes han sido eliminados')
                        ->success()
                        ->send();
                }),
        ];
    }
}
