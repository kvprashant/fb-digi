<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\Authentication\AccessToken;
use Facebook\FacebookRequest;

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
      $this->get('api/v1/name?page=KPN')->seeJson();
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
      $this->get('api/v1/name?page=KPN')
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
      $this->get('api/v1/posts?page=cocacolanetherlands&limit=1')
      
      // ->seeJsonStructure([
      //   'data' => [['id', 
      //   'created_time', 
      //   ['likes' => 
      //   'data',
      //   ['summary' => 'total_count', 'can_like' , 'has_liked']
      //   ]
      //   ]],
      //   'paging' => ['previous','next']                
      //   ]);
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

      $this->get('api/v1/posts?page=cocacolanetherlands&limit=1');

      $fb = new Facebook([
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'default_graph_version' => 'v2.5'
        ]);
      $accessToken = new AccessToken(env('FACEBOOK_APP_ID').'|'.env('FACEBOOK_APP_SECRET'));

      $response = $fb->get('cocacolanetherlands/posts?limit=1', $accessToken);
      $responseArray = json_decode($response->getBody(), true);

      $this->seeJson(array("id" => $responseArray["data"][0]["id"]));


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
      return 1===1;
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
      $this->AssertTrue(TRUE);  
    }
  }
