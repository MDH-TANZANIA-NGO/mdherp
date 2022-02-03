<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Database\DisableForeignKeys;
use Database\TruncateTable;

class CountryOrganisationTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("country_organisation");
        $this->delete('country_organisation');
        \DB::table('country_organisation')->insert(array (
            0 =>
                array(
                    'id' => 1,
                    'country_id' => 1,
                    'organisation_id' => 1,
                    'created_at' => '2021-12-13 18:47:27',
                    'updated_at' => '2021-12-13 18:47:27',
                )
        ));
        $this->enableForeignKeys("country_organisation");
    }
}
