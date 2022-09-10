<?php

namespace Tests\Feature;

use Tests\TestCase;

class PageTest extends TestCase
{

    /**
     * Test user can access index page.
     *
     * @return void
     */

    public function test_user_can_access_index_page() : void
    {
        $response = $this->get(route('index'));
        $response->assertStatus(200);
    }

    /**
     * Test user can access about page.
     *
     * @return void
     */
    public function test_user_can_access_about_page() : void
    {
        $response = $this->get(route('about'));
        $response->assertStatus(200);
    }

    /**
     * Test user can access contact page.
     *
     * @return void
     */
    public function test_user_can_access_contact_page() : void
    {
        $response = $this->get(route('contact'));
        $response->assertStatus(200);
    }
  
}
