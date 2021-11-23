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
    }
}
