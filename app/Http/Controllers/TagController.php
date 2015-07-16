<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\tagsUser as TagsUser;
use App\tags as Tags;
use Illuminate\Http\Request;
use DB;
use Auth;



class TagController extends Controller {

/*
	public function addNewTag($tagname)
	{
			$Obj = new Tag();
			$Obj->tagname= $tagname;
			$Obj->save();

			$ObjUsers = new TagsUsers();
			$ObjUsers->user_id = Auth::user->id;
			$ObjUsers->tags_id = $Obj->id;


	}*/
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
 		$listTagsObj = TagsUser::where('user_id',Auth::user()->id)->get();
		$contenedorDeTagsName=array();
		$i=0;
		 foreach ($listTagsObj as $tagObj) {
    	
    	    $listTagsUser = Tags::where('id',$tagObj->tags_id)->get()->toJson();
    	    $contenedorDeTagsName[$i]= $listTagsUser;
    	    $i++;
		 }
		return $contenedorDeTagsName;
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tag=DB::table('tags')->find($id);

		return view('tags.show', compact('tag'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

/*	public function getTags() 
	{
		$tags=['#boyfriend', '#beallright'];

		return $tags;
	}*/

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function getTagsUser(){

		$listTagsObj = TagsUser::where('user_id',Auth::user()->id)->get();
		$contenedorDeTagsName=array();
		$i=0;
		 foreach ($listTagsObj as $tagObj) {
    	
    	    $listTagsUser = Tags::where('id',$tagObj->tags_id)->get()->toJson();
    	    $contenedorDeTagsName[$i]= $listTagsUser;
    	    $i++;
		 }
		return $contenedorDeTagsName;
		
	}

}
