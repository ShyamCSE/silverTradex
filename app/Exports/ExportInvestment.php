<?php

namespace App\Exports;

use App\Models\Investment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class ExportInvestment implements FromCollection, WithHeadings, WithMapping
{
 

    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    
    public function collection()
    {
        return Investment::whereBetween('created_at', [$this->startDate, $this->endDate])->get();
    }

    public function headings(): array
    {
        return [
            'S.no.',
            'Name',
            'Mobile',
            'Email',
            'Amount',
            'Invest Date',
            'Created At'

        ];
    }

    public function map($investment): array
    {
        static $counter = 0;
        $counter++; 

        return [
            $counter,
            $investment->name,
            $investment->mobile,
            $investment->email,
            $investment->amount,
            Carbon::parse($investment->invest_date)->format('d M Y'),
            Carbon::parse($investment->created_at)->format('d M Y'),
        ];
    }
}
