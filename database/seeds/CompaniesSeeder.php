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
                'label'=>'شایق علیمی',
                'sign'=>'SHA',
                // 'created_at'        => Carbon::now(),
                // 'updated_at'        => Carbon::now(),
            ],
            [
                'label'=>'ورنا بهفر',
                'sign'=>'WB',
                // 'created_at'        => Carbon::now(),
                // 'updated_at'        => Carbon::now(),
            ],
        ];

        // Insert the data to this table
        DB::table('companies')->truncate();
        DB::table('companies')->insert($data);
    }
}
