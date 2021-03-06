<?php

namespace App\Http\Controllers;

use Request;
use Response;

use Facebook\Facebook;
use Facebook\FacebookApp;
use Facebook\Authentication\AccessToken;
use Facebook\FacebookRequest;

use App\Posts;

class PostsController extends Controller
{
	/**
	 * Retrieves a page name 
	 *
	 * @return Response
	 */
  public function getPageName()
  {
   $page_name = '';

   if ( Request::get('page') )
   {
     $page_name = Request::get('page');
     if(!empty($page_name))
     {

      $fb = new Facebook([
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'default_graph_version' => 'v2.5'
      ]);
      $accessToken = new AccessToken(env('FACEBOOK_APP_ID').'|'.env('FACEBOOK_APP_SECRET'));

      try {
        $response = $fb->get($page_name, $accessToken);
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      return Response::json(array(
        'error' => false,
        'data' => $response->getDecodedBody()),
        200
       );
    }
  }

   // No page name or id provided
   return Response::json(array(
     'error' => array(
      "message" => "(#803) Some of the aliases you requested do not exist => ".$page_name ,
      "type" => "OAuthException",
      "code" => 803,
      "fbtrace_id" => "FIUHZyYIVXN"
      )),
      400
    );
   }

  /**
   * Retrieves a posts from page sorted by most number of likes
   *
   * @return Response
   */
  public function getPostsOrderedByLikes()
  {
    $defaultLimit = 20;
    $page_name = '';

    if (Request::get('limit'))
    {
      $defaultLimit = Request::get('limit');
    }

    if ( Request::get('page') )
    {
     $page_name = Request::get('page');
     if(!empty($page_name))
     {

      $fb = new Facebook([
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'default_graph_version' => 'v2.5'
      ]);
      $accessToken = new AccessToken(env('FACEBOOK_APP_ID').'|'.env('FACEBOOK_APP_SECRET'));

      try {
        $response = $fb->get($page_name.'/posts?fields=id,likes.limit(0).summary(true),created_time&limit='.$defaultLimit, $accessToken);
      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $posts = $response->getDecodedBody()['data'];
      foreach ($posts as $record) {
        $post = Posts::where('post_id', $record['id'])->first();
        if(!$post)
        {
          $post = new Posts;
          $post->post_id = $record['id'];
        }
        $post->likes_count = $record['likes']['summary']['total_count'];
        $post->post_created_at = $record['created_time'];      
        
        $post->save();
      }

      $storedPosts = Posts::orderBy('likes_count', 'desc')
                        ->take($defaultLimit)
                        ->get();

      return Response::json($storedPosts->toArray(),200);
     }
    }

    // No page name or id provided
    return Response::json(array(
     'error' => array(
      "message" => "(#803) Some of the aliases you requested do not exist => ".$page_name ,
      "type" => "OAuthException",
      "code" => 803,
      "fbtrace_id" => "FIUHZyYIVXN"
      )),
      400
    );
  }

  /**
   * Retrieves a posts from page
   *
   * @return Response
   */
  public function getPosts()
  {
    $defaultLimit = 20;
    $page_name = '';

    if (Request::get('limit'))
    {
      $defaultLimit = Request::get('limit');
    }

    if ( Request::get('page') )
    {
      $page_name = Request::get('page');
      if(!empty($page_name))
      {
        $fb = new Facebook([
          'app_id' => env('FACEBOOK_APP_ID'),
          'app_secret' => env('FACEBOOK_APP_SECRET'),
          'default_graph_version' => 'v2.5'
        ]);
        $accessToken = new AccessToken(env('FACEBOOK_APP_ID').'|'.env('FACEBOOK_APP_SECRET'));

        try {
          $response = $fb->get($page_name.'/posts?fields=id,likes.limit(0).summary(true),created_time&limit='.$defaultLimit, $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $posts = $response->getDecodedBody()['data'];

        return Response::json($posts,200);
      }
    }

    // No page name or id provided
    return Response::json(array(
     'error' => array(
      "message" => "(#803) Some of the aliases you requested do not exist => ".$page_name ,
      "type" => "OAuthException",
      "code" => 803,
      "fbtrace_id" => "FIUHZyYIVXN"
      )),
      400
    );
  }

  /**
   * Returns the top five users who have liked the top 20 posts
   *
   * @return Response
   */
  public function getTopUsers()
  {
    $fb = new Facebook([
      'app_id' => env('FACEBOOK_APP_ID'),
      'app_secret' => env('FACEBOOK_APP_SECRET'),
      'default_graph_version' => 'v2.5'
    ]);
    $accessToken = new AccessToken(env('FACEBOOK_APP_ID').'|'.env('FACEBOOK_APP_SECRET'));

    //TODO Add the page field to query from the database once the page field is added to the Like model
    $posts = Posts::orderBy('likes_count', 'asc')
                    ->take(20)
                    ->get(['post_id']);

    // We will add all the likes into this array
    $likes = array();
    foreach ($posts as $postRecord) {
      $postId = $postRecord['post_id'];
      $request = new FacebookRequest(
        $fb->getApp(),
        $accessToken,
        'GET',
        $postId.'/likes?fields=name&limit=100'
      );
      try {
        $response = $fb->getClient()->sendRequest($request);
        $graphEdge = $response->getGraphEdge();

      } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
      } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
      }

      $postLikes = array();
      // Implementing pagination here
      if ($fb->next($graphEdge)) {  
        $likesArray = $graphEdge->asArray();
        $postLikes = array_merge($postLikes, $likesArray); 
        while ($graphEdge = $fb->next($graphEdge)) { 
            $likesArray = $graphEdge->asArray();
            $postLikes = array_merge($postLikes, $likesArray);
        }
      } else {
        $likesArray = $graphEdge->asArray();
        $postLikes = array_merge($postLikes, $likesArray);
      }

      foreach ($postLikes as $status) {
        array_push($likes, $status['name']);
      }

    }

    $likesFrequency = array_count_values($likes);
    arsort($likesFrequency, SORT_NUMERIC);
    $topUsersArray = array_slice($likesFrequency, 0, 5);
    
    return Response::json($topUsersArray, 200);
  }

}
