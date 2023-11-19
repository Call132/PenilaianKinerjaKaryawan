<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kriteriaSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriteria = [
            [
                'kriteria' => 'service_spirit',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'customer_focus',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'sales_ability',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'initiative',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'adaptation',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'decision_making',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'change_management',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'communication',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'team_coordination',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'leadership',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'people_development',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'commercial_awareness',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'problem_solving',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'integrity',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'corporate_sense',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'analyze_perspective',
                'bobot' => 0.05
            ],
            [
                'kriteria' => 'time_management',
                'bobot' => 0.2
            ],
        ];
        DB::table('kriteria')->insert($kriteria);
    }
}
