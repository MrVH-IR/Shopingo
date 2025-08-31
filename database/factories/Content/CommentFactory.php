<?php

namespace Database\Factories\Content;

use App\Models\Content\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            "body" => $this->faker->paragraph(),
            "author_id" => User::factory(),
            "parent_id" => null,
            "seen" => 0,
            "approved" => 0,
            "status" => 1,
        ];
    }

    public function forPost(): CommentFactory
    {
        return $this->for(Post::factory()->create() , 'commentable');
    }

    public function forUser(): CommentFactory
    {
        return $this->for(User::factory()->create() , 'commentable');
    }

    //Uncomment When there is a product factory
//    public function forProduct(): ProductFactory
//    {
//        return $this->for(Product::factory()->create() , 'commentable');
//    }
}
