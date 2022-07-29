<?php
namespace Database\seeds\v100;

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
class SkillCategoryTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->delete('skill_categories');

        \DB::table('skill_categories')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'Accounting & Finance', 
                    'uuid' => 'd151f400-ed48-11ec-800f-832ac61b168e'
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'Information Technology', 
                    'uuid' => 'd151f400-ed48-11ec-800f-832ac61b168e'
                )

        ));
    }
}
