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
            ['reference' => 'REQNUM'],
            [
                'name' => 'requisition',
                'display_name' => 'Requisition Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'REQNUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'SAFNUM'],
            [
                'name' => 'safari',
                'display_name' => 'Safari Advances',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'SAFNUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'PROGRAMACTIVITYNUM'],
            [
                'name' => 'programactivity',
                'display_name' => 'Program Activities',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'PROGRAMACTIVITYNUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'RETIREMENTSAFARINUM'],
            [
                'name' => 'retirement',
                'display_name' => 'Retirement',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'RETIREMENTSAFARINUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'PAYMENTNUM'],
            [
                'name' => 'payment',
                'display_name' => 'Payment',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'PAYMENTNUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'PROGRAMCTIVITYREPORTNUM'],
            [
                'name' => 'programactivityreport',
                'display_name' => 'Program Activity Report',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'PROGRAMCTIVITYREPORTNUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'RATENUM'],
            [
                'name' => 'rate',
                'display_name' => 'Rate Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'RATENUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'CHECKNO'],
            [
                'name' => 'check_no',
                'display_name' => 'Check Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'CHECKNO',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'PRNUM'],
            [
                'name' => 'performance_review',
                'display_name' => 'Performance Review',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'PRNUM',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'HRADV'],
            [
                'name' => 'hire_advertisement_requisition',
                'display_name' => 'Advertisement Requisition',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'HRADV',
                'sysdef_group_id' => 1,
            ]
        );
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'MDH-INT'],
            [
                'name' => 'hr_interview_applicants',
                'display_name' => 'Applicant Interview Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'MDH-INT',
                'sysdef_group_id' => 1,
            ]
        );
        // MDH_JST
        $sysdef = Sysdef::firstOrCreate(
            ['reference' => 'MDH_JST'],
            [
                'name' => 'hr_hire_requisition_job_shortlists',
                'display_name' => 'Shortlist Number',
                'value' => '0',
                'data_type' => 'integer',
                'isactive' => 1,
                'reference' => 'MDH_JST',
                'sysdef_group_id' => 1,
            ]
        );
    }
}
