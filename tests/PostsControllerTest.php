<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostsControllerTest extends TestCase
{
    /**
     * Tests the name of the page being retrieved by REST
     * 
     * @return void
     */
    public function testPageName()
    {
        $response = $this->get('api/v1/name?page=cocacolanetherlands');
        $this->assertEqual($response, 'Coca-Cola');
    }

    /**
     * Tests if the posts are JSON format
     *
     * @return void
     */
    public function testIfJson()
    {
        $response = $this->get('api/v1/posts?page=cocacolanetherlands');
        $this->assertIsJson($response);
    }

    /**
     * Tests number of posts returned by the REST API
     *
     * @return void
     */
    public function testNumberOfPosts()
    {
        $response = $this->get('api/v1/posts?page=cocacolanetherlands&limit=20');
        $this->assertEqual(count($response), 20);
    }
}
