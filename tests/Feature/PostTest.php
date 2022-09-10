<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class PostTest extends TestCase
{
    use WithFaker;

    /**
     * Test user can show post.
     *
     * @return void
     */

    public function test_user_can_show_post() : void
    {
        $response = $this->get(route('post.show', ['id' => 5]));
        $response->assertStatus(200);
    }

    /**
     * Test user can access create page.
     *
     * @return void
     */
    public function test_user_can_create_post() : void
    {
        $response = $this->get(route('post.create'));
        $response->assertStatus(200);
    }

    /**
     * Test user can store new post.
     *
     * @return void
     */
    public function test_user_can_store_post() : void
    {
        $response = $this->post(route('post.store',[
            'author_id' => $this->faker->randomElement(User::pluck('id')),
            'slug'      => $this->faker->unique()->slug,
            'title'     => $this->faker->sentence(4),
            'subtitle'  => $this->faker->sentence(2),
            'tags'      => $this->faker->words(2),
            'content'   => $this->faker->paragraph(25),
            'image'     => $this->faker->image(),
            'is_published' => 0,
            'category_id'  => $this->faker->randomElement(Category::pluck('id')),
        ]));
        
        $response->assertStatus(302);
    }

     /**
     * Test user cannot store new post with empty data.
     *
     * @return void
     */
    public function test_user_cannot_store_with_empty_data() : void
    {
        $response = $this->withHeaders(['Accept' => 'application/json'])
                         ->post(route('post.store',[
                                    'author_id' => '',
                                    'slug'      => '',
                                    'title'     => '',
                                    'subtitle'  => '',
                                    'tags'      => '',
                                    'content'   => '',
                                    'image'     => '',
                                    'is_published' => '',
                                    'category_id'  => '',
                        ])
                    );
        
        $response->assertStatus(422);
    }

    /**
     * Test user can access edit page.
     *
     * @return void
     */
    public function test_user_can_edit_post() : void
    {
        $response = $this->get(route('post.edit', ['post' => Post::first()]));
        $response->assertStatus(200);
    }

    /**
     * Test user can update post.
     *
     * @return void
     */
    public function test_user_can_update_post() : void
    {
        $newPost = [
            'title'     => $this->faker->sentence(4),
            'subtitle'  => $this->faker->sentence(2),
            'tags'      => $this->faker->words(2),
            'content'   => $this->faker->paragraph(25),
            'image'     => $this->faker->image(),
            'category_id'  => $this->faker->randomElement(Category::pluck('id')),
        ];

        $response = $this->put(route('post.update', ['post' => Post::first()]), $newPost);
        $response->assertStatus(302);
    }


    /**
     * Test user can publish post.
     *
     * @return void
     */
    public function test_user_can_publish_post() : void
    {
        $post = Post::where('is_published','=', 0)->first();
        $response = $this->get(route('post.publish', ['post' => $post]));
        $response->assertStatus(302);
    }

    
    /**
     * Test user can delete post.
     *
     * @return void
     */
    public function test_user_can_delete_post() : void
    {   
        $response = $this->delete(route('post.delete',['id' => Post::pluck('id')->first()]));
        $response->assertStatus(302);

    }


}
