<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class PostsControllerTest extends TestCase
{
    /**
     * Tests basic authentication for REST endpoint 
     *
     * @return void
     */
    public function testBasicAuth() {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);
        $this->seeIsAuthenticatedAs($user);
    }

    /**
     * Tests the name of the page being retrieved by REST
     * 
     * @return void
     */
    public function testPageName()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);
        $this->get('api/v1/name?page=cocacolanetherlands')->seeJson();
    }

    /**
     * Tests if the posts are in the right JSON structure
     *
     * @return void
     */
    public function testJsonStructure()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);
        $this->get('api/v1/name?page=cocacolanetherlands')
             ->seeJsonStructure([
                'error',
                'data' => ['name','id']
                ]);
    }

    /**
     * Tests structure of the get posts API endpoint
     *
     * @return void
     */
    public function testNumberOfPosts()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);
        $this->get('api/v1/posts?page=cocacolanetherlands&limit=20')
             ->seeJsonStructure([
                'data' => [['message','id','created_time']],
                'paging' => ['previous','next']                
                ]);
    }
}
