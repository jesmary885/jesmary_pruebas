<?php

namespace App\Imports;

use App\Models\Link;
use Maatwebsite\Excel\Concerns\ToModel;

use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CintImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    public function model(array $row)
    {
            return new Link([
            'psid'  => $row['psid'],
            'user_id'  => '2',
            'jumper_type_id' => '3'
        ]);
    }

  /*  $table->string('psid')->nullable();
            $table->string('basic')->nullable();
            $table->string('high')->nullable();
            $table->string('pid')->nullable();
            $table->string('panel')->nullable();
            $table->string('observation')->nullable();
            $table->string('id_id')->nullable();
            $table->string('token')->nullable();
            $table->string('jumper')->nullable();
            $table->string('notch')->nullable();
            $table->string('k_detected')->nullable();
            $table->string('wix_detected')->nullable();
            $table->string('negative_points')->nullable();
            $table->string('positive_points')->nullable();

    $table->unsignedBigInteger('jumper_type_id');
            $table->foreign('jumper_type_id')->references('id')->on('jumper_types');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');*/

    
    public function batchSize(): int
    {
        return 1000;
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
