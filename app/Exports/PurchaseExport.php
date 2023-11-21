<?php

namespace App\Exports;

use App\Models\purchase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PurchaseExport implements FromCollection, WithHeadings, WithMapping , WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return purchase::latest()->get();
    }

    public function headings(): array
    {
        return [
            'S.no.',
            'Category',
            'Supplier',
            'Phone',
            'Quantity',
            'Current Quantity',
            'Rate',
            'Total Price',
            'Purchease date',
            'Cteated Date'
        ];
    }

    public function map($data): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            $data->category?->name,
            $data->supplier?->name,
            $data->supplier?->phone,
            $data->quantity,
            $data->current_quantity,
            $data->rate,
            $data->total_price,
            Carbon::parse($data->date)->format('d M Y , D'),
            Carbon::parse($data->created_at)->format('d M Y , D'),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:J1' => [
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FFA0A0A0',
                    ],
                ],
            ],
        ];
    }

}
