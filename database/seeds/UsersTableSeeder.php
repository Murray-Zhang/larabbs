<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //获取faker 实列
        $faker = app(Faker\Generator::class);

        $avatars = [
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/s5ehp11z6s.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/Lhd1SHqu86.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/LOnMrqbHJn.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/xAuDMxteQy.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/ZqM7iaP4CR.png',
            'https://iocaffcdn.phphub.org/uploads/images/201710/14/1/NDnzMutoxX.png',
        ];

        //生成数据集合
        $users = factory(User::class,10)->make()->each(function($user, $index) use ($faker, $avatars){
            $user->avatar = $faker->randomElement($avatars);

        });
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());

        $user = User::find(1);
        $user->name = 'zhangsan';
        $user->email = 'zhangsan@qq.com';
        $user->avatar = 'http://larabbs.lovezhz.cn/uploads/images/avatars/201909/17/1_1568718471_xRVqPKnpIS.png';
        $user->save();
        // 初始化⽤⼾⻆⾊，将 1 号⽤⼾指派为『站⻓』
        $user->assignRole('Founder');
        // 将 2 号⽤⼾指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');



    }
}
