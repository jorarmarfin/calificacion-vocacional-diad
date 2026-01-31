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
class ScorePage extends Page implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected string $view = 'filament.grading.pages.score-page';
    protected static ?int $navigationSort = 2;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Calculator;
    public Professor $professor;
    //constructor
    public function __construct()
    {
        $p = Professor::where('user_id',auth()->id())->first();
        if($p){
            $this->professor = $p;
        }else{
            abort(403, 'No tienes permiso para acceder a esta página.');
        }
    }


    public ?array $data = [];

    public function getTitle(): string | Htmlable
    {
        return 'Calificación de la pregunta '.$this->professor->question;
    }


    public function form(Schema $schema): Schema
    {
        return ScoreForm::configure($schema)->statePath('data');
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $puntaje = substr($data['currentScore'],0,7);
        if($data['currentScore']){
            $question = Score::firstOrNew([
                'voca'=>str_pad(substr($puntaje, 0, 3), 3, '0', STR_PAD_LEFT),
                'question'=>substr($puntaje,3,2)
            ]);
            $question->user_id = auth()->id();
            $question->data = $puntaje;
            $question->note = substr($puntaje,5,2);
            $question->save();
        }

        // Notificación de éxito (opcional)
         Notification::make()
             ->title('Puntaje guardado')
             ->success()
             ->send();
        $this->form->fill(['currentScore' => '']);
    }

    public function table(Table $table): Table
    {
        return ScoreTable::configure($table);
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('imprimir_img1')
                ->label('Acta de Calificacion')
                ->color('success')
                ->url(fn() => route('report.grade.print',['id'=>$this->professor->question]))
                ->openUrlInNewTab()
                ->icon('heroicon-o-printer'),

//            Action::make('deleteAll')
//                ->label('Eliminar Todos')
//                ->color('danger')
//                ->icon('heroicon-o-trash')
//                ->requiresConfirmation()
//                ->action(function () {
//                    Score::truncate();
//                    Notification::make()
//                        ->title('Todos los puntajes han sido eliminados')
//                        ->success()
//                        ->send();
//                }),
        ];
    }
}
