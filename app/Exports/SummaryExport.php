<?php

namespace App\Exports;

use App\Models\Summary;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SummaryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Summary::all();
    }

    /**
     * Cabeceras de la hoja de cálculo (ordenadas según el mapeo)
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'id',
            'voca',
            'p05',
            'p06',
            'p07',
            'p08',
            'p09',
            'p10',
        ];
    }

    /**
     * Mapear cada modelo Summary a una fila del export
     *
     * @param  Summary  $summary
     * @return array
     */
    public function map($summary): array
    {
        return [
            $summary->id,
            $summary->voca,
            $summary->p05,
            $summary->p06,
            $summary->p07,
            $summary->p08,
            $summary->p09,
            $summary->p10,
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la fila de encabezados
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF']
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4F46E5']
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}
