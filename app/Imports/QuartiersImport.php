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

class QuartiersImport implements ToModel, WithValidation, WithStartRow
{

    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $importation_id = null;

    public function  __construct($importation_id)
    {
        $this->importation_id = $importation_id;
    }

    public function model(array $row)
    {

        $labelVille = ucfirst(strtolower($row[0]));
        $ville = Ville::where(function ($query) use ($row, $labelVille) {
            $query->where('label', $labelVille);
        })->first();

        if (!$ville) {
            $ville = new Ville;
            $ville->label = $labelVille;
            $ville->code = strtoupper(substr($labelVille, 0, 3));
            $ville->save();
        }

        return new Quartier([
            'label'  => isset($row[1]) ? $row[1] : null,
            'ville_id'  => $ville->id,
        ]);
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
