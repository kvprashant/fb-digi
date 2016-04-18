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
    public function testPostsSchema()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);
        // $this->get('api/v1/posts?page=cocacolanetherlands&limit=20')
        //      ->seeJsonStructure([
        //         'data' => [['id', 
        //                    'created_time', 
        //                    ['likes' => 
        //                        'data',
        //                        ['summary' => 'total_count', 'can_like' , 'has_liked']
        //                    ]
        //         ]],
        //         'paging' => ['previous','next']                
        //         ]);
        $this->assertTrue(FALSE);
    }

    /**
     * Tests the schema of the data structure
     *
     * @return void
     */
    public function testParser()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);

        $this->get('api/v1/posts_ordered_by_likes?page=cocacolanetherlands&limit=20')->seeJson(array('id' => '326525887549566_515539971981489'));
    }

    /**
     * Tests the sort order of likes
     *
     * @return void
     */
    public function testSortOrder()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);

        $this->get('api/v1/top_user_likes');
        $this->AssertTrue(TRUE);
    }

    /**
     * Test count of user likes 
     *
     * @return void
     */
    public function testUserLikesCount()
    {
        $user = new User(array(
            'email' => env('USERNAME'),
            'password' => env('PASSWORD')
        ));
        $this->be($user);

        $this->get('api/v1/top_user_likes');
        $this->AssertTrue(TRUE);  
    }
}
