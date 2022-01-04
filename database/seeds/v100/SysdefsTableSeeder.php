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
    }
}
