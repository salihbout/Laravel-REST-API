<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Project;
use App\Comment;
use App\Category;
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
        Category::truncate();

        User::flushEventListerners();
        Project::flushEventListerners();
        Comment::flushEventListerners();
        Category::flushEventListerners();


        $usersQuantity = 200;
        $projectQuantity = 30;
        $categoriesQuantity = 5;
        $commentsQuantity = 60;
        
        factory(User::class, $usersQuantity)->create();
        factory(Project::class, $projectQuantity)->create();
        factory(Comment::class, $commentsQuantity)->create();
        factory(Category::class, $categoriesQuantity)->create();




    }
}
