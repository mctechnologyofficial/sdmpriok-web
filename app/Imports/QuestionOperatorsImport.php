<?php

namespace App\Imports;

use App\Models\QuestionOperator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionOperatorsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new QuestionOperator([
            'competency'        => $row['competency'],
            'category'          => $row['category'],
            'sub_category'      => $row['sub_category'],
            'lesson'            => $row['lesson'],
            'reference'         => $row['reference'],
            'lesson_plan'       => $row['lesson_plan'],
            'processing_time'   => $row['processing_time'],
            'realization'       => $row['realization'],
            'total_time'        => $row['total_time'],
        ]);
    }
}
