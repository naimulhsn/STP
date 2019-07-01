<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Ad;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $faker = Faker\Factory::create();

        User::create([
            'name'  => 'Naimul Hasan',
            'gender' => 'Male',
            'dept' => 'CSE',
            'session' => '2016-17',
            'email' => 'admin@gmail.com',
            'phone' => '01838388807',
            'password' => bcrypt('aaaaaaaa')
        ]);
        User::create([
            'name'  => 'ndmin',
            'gender' => 'Female',
            'dept' => 'CSE',
            'session' => '2016-17',
            'email' => 'nadmin@gmail.com',
            'phone' => '01927228335',
            'password' => bcrypt('aaaaaaaa')
        ]);
        
        $gender = ['Male','Female'];
        $dept=['CSE','EEE','PHY','MATH'];
        $session=['2015-16','2016-17','2017-18','2018-19'];
        for($i = 0; $i < 10; $i++) {
            User::create([
                'name' => $faker->name,
                'gender'=>$gender[rand(0,1)],
                'dept'=>$dept[rand(0,3)],
                'session'=>$session[rand(0,3)],
                'phone' => $faker->phoneNumber,
                'email' => $faker->safeEmail,
                'password' => bcrypt('aaaaaaaa')
            ]);
        }

        //Seeding Ads

        $categories = ['Sports','Study-Material','Mobile','Mobile-Accessory','Laptop','Computer','Comp-Accessory','Electronics','Camera','kitchenware','Furniture','Household','Others'];
        $conditions = ['New','Used'];
        
        for($i=0; $i<100; $i++){
            $img="https://picsum.photos/id/".rand(1,900)."/600/400";
            Ad::create([
                'user_id'=>rand(1,10),
                'name'=>ucfirst($faker->sentence($nbWords = 3, $variableNbWords = true) ),
                'price'=>rand(100,5000),
                'negotiation'=>$faker->randomElement($array = array('negotiable','fixed')),
                'category'=>$categories[rand(0,12)],
                'condition'=>$conditions[rand(0,1)],
                'used_time'=>rand(0,1000),
                'description'=>$faker->paragraph,
                'specification'=>$faker->sentence,
                'available'=>rand(0,1),
                'image'=>$img
            ]);
        }

        //Seeding Categories 
        $categories = ['Sports','Study-Material','Mobile','Mobile-Accessory','Laptop','Computer','Comp-Accessory','Electronics','Camera','kitchenware','Furniture','Household','Others'];

        for($i=0; $i<13; $i++){
            $count=Ad::where('category',$categories[$i])->count();
            Category::create([
                'category'=>$categories[$i],
                'product_count'=> $count
            ]);
        }

    }
}
