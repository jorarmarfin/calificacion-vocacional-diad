<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use App\Models\Score;
use App\Traits\ReportTrait;
use Illuminate\Http\Request;
use PDF;
class ReportGradeController extends Controller
{
    use ReportTrait;
    public function generate($question_id=null):void
    {
        PDF::SetTitle('Acta de Calificación');
        PDF::AddPage();
        PDF::SetAutoPageBreak(true);
        $this->header();
        $this->footer();
        PDF::SetLineWidth(0.1);

        $alto_celda=5;
        $incremento = 45;
        $numMaxLineas = 90;
        $x = 35;
        $j = 0;
        $k = 0;
        $num = 1;
        $question = str_pad($question_id,2,'0',0);
        $professor = Professor::where('question','like','%'.$question.'%')->first();
        $exams = Score::where('question',$question)->orderBy('voca','asc')->get();
        $this->tituloColumnas($question);

        foreach ($exams as $key => $exam) {
            if($k%$numMaxLineas==0 && $k!=0){
                PDF::AddPage('U', 'A4');
                $nivel = $exam->nivel;
                $this->TituloColumnas($question);
                $this->header();
                $this->footer();
                $j=0;
                $k=0;
                $x=35;
            }

            if($k==45){
                $j=0;
                $x +=85;
                $this->TituloColumnas($question,2);
            }
            PDF::SetFont('helvetica', '', 10);
            #NRO
            $this->box($x,$j*$alto_celda+$incremento,10,5,$num,1,'C');
            $this->box($x+10,$j*$alto_celda+$incremento,20,5,$exam->voca,1,'C');
            $this->box($x+30,$j*$alto_celda+$incremento,25,5,$exam->note,1,'R');


            $j++;
            $k++;
            $num++;
        }
        PDF::SetFont('helvetica', 'I', 9);
        $this->box(30,270,70,5,$professor->names ?? '','T','C');

        $fecha = date('Ymd_His');
        PDF::Output(storage_path('app/reportes/').'Acta_Calificacion_'.$fecha.'.pdf','I');
    }
    public function tituloColumnas($question,$column = null):void
    {
        $y=39;
        $x=30;
        #TITULO REPORTE
        PDF::SetXY($x, $y-10);
        PDF::SetTextColor(255,0,0);
        PDF::SetFont('helvetica','B',17);
        PDF::Cell(150,5,'Acta de Calificación de la pregunta '.$question,0,2,'C');
        PDF::SetFont('helvetica','B',12);
        PDF::SetTextColor(0,0,0);
        $this->box($x + 5, $y,10,5,'N°',1,'C');
        $this->box($x + 15, $y,20,5,'CÓDIGO',1,'C');
        $this->box($x + 35, $y,25,5,'NOTA',1,'C');
        #
        if($column){
            $this->box($x + 90, $y,10,5,'N°',1,'C');
            $this->box($x + 100, $y,20,5,'CÓDIGO',1,'C');
            $this->box($x + 120, $y,25,5,'NOTA',1,'C');
        }


    }
}
