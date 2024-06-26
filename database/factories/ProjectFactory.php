<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {

        $faker = \Faker\Factory::create('zh_TW');

        $target_audience = ['公司', '工作室', '兼職上班族', '學生'];
        // 隨機取得一組陣列中的值，ex: 公司,學生 | 工作室,兼職上班族 | 公司,學生,工作室，然後是 String
        $target_audience = implode(', ', $faker->randomElements($target_audience, $faker->numberBetween(1, 4)));

        $jobTitles = [
            '工程師',
            '專案經理',
            '開發人員',
            '產品經理',
            '設計師',
            '數據分析師',
            '市場專員',
            '客服經理',
            '運營總監',
            '銷售代表'
        ];

        $selectName = [
            '網頁設計',
            '程式開發',
            'APP開發',
            '網站開發',
            '網頁設計-長期合作',
            '電子商務網站開發',
            '企業網站設計',
            '跨平台應用開發',
            'SEO優化服務',
            '前端開發專案',
            '後端開發專案',
            'UI/UX設計',
            '響應式網頁設計',
            'WordPress網站開發',
            'Laravel專案開發'
        ];


        return [
            'user_id' => User::factory(),
            'name' => $faker->randomElement($selectName),
            'contact_person' => $faker->name,
            'phone' => $faker->phoneNumber,
            'mobile' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'department' => $faker->word,
            'title' =>  $faker->randomElement($jobTitles),
            'description' => $faker->realText(200, 2),
            'work_content' => $faker->realText(200, 2),
            'schedule' => $faker->date('Y-m-d'),
            'location' => $faker->address,
            'budget' => $faker->randomNumber(5),
            'notes' => $faker->sentence,
            'start_date' => $faker->date('Y-m-d'),
            'inquiry_deadline' => $faker->date('Y-m-d'),
            'required_skills' => implode(', ', $faker->words(5)),
            'budget_range' => $faker->randomElement(['預算另議', '1~3 萬', '3~5 萬', '6~9 萬', '10~15萬', '15~20萬', '20~25萬', '25~30萬', '40~50萬', '50~60萬', '60~70萬', '70~80萬', '80~90萬', '90~100萬', '100萬（含）以上']),
            'target_audience' => $target_audience,
            'work_location' => $faker->randomElement(['皆可', '自備場所', '駐點']),
            'status' => $faker->boolean,
            'experience_years' => $faker->numberBetween(1, 20),
            'issuer_website' => $faker->url,
        ];
    }
}
