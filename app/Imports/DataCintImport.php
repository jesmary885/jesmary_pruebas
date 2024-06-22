<?php

namespace App\Imports;

use App\Models\Link;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataCintImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
        Link::create([
            'panel'  => $row['panel'],
            'user_id'  => '2',
            'jumper_type_id' => '4',
            'jumper' => $row['jumper']
        ]);
}


    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
