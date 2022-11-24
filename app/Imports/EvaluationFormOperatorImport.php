<?php

namespace App\Imports;

use App\Models\FormEvaluationOperator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class EvaluationFormOperatorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new FormEvaluationOperator([
            'tools'                     => $row['tools'],
            'unit'                      => $row['unit'],
            'test_material'             => $row['test_material'],
            'competence_test'           => $row['competence_test'],
            'result'                    => $row['result'],
            'description'               => $row['description'],
            'average_minimum_value'     => $row['average_minimum_value'],
        ]);
    }
}
