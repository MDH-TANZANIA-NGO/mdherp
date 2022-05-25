<?php

use Illuminate\Database\Seeder;

class PrCompetenceKeyNarrationsTableSeeder extends Seeder
{
    //pr_competence_key_id
    use DisableForeignKeys, TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys("pr_competence_key_narrations");
        $this->delete('pr_competence_key_narrations');
        \DB::table('pr_competence_key_narrations')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'pr_competence_key_id' => 1,
                    'narration' => 'Has required knowledge of subject matter, processes and procedures',
                ),
            1 =>
                array(
                    'id' => 2,
                    'pr_competence_key_id' => 1,
                    'narration' => 'Understands the role to play in supporting mission of the organization',
                ),
            2 =>
                array(
                    'id' => 3,
                    'pr_competence_key_id' => 1,
                    'narration' => 'Keeps up to date in areas of expertise',
                ),
            3 =>
                array(
                    'id' => 4,
                    'pr_competence_key_id' => 1,
                    'narration' => 'Proactive in expanding existing knowledge and skills',
                ),
            4 =>
                array(
                    'id' => 5,
                    'pr_competence_key_id' => 2,
                    'narration' => 'Sets standards for excellence',
                ),
            5 =>
                array(
                    'id' => 6,
                    'pr_competence_key_id' => 2,
                    'narration' => 'Ensures high quality',
                ),
            6 =>
                array(
                    'id' => 7,
                    'pr_competence_key_id' => 2,
                    'narration' => 'Takes responsibility',
                ),
            7 =>
                array(
                    'id' => 8,
                    'pr_competence_key_id' => 2,
                    'narration' => 'Shows interest and enthusiasm',
                ),
            8 =>
                array(
                    'id' => 9,
                    'pr_competence_key_id' => 2,
                    'narration' => 'Encourages others to take responsibility',
                ),
            9 =>
                array(
                    'id' => 10,
                    'pr_competence_key_id' => 3,
                    'narration' => 'Understands the broader implication of communication',
                ),
            10 =>
                array(
                    'id' => 11,
                    'pr_competence_key_id' => 3,
                    'narration' => 'Clearly conveys ideas, information, ,instructions and questions in a timely manner',
                ),
            11 =>
                array(
                    'id' => 12,
                    'pr_competence_key_id' => 3,
                    'narration' => 'Listens carefully and Comprehends communication from others',
                ),
            12 =>
                array(
                    'id' => 13,
                    'pr_competence_key_id' => 4,
                    'narration' => 'In time at work place',
                ),
            13 =>
                array(
                    'id' => 14,
                    'pr_competence_key_id' => 4,
                    'narration' => 'Remains at work during working hours',
                ),
            14 =>
                array(
                    'id' => 15,
                    'pr_competence_key_id' => 4,
                    'narration' => 'Attends required meetings',
                ),
            15 =>
                array(
                    'id' => 16,
                    'pr_competence_key_id' => 4,
                    'narration' => 'Attends required trainings',
                ),
            17 =>
                array(
                    'id' => 18,
                    'pr_competence_key_id' => 5,
                    'narration' => 'Ensures high quality output in a timely manner',
                ),
            18 =>
                array(
                    'id' => 19,
                    'pr_competence_key_id' => 5,
                    'narration' => 'Evaluates results to achieve expected goal',
                ),
            19 =>
                array(
                    'id' => 20,
                    'pr_competence_key_id' => 5,
                    'narration' => 'Adapts quickly to unexpected changes',
                ),
            20 =>
                array(
                    'id' => 21,
                    'pr_competence_key_id' => 5,
                    'narration' => 'Allocates appropriate time for completing work and develops timelines and milestones',
                ),
            21 =>
                array(
                    'id' => 22,
                    'pr_competence_key_id' => 5,
                    'narration' => 'Follows procedures',
                ),
            22 =>
                array(
                    'id' => 23,
                    'pr_competence_key_id' => 6,
                    'narration' => 'Respect to co-workers',
                ),
            23 =>
                array(
                    'id' => 24,
                    'pr_competence_key_id' => 6,
                    'narration' => 'Maintains confidentiality',
                ),
            24 =>
                array(
                    'id' => 25,
                    'pr_competence_key_id' => 6,
                    'narration' => 'Honest',
                ),
            25 =>
                array(
                    'id' => 26,
                    'pr_competence_key_id' => 7,
                    'narration' => 'Seeks and establishes effective working relationships with other colleagues and groups',
                ),
            26 =>
                array(
                    'id' => 27,
                    'pr_competence_key_id' => 7,
                    'narration' => 'Understands team goals and achieves objectives by working with others',
                ),
            27 =>
                array(
                    'id' => 28,
                    'pr_competence_key_id' => 7,
                    'narration' => 'Demonstrates flexibility and aligns individual goals with team needs',
                ),
            28 =>
                array(
                    'id' => 29,
                    'pr_competence_key_id' => 8,
                    'narration' => 'Generates new ideas to improve work',
                ),
            29 =>
                array(
                    'id' => 30,
                    'pr_competence_key_id' => 8,
                    'narration' => 'Acts independently',
                ),
            30 =>
                array(
                    'id' => 31,
                    'pr_competence_key_id' => 8,
                    'narration' => 'Responds quickly',
                ),
            31 =>
                array(
                    'id' => 32,
                    'pr_competence_key_id' => 8,
                    'narration' => 'Goes above and beyond expectations',
                ),
            32 =>
                array(
                    'id' => 33,
                    'pr_competence_key_id' => 9,
                    'narration' => 'Prioritizes',
                ),
            33 =>
                array(
                    'id' => 34,
                    'pr_competence_key_id' => 9,
                    'narration' => 'Schedules',
                ),
            34 =>
                array(
                    'id' => 35,
                    'pr_competence_key_id' => 9,
                    'narration' => 'Leverages resources',
                ),
            35 =>
                array(
                    'id' => 36,
                    'pr_competence_key_id' => 9,
                    'narration' => 'Stays focused',
                ),
            37 =>
                array(
                    'id' => 38,
                    'pr_competence_key_id' => 10,
                    'narration' => 'Collaboratively establishes development goals',
                ),
            38 =>
                array(
                    'id' => 39,
                    'pr_competence_key_id' => 10,
                    'narration' => 'Creates learning environment',
                ),
            39 =>
                array(
                    'id' => 40,
                    'pr_competence_key_id' => 10,
                    'narration' => 'Monitors progress',
                ),
            40 =>
                array(
                    'id' => 41,
                    'pr_competence_key_id' => 10,
                    'narration' => 'Gives required support',
                ),
            41 =>
                array(
                    'id' => 42,
                    'pr_competence_key_id' => 10,
                    'narration' => 'Builds team spirit',
                ),
            42 =>
                array(
                    'id' => 43,
                    'pr_competence_key_id' => 11,
                    'narration' => 'Identifies issues problems and opportunities',
                ),
            43 =>
                array(
                    'id' => 44,
                    'pr_competence_key_id' => 11,
                    'narration' => 'Makes quick, right decisions',
                ),
            44 =>
                array(
                    'id' => 45,
                    'pr_competence_key_id' => 11,
                    'narration' => 'Commits to action',
                ),
            45 =>
                array(
                    'id' => 46,
                    'pr_competence_key_id' => 11,
                    'narration' => 'Involves others',
                ),
            47 =>
                array(
                    'id' => 48,
                    'pr_competence_key_id' => 12,
                    'narration' => 'Makes quick, right decisions',
                ),
            48 =>
                array(
                    'id' => 49,
                    'pr_competence_key_id' => 12,
                    'narration' => 'Commits to action',
                ),
            49 =>
                array(
                    'id' => 50,
                    'pr_competence_key_id' => 12,
                    'narration' => 'Involves others',
                ),
        ));
        $this->enableForeignKeys("pr_competence_key_narrations");

    }
}
