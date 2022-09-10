<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_user_can_access_index_page() : void
    {
        $response = $this->get(route('index'));
        $response->assertStatus(200);
    }

    public function test_user_can_access_about_page() : void
    {
        $response = $this->get(route('about'));
        $response->assertStatus(200);
    }

    public function test_user_can_access_contact_page() : void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
    }
  

}
