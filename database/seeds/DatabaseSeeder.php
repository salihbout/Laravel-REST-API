<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\Comment;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        User::truncate();
        Project::truncate();
        Comment::truncate();

        $usersQuantity = 200;
        $projectQuantity = 30;
        $commentsQuantity = 60;
        
        factory(User::class, $usersQuantity)->create();
        factory(Project::class, $projectQuantity)->create();
        factory(Comment::class, $commentsQuantity)->create();




    }
}
