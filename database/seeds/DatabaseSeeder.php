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

        User::flushEventListeners();
        Project::flushEventListeners();
        Comment::flushEventListeners();
        Category::flushEventListeners();


        $usersQuantity = 200;
        $projectQuantity = 30;
        $categoriesQuantity = 5;
        $commentsQuantity = 60;

        $categories = Category::find(rand(1, 5));

        factory(User::class, $usersQuantity)->create();
        factory(Category::class, $categoriesQuantity)->create();
        factory(Project::class, $projectQuantity)->create()->each(
            function($project){
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $project->categories()->attach($categories);
            }
        );
        factory(Comment::class, $commentsQuantity)->create();
        




    }
}
