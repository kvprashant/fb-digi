<?php

namespace App\Http\Controllers;

use Request;
use Response;

use App\Http\Requests;

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
       return Response::json(array(
        'error' => false,
        'data' => array(
          'name' => 'Coca-Cola',
          'id' => 326525887549566,
        )),
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

   public function getPosts()
   {
    $response = array(
     'data' =>  array( 
        array(
           'message' => '#WEEKEND!',
           'created_time' => '2016-04-15T14:30:01+0000',
           'id' => '326525887549566_515539971981489',
        ), 
        array(
           'message' => 'De FrisChicks gaven op 1 april de allerlaatste VEED tickets weg! Wie pakte dit het leukst aan? Check het op cokeurl.com/frischicks!',
           'created_time' => '2016-04-13T14:25:59+0000',
           'id' => '326525887549566_517886368413516',
        ), 
        array(
           'message' => 'Dit is een uitstekend moment om iemand mee uit te vragen. Doe het! #TastetheFeeling',
           'created_time' => '2016-04-11T14:02:36+0000',
           'id' => '326525887549566_515539185314901',
        ), 
        array(
           'message' => '*Plop!* Vrijdagmiddag! #TastetheFeeling',
           'created_time' => '2016-04-08T14:00:00+0000',
           'id' => '326525887549566_514766445392175',
        ), 
        array(
           'message' => 'Nieuwe week, nieuwe challenge van de Coke FrisChicks! Jeske opent de allernieuwste achtbaan van Walibi terwijl Desi op lachyoga gaat... http://cokeurl.com/frischicks',
           'created_time' => '2016-04-06T14:15:08+0000',
           'id' => '326525887549566_515171495351670',
        ), 
        array(
           'message' => 'Ok, daar gaat-ie. Zeg het maar, kies je favoriet! #TastetheFeeling',
           'created_time' => '2016-04-05T12:06:05+0000',
           'id' => '326525887549566_514763972059089',
        ), 
        array(
           'message' => 'Geen grap: het is weekend! #TastetheFeeling',
           'created_time' => '2016-04-01T15:00:01+0000',
           'id' => '326525887549566_511552909046862',
        ), 
        array(
           'message' => 'Zomertijd! Tijd voor zomer! De Coke FrisChicks Jeske & Desi zitten vol zomerkriebels: welk team heeft de beste summer vibe?http://CokeURL.com/frischicks',
           'created_time' => '2016-03-30T14:16:08+0000',
           'id' => '326525887549566_511628515705968',
        ), 
        array(
           'message' => 'Goede Vrijdag? Beste vrijdag!',
           'created_time' => '2016-03-25T11:00:00+0000',
           'id' => '326525887549566_504523649749788',
        ), 
        array(
           'message' => 'Bij twijfel: doen. Iedere keer weer.',
           'created_time' => '2016-03-18T12:00:01+0000',
           'id' => '326525887549566_501524376716382',
        ), 
        array(
           'message' => "Let's kiss.",
           'created_time' => '2016-03-14T11:00:02+0000',
           'id' => '326525887549566_501523560049797',
        ), 
        array(
           'message' => 'Binnen hoeveel tellen stond jij bij de koelkast?',
           'created_time' => '2016-03-11T14:00:01+0000',
           'id' => '326525887549566_498942123641274',
        ), 
        array(
           'message' => 'Voor alle vrouwen op de wereld! #internationalevrouwendag',
           'created_time' => '2016-03-08T09:00:01+0000',
           'id' => '326525887549566_498941676974652',
        ), 
        array(
           'message' => 'Hé jullie! Geniet van het weekend!',
           'created_time' => '2016-03-04T15:01:01+0000',
           'id' => '326525887549566_497453133790173',
        ), 
        array(
           'message' => 'Een extra dag om van een ijskoude Coca-Cola te genieten. Cheers! #schrikkeldag',
           'created_time' => '2016-02-29T10:46:30+0000',
           'id' => '326525887549566_497451903790296',
        ), 
        array(
           'message' => 'We kijken vast vooruit naar een zomer vol vrienden. Good times!',
           'created_time' => '2016-02-27T11:30:00+0000',
           'id' => '326525887549566_495699720632181',
        ), 
        array(
           'message' => 'Hoe voel jij je na een slok ijskoude Coca-Cola?',
           'created_time' => '2016-02-25T12:49:17+0000',
           'id' => '326525887549566_496066737262146',
        ), 
        array(
           'message' => 'Nog meer Coke FrisChicks? Dat kan! Jeske & Desi spelen een gastrol in de serie Cliffhanger met Dylan Haegens. Spanning en sensatie!',
           'story' => "Coca-Cola shared Dylan Haegens's post.",
           'created_time' => '2016-02-25T09:07:03+0000',
           'id' => '326525887549566_496022243933262',
        ), 
        array(
           'message' => 'Sorry. We zijn onweerstaanbaar.',
           'created_time' => '2016-02-19T13:00:02+0000',
           'id' => '326525887549566_492745594260927',
        ), 
        array(
           'message' => 'Tijdens die saaie weekdagen gaan onze gedachten keer op keer terug naar het weekend... herkenbaar?',
           'created_time' => '2016-02-15T10:18:27+0000',
           'id' => '326525887549566_492742537594566',
        ),
      ), 
      'paging' => array(
        'previous' => 'https://graph.facebook.com/v2.6/326525887549566/posts?limit=20&format=json&since=1460730601&access_token=CAACEdEose0cBAHESrdo0M4DIRRvmTaACF6BxOIaeQihNNenXCiBfPzwQWIoRMD4rZBzqTkwBFvSCoqd2BfqbLJ8LgwqmLr9YZCuTgiOuVoNKDv7VTzmNYk1uQVaZCvZBBMGuqe574gmPxyf6BIlxuosD5Lb6MVjZBKIrqUGBFidtjn8pqalhwcaYvEdO9R0FQdcYVdIiNtIPjrbO9byFr&__paging_token=enc_AdAyZBblrqBqKvQxa14CXEWB3u3QbZBIgxJzTGWXKA8qSf7v4hoBCW13dHXxdVtz27XHZBXb5ZAKmsSvjhrvDlKCV3JCe0EGaDVUOqZBZAZBhdeGrOYBQZDZD&__previous=1',
        'next' => 'https://graph.facebook.com/v2.6/326525887549566/posts?limit=20&format=json&access_token=CAACEdEose0cBAHESrdo0M4DIRRvmTaACF6BxOIaeQihNNenXCiBfPzwQWIoRMD4rZBzqTkwBFvSCoqd2BfqbLJ8LgwqmLr9YZCuTgiOuVoNKDv7VTzmNYk1uQVaZCvZBBMGuqe574gmPxyf6BIlxuosD5Lb6MVjZBKIrqUGBFidtjn8pqalhwcaYvEdO9R0FQdcYVdIiNtIPjrbO9byFr&until=1455531507&__paging_token=enc_AdCVjbJUZBavOH2YhXsUZCZBXZA9JbUpZA8tF5SnZB77LqvZASiwRdRxVsPZAnZChDUkC6VgZB5UxbimgUrE1b6XrZBCtY4cxZAQZBctChdELZCAwREembGa65yQZDZD',
        ),
    );
    return Response::json($response);
   }
 }
