<?php

use Illuminate\Database\Seeder;
use App\Models\Reply;
use App\Models\User;
use App\Models\Topic;

class ReplysTableSeeder extends Seeder
{
    public function run()
    {
        $allUsersid = User::all()->pluck('id')->toArray();
        $allTopicsid = Topic::all()->pluck('id')->toArray();

        //获取faker实例
        $faker = app(\Faker\Generator::class);
        $replys = factory(Reply::class)->times(1000)->make()->each(function ($reply, $index) use ($allUsersid, $allTopicsid, $faker){
            //从用户中随机取出一个赋值
            $reply->user_id = $faker->randomElement($allUsersid);
            $reply->topic_id = $faker->randomElement($allTopicsid);
        });

        Reply::insert($replys->toArray());
    }

}

