<?php

namespace App\Http\Controllers;

use Request;
use Response;

use Facebook\Facebook;
use Facebook\Authentication\AccessToken;

class PageController extends Controller
{
  /**
   * Retrieve page insights
   * 
   * @return Response
   */
  public function getPageInsights()
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
          $response = $fb->get($page_name.'/insights/page_fans_country', $accessToken);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }

        $pageInsights = $response->getDecodedBody()['data'];
        if(!empty($pageInsights))
        {
          return Response::json($pageInsights[0]['values'][0]['value'], 200);
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
    }
  }
}
