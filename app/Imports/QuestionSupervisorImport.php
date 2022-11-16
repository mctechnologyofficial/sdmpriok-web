<?php

namespace App\Imports;

use App\Models\QuestionSupervisor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionSupervisorImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new QuestionSupervisor([
            'competency'        => $row['competency'],
            'category'          => $row['category'],
            'sub_category'      => $row['sub_category'],
            'reference'         => $row['reference'],
            'lesson_plan'       => $row['lesson_plan'],
            'processing_time'   => $row['processing_time'],
            'realization'       => $row['realization'],
            'total_time'        => $row['total_time'],
        ]);
    }
}
