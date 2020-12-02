<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon as Carbon;

class OrganizationSeeder extends Seeder
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
                'title'=>'Kabul UNI',
                'email'=>'fixed@gmail.com',
                'phone'=>'+9854329235',
                'website'=>'active.af',
                'address' => 'Kabul-Afghanistan',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),

            ],
            [
                'title'=>'Kateb Uni',
                'email'=>'percent@gmail.com',
                'phone'=>'+9854329857',
                'website'=>'kabul.af',
                'address' => 'Kabul-Afghanistan',
                'created_at'        => Carbon::now(),
                'updated_at'        => Carbon::now(),

            ],
        ];

        // Insert the data to this table
        DB::table('organizations')->insert($data);
    }
}
