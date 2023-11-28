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
            'Lot Name',
            'Quantity',
            'Amount',
            'Photo',
            'Made By',
            'Making Charges',
            'Agent Name',
            'Agent Mobile',
            'Packed By',
            'No Of Packages',
            'Net Weight',
            'Gross Weight',
            'Dimension',
            'Courier Charges',
            'Packaging Additional Charges',
            'Preliminary Document',
            'Packaging Remarks',
            'Date of Shipping',
            'Port of Loading',
            'Port of Discharge',
            'Shipping Charges',
            'Insurance Charges',
            'Additional Charges',
            'Shipping Remarks',
            'Received Date',
            'Receipt No',
            'Clearance Charges',
            'Shipment Additional Charges',
            'Receipt of Shipment',
            'Shipment Remarks',
            'Quantity After Refinery',
            'Loss',
            'Refinery Charges',
            'Refinery Report',
            'Refinery Remarks',
            'Sell Rate',
            'Sell Amount',
            'Sell Remarks',
            'Created Date',
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
          
            $data->category->name,
            $data->lot_name,
            $data->quantity,
            $data->amount,
            $data->photo,
            $data->made_by,
            $data->making_charges,
            $data->agent_name,
            $data->agent_mobile,
            $data->packed_by,
            $data->no_of_packages,
            $data->net_weight,
            $data->gross_weight,
            $data->dimension,
            $data->courier_charges,
            $data->packaging_additional_charges,
            $data->preliminary_document,
            $data->packaging_remarks,
            $data->date_of_shipping,
            $data->port_of_loading,
            $data->port_of_discharge,
            $data->shipping_charges,
            $data->insurance_charges,
            $data->additional_charges,
            $data->shipping_remarks,
            $data->received_date,
            $data->receipt_no,
            $data->clearance_charges,
            $data->shippment_additional_charges,
            $data->receipt_of_shipment,
            $data->shippment_remarks,
            $data->quantity_after_refinery,
            (($data->quantity - $data->quantity_after_refinery) / $data->quantity) * 100 ?? '',
            $data->refinary_charges,
            $data->refinary_report,
            $data->refinery_remarks,
            $data->sell_rate,
            $data->sell_amount,
            $data->sell_remarks,
            Carbon::parse($data->created_at)->format('d M Y , D'),
            status($data->status)
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:AA1' => [
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
