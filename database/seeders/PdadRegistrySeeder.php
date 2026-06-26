<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PdadRegistrySeeder extends Seeder
{
    public function run(): void
    {
        $file = database_path('seeders/data/pdad_registry.csv');

        if (!file_exists($file)) {
            $this->command->error('CSV file not found!');
            return;
        }

        $handle = fopen($file, 'r');

        $header = fgetcsv($handle);

        while (($row = fgetcsv($handle)) !== false) {

            DB::table('pwd_registry_reference')->insert(array_combine($header, $row));

        }

        fclose($handle);

        $this->command->info('PDAD Registry imported successfully!');
    }
}