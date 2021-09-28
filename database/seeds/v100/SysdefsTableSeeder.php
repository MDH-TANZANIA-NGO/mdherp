<?php

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
use App\Models\System\Sysdef;

class SysdefsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'ICAPTAFNUM'],
            [
                'name' => 'taf_number',
                'display_name' => 'Taf Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'ICAPTAFNUM',
                'sysdef_group_id' => 1,
            ]
        );

        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'ICAPTBERNUM'],
            [
                'name' => 'taf_number',
                'display_name' => 'Tber Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'ICAPTBERNUM',
                'sysdef_group_id' => 1,
            ]
        );

        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'ONTRVWITHINPERCENTAGES'],
            [
                'name' => 'on_travel_within_percent',
                'display_name' => 'On Travel Percent within city',
                'value' => '0.75',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'ONTRVWITHINPERCENTAGES',
                'sysdef_group_id' => 1,
            ]
        );

        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'ONTRVOUTSIDEREFERENCEAMOUNT'],
            [
                'name' => 'on_travel_out_side_amount',
                'display_name' => 'On Travel Percent within city',
                'value' => '41250',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'ONTRVOUTSIDEREFERENCEAMOUNT',
                'sysdef_group_id' => 1,
            ]
        );

        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'ICAPCOVCECPAYNUM'],
            [
                'name' => 'cov_cec_payment',
                'display_name' => 'Cov & Cec Monthly Payment Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'ICAPCOVCECPAYNUM',
                'sysdef_group_id' => 1,
            ]
        );

        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'ICAPLENUM'],
            [
                'name' => 'leave_number',
                'display_name' => 'Leave Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'ICAPLENUM',
                'sysdef_group_id' => 1,
            ]
        );
    }
}
