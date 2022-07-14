<?php
namespace Database\seeds\v100;

use Illuminate\Database\Seeder;
use Database\TruncateTable;
use Database\DisableForeignKeys;
class SkillsTableSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->delete('skills');

        \DB::table('skills')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'skill_category_id' => 2,
                    'name' => 'Financial reporting', 
                    'uuid' => 'Financial reporting'
                ),
            1 =>
                array (
                    'id' => 2,
                    'skill_category_id' => 2,
                    'name' => 'Problem-solving skills', 
                    'uuid' => 'Problem-solving skills'
                ),
            2 =>
                array (
                    'id' => 3,
                    'skill_category_id' => 2,
                    'name' => 'Knowledge of digital toolsKnowledge of digital toolsKnowledge of digital tools', 
                    'uuid' => 'Knowledge of digital toolsKnowledge of digital toolsKnowledge of digital tools'
                ),

        ));
    }
}
