<?php
namespace Database\seeds\v100;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class WorkingToolsTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("working_tools");
        $this->delete('working_tools');

        \DB::table('working_tools')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Computer Laptop',
                    'department_id' => 5,
                    'email' => 'helpdesk@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Computer Desktop',
                    'department_id' => 5,
                    'email' => 'helpdesk@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Office Chair',
                    'department_id' => 2,
                    'email' => 'hr@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Office Mobile Phone',
                    'department_id' => 5,
                    'email' => 'helpdesk@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Small Working Desk',
                    'department_id' => 2,
                    'email' => 'hr@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Office Cabinet',
                    'department_id' => 2,
                    'email' => 'hr@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Large Working Desk',
                    'department_id' => 2,
                    'email' => 'hr@mdh.or.tz',
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
        ));

    }
}
