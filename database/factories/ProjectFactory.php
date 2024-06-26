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

        return [
            'user_id' => User::factory(),
            'name' => $faker->name,
            'contact_person' => $faker->name,
            'phone' => $faker->phoneNumber,
            'mobile' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'department' => $faker->word,
            'title' => $faker->jobTitle,
            'description' => $faker->paragraph,
            'work_content' => $faker->paragraph,
            'schedule' => $faker->date('Y-m-d'),
            'location' => $faker->address,
            'budget' => $faker->randomNumber(5),
            'notes' => $faker->sentence,
            'start_date' => $faker->date('Y-m-d'),
            'inquiry_deadline' => $faker->date('Y-m-d'),
            'required_skills' => implode(', ', $faker->words(5)),
            'budget_range' => $faker->randomElement(['預算另議', '1~3 萬', '3~5 萬', '6~9 萬', '10~15萬', '15~20萬', '20~25', '25~30', '40~50', '50~60', '60~70', '70~80', '80~90', '90~100', '100（含）以上']),
            'target_audience' => $target_audience,
            'work_location' => $faker->randomElement(['皆可', '自備場所', '駐點']),
            'status' => $faker->boolean,
            'experience_years' => $faker->numberBetween(1, 20),
            'issuer_website' => $faker->url,
        ];
    }
}
