<?php

namespace App\Traits;

use App\Models\Configuracion;
use App\Models\Configuration;
use PDF;
Trait ReportTrait
{
    public function lineEveryFive($k, $x, $y, $cellHeight, $increment,$width = 180):void
    {
        if ($k%5==0) {
            #
            PDF::SetXY($x, $y*$cellHeight+$increment);
            PDF::SetFont('courier', '', 11);
            PDF::Cell($width, 5, '', 'B', 1, 'C');
            #
        }
    }
    public function lineClose(int $x, int $y, int $cellHeight, int $increment): void
    {
        PDF::SetXY($x, $y * $cellHeight + $increment);
        PDF::SetFont('courier', '', 11);
        PDF::Cell(180, 5, '', 'T', 1, 'C');
    }
    public function header($orientation = 'U',$titulo1 = null,$titulo2 = null):void
    {
        $titulo1 = (isset($titulo1)) ? $titulo1 : Configuration::where('key','T1')->first()->value;
        $titulo2 = (isset($titulo2)) ? $titulo2 : Configuration::where('key','T2')->first()->value;
        PDF::Image('logo-uni.jpg',15,7,13);
        PDF::SetFont('helvetica','B',9);
        PDF::SetXY(29,10);
        PDF::Cell(150,5,'UNIVERSIDAD NACIONAL DE INGENIERÍA',0,2,'L');
        PDF::SetXY(29,13);
        PDF::SetFont('helvetica','B',9);
        PDF::Cell(150,6,'DIRECCIÓN DE ADMISIÓN',0,2,'L');
        PDF::SetXY(29,16.5);
        PDF::SetFont('helvetica','',9);
        PDF::Cell(150,5,$titulo1,0,2,'L');
        PDF::SetXY(29,20);
        PDF::Cell(150,5,$titulo2,0,0,'L');

        #   NUMERO DE PAGINA
        $x = ($orientation=='U') ? 160 : 260 ;

        PDF::SetFont('helvetica', 'B', 8);
        PDF::SetXY($x, 10);
        PDF::Cell(13, 5, "Fecha :", 0, 0, 'L');
        PDF::SetXY($x+13, 10);
        PDF::Cell(17, 5, date('d/m/Y'), 0, 0, 'R');
        PDF::SetXY($x, 13);
        PDF::Cell(13, 5, "Hora :", 0, 0, 'L');
        PDF::SetXY($x+13, 13);
        PDF::Cell(17, 5, date('H:i:s'), 0, 0, 'R');
        PDF::SetXY($x, 17);
        PDF::Cell(13, 5, 'Página :', 0, 0, 'R');
        PDF::SetXY($x+13, 17);
        $pagina = trim(PDF::PageNo().' de '.PDF::getAliasNbPages());
        PDF::Cell(17, 5,$pagina, 0, 0, 'R');
    }
    public function footer($orientation='U'):void
    {
        $x = ($orientation=='U') ? 12 : 50 ;
        $x2 = ($orientation=='U') ? 140 : 220 ;
        $y = ($orientation=='U') ? 283 : 200 ;
        $width = ($orientation=='U') ? 200 : 285 ;

        PDF::SetTextColor(0);
        PDF::SetLineWidth(0.5);
        PDF::SetFont('helvetica', '', 7);

        PDF::Line(12,$y,$width,$y);
        PDF::SetXY($x2,$y);
        PDF::Cell(60, 1,'Dirección de Admisión' ,0, 1, 'C', 0);
    }
    public function deleteReport($file)
    {
        shell_exec('rm '.storage_path('app/'.$file));
    }
    public function box($x,$y,$w,$h,$texto,$border,$alignment,$ln = 0, $fill = 0, $link = '',$strech = 0, $ignore_min_height=false, $calign='T', $valign='M'):void
    {
        //Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
        PDF::SetXY($x, $y);
        PDF::Cell($w, $h,$texto, $border, $ln,$alignment,$fill,$link,$strech,$ignore_min_height,$calign,$valign);
    }
    public function mbox($x,$y,$w,$h,$texto,$border,$alignment,$fill = 0,$ln=0,$x2='',$y2='',$reseth = true,
                         $stretch=0,$ishtml=true,$autopadding=true,$maxh=0,$alignmentVertical ='M' ):void
    {
        // MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true,
        // $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
        PDF::SetXY($x, $y);
        PDF::MultiCell($w, $h,$texto, $border, $alignment,$fill,$ln,$x2,$y2,$reseth,$stretch,$ishtml,$autopadding,$maxh,$alignmentVertical);
    }
    public function firma($x,$y,$borde = 'T'):void
    {
        $director = 'Dr. PAUYAC HUAMAN JOSE ANIBAL';
        $this->box($x + 20, $y + 20, 75, 13, $director,$borde,'C');
        $this->box($x + 20, $y + 25, 75, 13, 'Director de Admisión',0,'C');
        $director = 'M.Sc. SESPEDES VALKARSEL SVITLANA';
        $this->box($x + 120, $y + 20, 75, 13, $director,$borde,'C');
        $this->box($x + 120, $y + 25, 75, 13, 'Responsable de Asistencia',0,'C');
    }

}
