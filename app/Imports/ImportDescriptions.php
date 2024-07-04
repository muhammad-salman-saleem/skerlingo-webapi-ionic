<?php

namespace App\Imports;

use App\Quartier;
use App\Ville;
use Maatwebsite\Excel\Concerns\ToModel;
use \PhpOffice\PhpSpreadsheet\Shared;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithStartRow;


use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToArray;

class ImportDescriptions implements ToArray, WithValidation, WithStartRow
{

    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */


    public function  __construct()
    {
    }

    public function array($row): array
    {
        return [
            'label'  => $row[1],
        ];
    }

    public function rules(): array
    {
        return [];
    }

    public function startRow(): int
    {
        return 2;
    }
}
