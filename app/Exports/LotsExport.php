<?php

namespace App\Exports;

use App\Models\lot;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LotsExport implements  FromCollection, WithHeadings, WithMapping , WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return lot::get();
    }

    public function headings(): array
    {
        return [
            'S.no.',
            'Category',
            'Quantity',
            'Amount',
            'net Weight',
            'No Of packages',
            'Loss',
            'Total Charges',
            'Sell',
            'cash_flow',
            'Cteated Date',
            'Status'
        ];
    }

    public function map($data): array
    {
        static $counter = 0;
        $counter++;

        $charges = [
            'making_charges',
            'courier_charges',
            'packaging_additional_charges',
            'shipping_charges',
            'insurance_charges',
            'additional_charges',
            'clearance_charges',
            'shippment_additional_charges',
            'refinary_charges'
            
        ];

        $total_charges = array_sum(array_map(function($charge) use ($data) {  return $data->$charge; }, $charges));


        return [
            $counter,
            $data->id,
            $data->category?->name,
            $data->quantity,
            $data->amount,
            $data->net_weight,
            $data->no_of_packages,
            (($data->quantity - $data->quantity_after_refinery) / $data->quantity) * 100 ?? '',
            $total_charges,
            $data->quantity_after_refinery * $data->sell_rate ,
            (($data->quantity * $data->amount) + $total_charges) - ($data->quantity_after_refinery * $data->sell_rate ),
            Carbon::parse($data->created_at)->format('d M Y , D'),
            status($data->status)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:Z1' => [
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
