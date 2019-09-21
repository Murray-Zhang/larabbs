<?php

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\User;
use App\Models\Category;

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        //获取所有用户的id;
        $alluserids = User::all()->pluck('id')->toArray();
        //获取所有分类集合
        $allcategories = Category::all()->pluck('id')->toArray();

        $faker = app(\Faker\Generator::class);

        $topics = factory(Topic::class, 100)->make()->each(function ($topic, $index) use ($alluserids,$allcategories,$faker){
            $topic->user_id = $faker->randomElement($alluserids);
            $topic->category_id = $faker->randomElement($allcategories);
        });

        Topic::insert($topics->toArray());
    }

}

