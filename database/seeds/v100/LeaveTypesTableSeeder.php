<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

class LeaveTypesTableSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("leave_types");
        $this->delete('leave_types');

        \DB::table('leave_types')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Annual Leave',
                    'days' => 28,
                    'years' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Emergency Leave',
                    'days' => 3,
                    'years' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'Compassionate Leave',
                    'days' => 4,
                    'years' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'Maternity Leave',
                    'days' => 84,
                    'years' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'Paternity Leave',
                    'days' => 3,
                    'years' => 1,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            5 =>
                array (
                    'id' => 6,
                    'name' => 'Study Leave',
                    'days' => 20,
                    'years' => 2,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
            6 =>
                array (
                    'id' => 7,
                    'name' => 'Sick Leave',
                    'days' => 126,
                    'years' => 3,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ),
        ));


    }
}
