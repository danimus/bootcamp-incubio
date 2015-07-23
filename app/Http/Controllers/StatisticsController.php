<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Elasticsearch\Client as Es;

class StatisticsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getGlobalTrends()
	{

		$params['index'] = 'twitterstream';
		$params['body'] = array(
			'aggs' => array(
				'trendingtopics' => array(
					'date_histogram' => array(
						'field'=>'created_at',
						'interval'=>'minute'
						),
					)
				),
			'size'=>0
			);

		$result = new Es();
		$result = $result->search($params);

		return response()->json($result['aggregations']['trendingtopics']['buckets']);
	}

	public function getLocalTrends(){

		//To be implemented
	}


	public function getLocalTrends(){

		//To be implemented
	}

	public function getUserTags(){

		//To be implemented
	}

}