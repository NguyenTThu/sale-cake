<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class TestExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
    public function headings(): array
    {
        return [
            'id'
            'name',
        ];
    }
    public function map($bill): array
    {
        return [
            $user->id,
            $user->name,
        ];
    }
}
