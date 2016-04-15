<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PostController extends Controller
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
         'urls' => $urls->toArray()),
       200
       );
     }
   }

   return Response::json(array(
     'error' => array(
      'message' => "A page name is required to request this resource",
      'type' => 'URLMismatch',
      'code' => 100,
      'dgtrace_id' => time()
      400
      );

   }
 }
