<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'label'=>'Conpany 1',
                'sign'=>'CO-1',
                // 'created_at'        => Carbon::now(),
                // 'updated_at'        => Carbon::now(),
            ],
            [
                'label'=>'Company 2',
                'sign'=>'CO-2',
                // 'created_at'        => Carbon::now(),
                // 'updated_at'        => Carbon::now(),
            ],
        ];

        // Insert the data to this table
        DB::table('companies')->truncate();
        DB::table('companies')->insert($data);
    }
}
